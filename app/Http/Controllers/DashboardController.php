<?php

namespace App\Http\Controllers;

use App\Talk;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    //
    public function index (){
    if (session()->has('user_id')) //check if session exists
    {   
        $talks = Talk::all();
        $user_id = session()->get('user_id');
        $user = User::find($user_id);
        return view('dashboard')->with(['user' => $user,  'talks' => $talks]);
    }
    $error = 'You are not Authorized to View this Page kindly log in here to view';
    return view(('login'))->with(['issue' => $error]);
}
}
