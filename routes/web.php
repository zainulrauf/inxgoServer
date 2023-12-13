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
    return view('view.upload');
});
Route::get('/login/google', 'SocialController@redirectToGoogle');
Route::get('/login/google/callback', 'SocialController@handleGoogleCallback');

Route::any('/notAcess', 'UserAPIController@redirect')->name('notAcess');