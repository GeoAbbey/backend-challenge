<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TalksController extends Controller
{
    //
    public function add(Request $request)
    {
        //validate
        validator([
            'title' => 'required',
            'talk_detail' => 'required',
            'speaker'  => 'required'
        ]); //validates request 

        $talk = new Talk();
        $talk->title = $request->title;
        $talk->talk_detail = $request->talk_detail;
        $talk->speaker = $request->speaker;
        $created_talk = $talk->save();

        if ($created_talk) {
            return response($content =['message' => 'Talk created successfully', 'data' => [], 'response'=> 'created'], 201);
        }else{
            return response($content =['message' => 'Talk not created', 'data' => $php_errormsg, 'response'=> 'error'], 400);
        }
    }

}
