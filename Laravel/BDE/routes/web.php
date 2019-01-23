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
Route::group(['middleware' => IpFilter::class], function () {
    Route::post('/api/register', 'ApiController@register');
    Route::put('/api/profile', 'ApiController@updateSelf');
    Route::put('/api/users/{id}', 'ApiController@updateUser');
});

// Notifications
Route::get('/notifications', 'NotificationsController@index')->middleware('auth');
Route::delete('/notifications/{notification}', 'NotificationsController@delete')->middleware('auth');

Route::get('ideas', 'IdeasController@index' );