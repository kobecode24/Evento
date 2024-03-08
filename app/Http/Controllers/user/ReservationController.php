<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $reservations = Reservation::where('user_id', $userId)->get();

            return view('user.reservations.index', compact('reservations'));
    }

    public function create($id)
    {
        $userId = auth()->id();

        $event = Event::findOrFail($id);

        if ($event->available_slots <= 0) {
            return back()->with('error', 'No available slots for this event.');
        }

        if ($userId == $event->organizer_id) {
            return back()->with('error', 'Organizers cannot make reservations for their own events.');
        }

            if ($event->status == 2) {
                $status = 1;
            } else if ($event->status == 3) {
                $status = 0;
            } else {
                return back()->with('error', 'This event is not available for reservations.');
            }

            $reservation = new Reservation([
                'user_id' => $userId,
                'event_id' => $id,
                'status' => $status,
            ]);
            $reservation->save();

        if ($status == 1) {
            $uniqueId = Str::uuid()->toString();
            $qrCode = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . $uniqueId;
            $reservation->ticket()->create([
                'ticket_unique_id' => $uniqueId,
                'qr_url' => $qrCode,
            ]);
            $event->decrement('available_slots');
        }

        return redirect()->route('user.reservations.index')->with('success', 'Reservation made successfully.');
        }

        public function ticket_download($ticketId){
            $ticket = Ticket::with('reservation.event')->findOrFail($ticketId);
            $event = $ticket->reservation->event;
            $pdf = PDF::loadView('user.reservations.ticket', compact('ticket', 'event'));
            return $pdf->download('ticket.pdf');
        }


}
