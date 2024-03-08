<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $statisticUser = User::count();
        $events = Event::latest()->get();
        return view('admin.events.index' , compact(['events', 'statisticUser']));
    }

    public function accept($id)
    {
        $event = Event::findOrFail($id);

        if ($event->status === '0') {
            $event->status = '2';
        } elseif ($event->status === '1') {
            $event->status = '3';
        } elseif ($event->status === '4') {
            $event->status = '2';
        } elseif ($event->status === '5') {
            $event->status = '3';
        }

        $event->save();

        if($event->reservations()->exists()) {
            $event->reservations()->where('status', '3')->update(['status' => '0']);
            $event->reservations()->where('status', '4')->update(['status' => '1']);
            $event->reservations()->where('status', '5')->update(['status' => '2']);
        }


        return redirect()->route('admin.events.index')->with('success', 'Event status updated successfully.');
    }

    public function decline($id)
    {
        $event = Event::findOrFail($id);

        if ($event->status === '0') {
            $event->status = '4';
        } elseif ($event->status === '1') {
            $event->status = '5';
        } elseif ($event->status === '2') {
            $event->status = '4';
        }elseif ($event->status === '3') {
            $event->status = '5';
        }
        $event->save();

        if($event->reservations()->exists()) {
            $event->reservations()->where('status', '0')->update(['status' => '3']);
            $event->reservations()->where('status', '1')->update(['status' => '4']);
            $event->reservations()->where('status', '2')->update(['status' => '5']);
        }

        return redirect()->route('admin.events.index')->with('error', 'Event declined successfully.');
    }
}
