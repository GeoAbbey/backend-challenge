<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    //
    public function attendees (){
        $this->hasMany(Attendee::class);
    }
}