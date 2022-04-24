<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.dashboard', compact('users', 'events'));
    }

    public function showUsers()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.users', compact('users', 'events'));
    }
}
