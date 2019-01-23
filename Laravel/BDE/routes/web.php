<?php

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
    return view('home');
});

Auth::routes();

// Notifications
Route::get('/notifications', 'NotificationsController@index')->middleware('auth');
Route::delete('/notifications/{notification}', 'NotificationsController@delete')->middleware('auth');