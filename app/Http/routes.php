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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::auth();

Route::get('/', 'VideoController@index');

Route::get('/video/create', 'VideoController@create');
Route::get('/video/{id}/edit', 'VideoController@edit');
Route::get('/video/my-videos', 'VideoController@myVideos');
// Route::get('/video', 'VideoController@index');
Route::post('/video/{id}', 'VideoController@update');
Route::post('/video', 'VideoController@store');
Route::get('/video/search', 'VideoController@search');
Route::delete('video/{id}/destroy', 'VideoController@destroy');
Route::get('/category/{id}/videos', 'CategoryController@videos');
Route::get('/video/{id}/show', 'VideoController@show');
Route::post('/video/{id}/comment', 'CommentsController@create');