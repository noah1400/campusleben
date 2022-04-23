<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'preview_image' => 'image|mimes:jpg,png,jpeg,gif,svg|nullable|max:1999',
            'limit' => 'required|integer',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
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

        return redirect()->route('events.show', $event->id);
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'preview_image' => 'image|nullable|max:1999',
            'limit' => 'required|integer',
        ]);
        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
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

            $previousImage = $event->preview_image;
            //delete previous image
            if($previousImage != null){
                if(file_exists(storage_path('app/public/' . $previousImage))){
                    unlink(storage_path('app/public/' . $previousImage));
                }
            }

            $event->preview_image = $parameters['image_url'];

        }



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

    public function close(int $id)
    {
        $event = Event::findOrFail($id);
        $event->pre_registration_enabled = false;
        $event->save();
        return redirect()->route('events.show', ['id' => $id]);
    }

    public function open(int $id)
    {
        $event = Event::findOrFail($id);
        $event->pre_registration_enabled = true;
        $event->save();
        return redirect()->route('events.show', ['id' => $id]);
    }

    public function delete(int $id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index');
    }
}
