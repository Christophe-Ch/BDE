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

use App\Http\Middleware\IpFilter;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// API
Route::post('/api/register', 'ApiController@register')->middleware(IpFilter::class);
Route::post('/api/profile', 'ApiController@update')->middleware(IpFilter::class);

// Notifications
Route::get('/notifications', 'NotificationsController@index')->middleware('auth');
Route::delete('/notifications/{notification}', 'NotificationsController@delete')->middleware('auth');