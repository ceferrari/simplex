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
	Route::get('settings', ['as' => 'home.settings', 'uses' => 'HomeController@getSettings']);
	Route::post('settings', ['as' => 'home.settings', 'uses' => 'HomeController@postSettings']);
	Route::get('variables', ['as' => 'home.variables', 'uses' => 'HomeController@getVariables']);
	Route::post('variables', ['as' => 'home.variables', 'uses' => 'HomeController@postVariables']);
	Route::get('table', ['as' => 'home.table', 'uses' => 'HomeController@getTable']);
	Route::post('table', ['as' => 'home.table', 'uses' => 'HomeController@postTable']);
	Route::get('solution', ['as' => 'home.solution', 'uses' => 'HomeController@getSolution']);
	Route::post('solution', ['as' => 'home.solution', 'uses' => 'HomeController@postSolution']);
	Route::get('solution/final', ['as' => 'home.finalSolution', 'uses' => 'HomeController@postFinalSolution']);
	Route::get('sensitivity', ['as' => 'home.sensitivity', 'uses' => 'HomeController@getSensitivity']);
});
