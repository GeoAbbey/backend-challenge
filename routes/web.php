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

Route::get('/', 'Web\Conference\ConferenceController@index')->name('home');

Route::get('/conferences/{id}', 'Web\Conference\ConferenceController@show');

Route::group(['prefix' => 'auth'], function() {
    Route::get('/register', 'Web\Auth\RegisterController@show')->name('register');
    Route::get('/login', 'Web\Auth\LoginController@show')->name('login');
});
