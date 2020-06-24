<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//add talk
Route::post('/talk/add', ['uses' => 'TalksController@add']);

Route::post('/attendee/add', ['uses' => 'AttendeesController@create']);

//add attendee to talk
Route::post('/talk/attendee/add', ['uses' => 'AttendeesController@add']);

Route::delete('/talk/delete/{talk_id}', ['uses' => 'TalksController@delete']);

