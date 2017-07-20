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

// Public accessible
Route::get('/', 'PagesController@home')->name('home');
Route::get('/movies', 'PagesController@movies')->name('movies');
Route::get('/movie/{id}', 'PagesController@movie')->name('movie');
Route::get('/cinema/{id}', 'PagesController@cinema')->name('cinema');
Route::get('/search', 'PagesController@search')->name('search');
Route::get('/session/{id}', 'PagesController@session')->name('session');
Route::get('/cart', 'PagesController@cart')->name('cart');

// Auth required

// Ajax routes
Route::post('/search', 'AjaxController@search');
Route::post('/sessions', 'AjaxController@get_sessions');
Route::post('/cart', 'AjaxController@add_to_cart');