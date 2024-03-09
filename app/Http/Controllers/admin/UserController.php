<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;

class   UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $statisticUser = User::count();
        return view('admin.users.index', compact(['users', 'statisticUser']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = User::findOrFail($request);
        $skills = $user->skills->pluck('name')->toArray();

        return view('admin.users.show', compact('user', 'skills'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    public function ban($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = '1';
        $user->save();
        return redirect()->route('users.index')->with('success', 'User banned successfully');
    }

    public function unban($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = '0';
        $user->save();
        return redirect()->route('users.index')->with('success', 'User unbanned successfully');
    }

    public function statistics()
    {
        $statisticUser = User::count();
        $statisticEvent = Event::count();
        $statisticCategory = Category::count();
        return view('admin.statistics.index', compact(['statisticUser', 'statisticEvent', 'statisticCategory']));
    }
}
