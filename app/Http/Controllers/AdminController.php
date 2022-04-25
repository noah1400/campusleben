<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.dashboard', compact('users', 'events'));
    }

    // User functions

    // Show all users
    public function showUsers()
    {
        if(request('event', null) != null) {
            $users = User::whereHas('events', function($query) {
                $query->where('id', request('event'));
            })->paginate(50);
            if ($users->count() == 0) {
                $title = 'Diese Event hat keine Teilnehmer';
            }else{
                $title = 'Teilnehmer von Event: ' . Event::find(request('event'))->name;
            }
        } else {
            $users = User::orderBy('id')->paginate(50);
            $title = 'Alle Teilnehmer';
        }
        $user_count = User::count();
        $events = Event::all();
        return view('admin.users', compact('users', 'events', 'user_count', 'title'));
    }

    // Event functions

    // Show all events
    public function showEvents()
    {
        if(request('user', null) != null) {
            $events = Event::whereHas('users', function($query) {
                $query->where('id', request('user'));
            })->paginate(50);
            if ($events->count() == 0) {
                $title = 'Dieser Benutzer hat keine Events';
            }else{
                $title = 'Events von Benutzer: ' . User::find(request('user'))->name;
            }
        } else {
            $events = Event::orderBy('id')->paginate(50);
            $title = 'Alle Events';
        }
        $event_count = Event::count();
        $users = User::all();
        return view('admin.events', compact('events', 'users', 'event_count', 'title'));
    }

    // Show form to create new event
    public function createEvent()
    {
        return view('admin.events.create');
    }

    // Store new event
    public function storeEvent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => ['required','date','date_format:d.m.Y'],
            'start_date' => ['required','date','date_format:d.m.Y'],
            'end_date' => ['required','date','date_format:d.m.Y','after_or_equal:start_date'],
            'limit' => 'required|integer',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = Carbon::createFromFormat('d.m.Y', $request->start_date);
        $event->end_date = Carbon::createFromFormat('d.m.Y', $request->end_date);
        if($request->has('pre_registration_enabled')){
            $event->pre_registration_enabled = true;
            if($request->has('team_registration_enabled')){
                $event->team_registration_enabled = true;
            }else{
                $event->team_registration_enabled = false;
            }
        }else{
            $event->pre_registration_enabled = false;
            $event->team_registration_enabled = false;
        }
        
        if($request->has('limit')){
            if($request->limit > 0){
                $event->limit = $request->limit;
            }else{
                $event->limit = 0;
            }
        }

        if (request()->hasFile('preview_image')) {
            $imageURL = request()->file('preview_image')->store('public/events');

            $parameters['image_url'] = substr($imageURL, 7);

            Image::configure(array('driver' => 'gd'));

            Image::make(storage_path('app/public/' . $parameters['image_url']))
                ->heighten(300)
                ->save(storage_path('app/public/' . $parameters['image_url']));

            $event->preview_image = $parameters['image_url'];

        }

        $event->save();

        return redirect()->route('admin.events');
    }
}
