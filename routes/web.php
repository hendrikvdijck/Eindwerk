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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/media', 'MediaController')->middleware('auth');
Route::resource('/players', 'PlayerController')->middleware('auth');
Route::resource('/positions', 'PositionController')->middleware('auth');
Route::resource('/teams', 'TeamController')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');
Route::post('/userteams/addUser', 'TeamController@addUserToTeam')->middleware('auth');

// Team toevoegen nodig? anders kans op toevoegen van random teams andere personen
// Route::post('/userteams/addTeam', 'TeamController@addTeamToUser')->middleware('auth');


Route::get('/players/{id}/deleteImage', 'PlayerController@deleteImage');
