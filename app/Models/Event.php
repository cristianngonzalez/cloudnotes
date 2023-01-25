<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{
    use HasFactory;

    public function user(){
        //Each event has only a user
        return $this->belongsTo('App\Models\User' , 'user_id');
    }

}
