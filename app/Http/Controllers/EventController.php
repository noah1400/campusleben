<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //get all events that are not expired
        $events = Event::whereDate('end_date', '>=', Carbon::now())->get();
        return view('events.index', compact('events'));
    }

    public function archive(){
        //get all events that are expired
        $events = Event::whereDate('end_date', '<', Carbon::now())->get();
        return view('events.archive', compact('events'));
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

    

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => ['required','date','date_format:d.m.Y'],
            'end_date' => ['required','date','date_format:d.m.Y','after_or_equal:start_date'],
            'preview_image' => 'image|nullable|max:1999',
            'limit' => 'required|integer',
        ]);
        $event = Event::findOrFail($id);
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
        //Convert date to format d.m.Y
        $event->start_date = Carbon::parse($event->start_date)->format('d.m.Y');
        $event->end_date = Carbon::parse($event->end_date)->format('d.m.Y');
        return view('events.show', compact('event'));
    }

    public function close(int $id)
    {
        $event = Event::findOrFail($id);
        $event->closed = true;
        $event->save();
        return redirect()->route('events.show', ['id' => $id]);
    }

    public function open(int $id)
    {
        $event = Event::findOrFail($id);
        $event->closed = false;
        $event->save();
        return redirect()->route('events.show', ['id' => $id]);
    }

    public function delete(int $id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index');
    }
}
