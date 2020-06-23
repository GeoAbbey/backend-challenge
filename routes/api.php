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

Route::group(['prefix' => 'auth'], function() {
   Route::post('/login', 'Api\Auth\LoginController@login');
});

Route::get('/me', 'Api\Me\MeController@me');
Route::get('/logout', 'Api\Me\MeController@logout');
