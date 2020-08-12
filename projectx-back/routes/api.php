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
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');


Route::post('/users/{id}/update', 'UserController@update');
Route::post('/users/{id}/destroy', 'UserController@destroy');
Route::get('/users/{id}', 'UserController@show');

Route::get('/users/{id}/tutos', 'UserController@myTutos');
Route::post('/users/me/tutos/add', 'UserController@add');
Route::post('/users/me/tutos/delete', 'UserController@del');


Route::post('/tutos/create', 'TutoController@store');
Route::get('/tutos/{id}', 'TutoController@show');
Route::post('/tutos/{id}/destroy', 'TutoController@destroy');
Route::post('/tutos/{id}/update', 'TutoController@update');
Route::get('/tutos/search/{searchField}', 'TutoController@search');

Route::get('/tutos', 'TutoController@index');




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
