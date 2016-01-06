<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => []], function () {
    Route::get('/events', 'EventController@index');
    Route::get('/events/create', 'EventController@create');
    Route::get('/events/edit/{id}', 'EventController@edit');

    Route::post('/events', 'EventController@store');
    Route::post('/events/{id}', 'EventController@update');
    Route::post('/events/reorder/{id}', 'EventController@reorder');
    
    Route::delete('/events/{id}', 'EventController@destroy');
        
});
