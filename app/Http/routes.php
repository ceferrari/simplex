<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => '/'], function() {
	Route::get('', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::post('variables', ['as' => 'home.variables', 'uses' => 'HomeController@variables']);
	Route::post('table', ['as' => 'home.table', 'uses' => 'HomeController@table']);
	Route::post('solution', ['as' => 'home.solution', 'uses' => 'HomeController@solution']);
	Route::get('back', ['as' => 'home.back', 'uses' => 'HomeController@back']);
});
