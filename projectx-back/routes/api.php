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
Route::post('/logout', 'UserController@logout');

Route::post('/tutos/search', 'TutoController@search');
Route::get('/tutos', 'TutoController@index');

Route::middleware('authorize')->group(function () {

    Route::get('/users', 'UserController@all');
    Route::post('/users/me/tutos/add', 'UserController@add');
    Route::post('/users/me/tutos/delete', 'UserController@del');
    Route::post('/users/{id}/update', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@destroy')->middleware('admin');
    Route::get('/users/{id}', 'UserController@show');
    Route::get('/users/{id}/tutos', 'UserController@myTutos');

    Route::post('/tutos', 'TutoController@store');
    Route::get('/tutos/all', 'TutoController@all')->middleware('admin');

    Route::get('/tutos/{id}', 'TutoController@show');

    Route::delete('/tutos/{id}', 'TutoController@destroy')->middleware('admin');
    Route::resource('langages', 'LangageController');

    Route::post('/tutos/{id}/archive', 'TutoController@archive');
    Route::post('/tutos/{id}/update', 'TutoController@update');

});




Route::get('/tutos/{id}/download', 'TutoController@download');
