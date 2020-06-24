<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    public function talk (){
        $this->belongsToMany(Talk::class);
    }
}