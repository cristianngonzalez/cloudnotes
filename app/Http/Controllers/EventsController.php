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

    public function set(){

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }
}
