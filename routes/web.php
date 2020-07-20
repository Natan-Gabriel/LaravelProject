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
    $hubs = \App\Hub::all();

    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::resource('/hubs', 'HubController');
Route::delete('/hubs/delete/{id}', 'HubController@destroy');
//Route::patch('/hubs/{id}/edit', 'HubController@edit');

Route::get('/hubs', function () {
    $hubs = \App\Hub::all();

    return view('hubs', ['hubs' => $hubs]);
});



Route::resource('/aircrafts', 'AircraftController');
Route::delete('/aircrafts/delete/{id}', 'AircraftController@destroy');
//Route::patch('/aircrafts/{id}/edit', 'AircraftController@edit');

Route::get('/aircrafts', function () {
    $aircrafts = \App\Aircraft::all();

    return view('aircrafts', ['aircrafts' => $aircrafts]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
