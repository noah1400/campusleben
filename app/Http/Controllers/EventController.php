<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Shows all the events that the user is attending.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myevents(){
        $events = auth()->user()->events;
        return view('events.myevents', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();

        return redirect()->route('events.show', $event->id);
    }

    public function attend(Request $request, int $id)
    {
        $user = auth()->user();
        if ($user->events->contains($id)){
            return redirect()->route('events.myevents');
        }
        $event = Event::findOrFail($id);
        $user->events()->attach($event);
        return redirect()->route('events.myevents');
    }

    public function attendShow(int $id)
    {
        $event = Event::findOrFail($id);
        return view('events.attendShow', compact('event'));
    }
    
    /**
     * Shows the event with the given id.
     * 
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id){
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }
}
