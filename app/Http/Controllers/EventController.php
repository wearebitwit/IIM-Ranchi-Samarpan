<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();

        if($request->has('name'))
            $event->name = $request->input('name');

        if($request->has('data'))
            $event->data = json_encode($request->input('data')); 

        if($event->insert())
            response()->json(['erroxr' => false]);
        else
            response()->json(['errxor' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Event::find($id);
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
        $event = Event::find($id);

        if($request->has('name'))
            $event->name = $request->input('name');

        if($request->has('data'))
            $event->data = $request->input('data');
            
        if($event->save())
            response()->json(['error' => false]);
        else
            response()->json(['error' => true]);
    }

    /**
     * Reorder the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request, $id)
    {
        $event = Event::find($id);

        if($request->has('index'))
            $prevIndex = $request->input('index');

        if($request->has('diff'))
            $diff = $request->input('diff');
            
        if(Event::reorder($id, $prevIndex, $diff))
            response()->json(['error' => false]);
        else
            response()->json(['error' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $max = Event::max('index');
        
        $diff = $max - $event->index;
        
        Event::reorder($id, $event->index, $diff);
        
        if(Event::destroy($id))
            response()->json(['error' => false]);
        else
            response()->json(['error' => true]);       
    }
}
