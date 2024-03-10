<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Event::whereIn('status', [2, 3])->orderBy('id', 'desc');

        if ($request->has('category_id') && $request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search != null) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(6)->appends([
            'category_id' => $request->category_id,
            'search' => $request->search,
        ]);

        return view('user.events.index', compact('events', 'categories'));
    }
    public function create($id)
    {
        $event = Event::findOrFail($id);
        return view('user.events.create' , compact('event'));
    }


}
