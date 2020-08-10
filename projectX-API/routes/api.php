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
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::post('/users/{id}/update', 'UserController@update');
Route::post('/users/{id}/destroy', 'UserController@destroy');
Route::get('/users/{id}', 'UserController@show');


Route::post('/tutos/create', 'TutoController@store');
Route::get('/tutos/{id}', 'TutoController@show');
Route::post('/tutos/{id}/destroy', 'TutoController@destroy');
Route::post('/tutos/{id}/update', 'TutoController@update');
Route::get('/tutos', 'TutoController@index');




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
