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
Route::get('/checkout', 'PagesController@checkout')->name('checkout')->middleware('auth');
Route::get('/myaccount', 'PagesController@myaccount')->name('myaccount')->middleware('auth');
Route::get('/booking/{id}', 'PagesController@booking')->name('booking')->middleware('auth');

// Wishlist CRUD (index handled by 'myaccount' route above)
Route::get('/wishlist/create', 'WishlistController@create')->name('wishlist.create')->middleware('auth');
Route::post('/wishlist/store', 'WishlistController@store')->name('wishlist.store')->middleware('auth');
Route::delete('/wishlist/destroy/{id}', 'WishlistController@destroy')->name('wishlist.destroy')->middleware('auth');
Route::get('/wishlist/edit/{id}', 'WishlistController@edit')->name('wishlist.edit')->middleware('auth');
Route::patch('/wishlist/update/{id}', 'WishlistController@update')->name('wishlist.update')->middleware('auth');

// Ajax routes
Route::post('/search', 'AjaxController@search');
Route::post('/sessions', 'AjaxController@get_sessions');

// Standard POST/GET routes
Route::post('/updatecart', 'PostController@update_cart')->name('update_cart');
Route::post('/checkout', 'PostController@checkout')->name('checkout');