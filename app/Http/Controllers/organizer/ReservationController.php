<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index()
    {
        $organizerId = auth()->id();
        $reservations = Reservation::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->get();

        return view('organizer.reservations.index', compact('reservations'));
    }

    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $event = $reservation->event;
        $reservation->status = 1;
        $reservation->save();

        $uniqueId = Str::uuid()->toString();
        $qrCode = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . $uniqueId;
        $reservation->ticket()->create([
            'ticket_unique_id' => $uniqueId,
            'qr_url' => $qrCode,
        ]);
        $event->decrement('available_slots');

        return redirect()->route('organizer.reservations.index')->with('success', 'Reservation accepted successfully.');
    }

    public function decline($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 2;
        $reservation->save();

        return redirect()->route('organizer.reservations.index')->with('success', 'Reservation declined successfully.');
    }

}
