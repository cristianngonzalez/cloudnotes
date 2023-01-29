<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\Event;

class EventsController extends Controller{
    //

    public function all(){
        $events = Event::all();
        return response()->json($events);
    }

    public function set(Request $req){

        $event = new Event();
        $event->user_id = $req->user_id;
        $event->title = $req->title;
        $event->end = $req->end;
        $event->start = $req->start;

        $event->save();
        
        return $event;
        
    }

    public function delete(Request $req){

        $event = Event::find($req->id);
        $event->delete();

        return $event;
    }
}
