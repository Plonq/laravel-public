<?php

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

Auth::routes();
Route::get('/', 'PagesController@home')->name('home');
Route::get('/movies', 'PagesController@movies')->name('movies');
Route::get('/search', 'PagesController@search')->name('search');

// Ajax routes
Route::post('/search', 'AjaxController@search');