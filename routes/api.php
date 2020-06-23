<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'apiLogger'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('/login', 'Api\Auth\LoginController@login');
    });

    Route::get('/me', 'Api\Me\MeController@me');
    Route::get('/logout', 'Api\Me\MeController@logout');

    Route::group(['prefix' => 'conferences', 'namespace' => 'Api\Conference'], function() {
        Route::get('/', 'ConferenceController@lists');
        Route::get('/{conference}', 'ConferenceController@show');
        Route::post('/', 'ConferenceController@store');
        Route::patch('/{conference}', 'ConferenceController@update');
        Route::delete('/{conference}', 'ConferenceController@delete');
    });

    Route::group(['prefix' => 'speakers', 'namespace' => 'Api\Speaker'], function() {
        Route::get('/', 'SpeakerController@lists');
        Route::post('/', 'SpeakerController@store');
        Route::patch('/{speaker}', 'SpeakerController@update');
        Route::delete('/{speaker}', 'SpeakerController@delete');
    });

    Route::group(['prefix' => 'attendees', 'namespace' => 'Api\Attendee'], function() {
        Route::get('/', 'AttendeeController@lists');
        Route::post('/', 'AttendeeController@store');
        Route::patch('/{attendee}', 'AttendeeController@update');
        Route::delete('/{attendee}', 'AttendeeController@delete');
    });
});
