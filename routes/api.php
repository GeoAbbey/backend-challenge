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
        Route::get('/logout', 'Api\Auth\LoginController@logout')->middleware('auth:api');
    });

    Route::get('/me', 'Api\Me\MeController@me');

    Route::group(['prefix' => 'conferences', 'namespace' => 'Api\Conference'], function() {
        Route::get('/', 'ConferenceController@lists');
        Route::get('/{conference}', 'ConferenceController@show');
        Route::post('/', 'ConferenceController@store');
        Route::patch('/{conference}', 'ConferenceController@update');
        Route::delete('/{conference}', 'ConferenceController@delete');

        Route::post('/{conference}/tickets', 'TicketController@store');
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
        Route::delete('/{attendee}', 'AttendeeController@delete');

        Route::post('/auth/login', 'AuthController@login');
        Route::get('/auth/logout', 'AuthController@logout')->middleware('auth:attendee');

        Route::patch('/me', 'MeController@update');
        Route::get('/me', 'MeController@show');
    });
    Route::get('/attendees/tickets', 'Api\Conference\TicketController@lists');
});
