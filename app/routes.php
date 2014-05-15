<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Homepage
 */
Route::get('/', function()
{
	return View::make('index'); // will return app/views/index.php
});

/**
 * API routes
 */
 
Route::group(array('prefix' => 'api'), function() {
	Route::resource('goals', 'GoalController');
});

/**
 * Catch all route
 */
App::missing(function($exception){
	return View::make('index');
});
