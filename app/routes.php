<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
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
