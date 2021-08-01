<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::get('v1/todo', 'ApiController@getAllTodos');
Route::get('v1/todo/{id}', 'ApiController@getTodo');
Route::post('v1/todo', 'ApiController@createTodo');
Route::put('v1/todo/{id}', 'ApiController@updateTodo');
Route::delete('v1/todo/{id}','ApiController@deleteTodo');