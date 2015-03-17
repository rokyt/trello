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

Route::any('/connect/{network}/go',         'ConnectController@getConnectToNetwork');
Route::any('/connect/{network}/callback',   'ConnectController@getCallbackFromNetwork');

Route::get('/api/boards', 					'ApiController@getBoardsAndList');
Route::get('/', 							'HomeController@index');
