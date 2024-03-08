<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::whereIn('status', [2, 3])->paginate(6);
        return view('user.events.index' , compact('events'));
    }

    public function create($id)
    {
        $event = Event::findOrFail($id);
        return view('user.events.create' , compact('event'));
    }


}
