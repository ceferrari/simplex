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
	Route::post('', ['as' => 'home.store', 'uses' => 'HomeController@store']);
});

Route::group(['prefix' => 'variables'], function() {
	Route::get('', ['as' => 'variables.index', 'uses' => 'VariablesController@index']);
	Route::post('', ['as' => 'variables.store', 'uses' => 'VariablesController@store']);
});