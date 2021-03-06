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
    return view('welcome');

    Route::get('v1/todo', 'ApiController@getAllTodos');
	Route::get('v1/todo/{id}', 'ApiController@getTodo');
	Route::post('v1/todo', 'ApiController@createTodo');
	Route::put('v1/todo/{id}', 'ApiController@updateTodo');
	Route::delete('v1/todo/{id}','ApiController@deleteTodo');
});
