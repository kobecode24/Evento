<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('organizer_id', auth()->id())->get();
        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        $categories=Category::all();
        return view("organizer.events.create", compact('categories'));
    }
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        unset($data['image']);

        $data['organizer_id'] = auth()->id();
        $data['status'] = $request->has('manual_validation') ? '1' : '0';

        $events = Event::create($data);

        if ($request->hasFile('image')) {
            $events->addMediaFromRequest('image')->toMediaCollection('media/events' , 'event_images');
        }
        $categories = Category::all();

        return redirect()->route('organizer.events.index', compact('events', 'categories'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();

        return view('organizer.events.edit', compact('event', 'categories'));
    }

    public function update(StoreEventRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['status'] = $request->has('manual_validation') ? '1' : '0';
        $event->update(Arr::except($data, 'image'));

        if ($request->hasFile('image')) {
            $event->clearMediaCollection('media/events');

            $event->addMediaFromRequest('image')
                ->toMediaCollection('media/events', 'event_images');
        }

        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully.');
    }


    public function cancel($event)
    {
        $event = Event::findOrFail($event);
        $event->status = '6';
        $event->save();

        if ($event->reservations()->exists()) {
            $event->reservations()->update(['status' => '3']);
        }

        return redirect()->route('organizer.events.index')->with('success', 'Event has been cancelled successfully.');
    }

    public function statistics()
    {
        $organizerId = auth()->id();

        $pendingCount = Event::where('organizer_id', $organizerId)
            ->whereIn('status', [0, 1])
            ->count();

        $acceptedCount = Event::where('organizer_id', $organizerId)
            ->whereIn('status', [2, 3])
            ->count();

        $rejectedCount = Event::where('organizer_id', $organizerId)
            ->whereIn('status', [4, 5])
            ->count();

        $canceledCount = Event::where('organizer_id', $organizerId)
            ->where('status', 6)
            ->count();

        $totalEvents = Event::where('organizer_id', $organizerId)->count();
        $totalReservations = Reservation::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->count();

        $averageReservationsPerEvent = $totalEvents > 0 ? round($totalReservations / $totalEvents, 2) : 0;

        $mostReservedEvent = Event::where('organizer_id', $organizerId)
            ->withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->first();

        return view('organizer.statistics.index', compact('mostReservedEvent','pendingCount', 'acceptedCount', 'rejectedCount', 'canceledCount', 'totalEvents', 'totalReservations', 'averageReservationsPerEvent'));
    }

}
