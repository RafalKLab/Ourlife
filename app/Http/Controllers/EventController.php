<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Auth::user()->events()->orderBy('event_date', 'desc')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'eventTitle' => 'required|max:300|min:3',
            'eventText' => 'required|max:1000|min:10',
            'eventDate' => 'required|'
        ]);
        $newImageName = time() . '-' . $request->eventTitle . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $newImageName);
        Auth::user()->events()->create([
            'title' => $request->input('eventTitle'),
            'body' => $request->input('eventText'),
            'event_date' => $request->input('eventDate'),
            'foto_path' => $newImageName
        ]);
        return redirect()->route('events.get')->with('success', 'Event has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $image_path = public_path("images/") . $event->foto_path;
        unlink($image_path);
        $event->delete();
        return redirect()->route('events.get')->with('success', 'Event has been deleted!');

    }
}
