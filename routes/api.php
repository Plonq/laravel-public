<?php

use Illuminate\Http\Request;

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

Route::post('login', 'LoginApiController@login');

Route::get('movies', 'MoviesApiController@index');
Route::get('movies/{movie}', 'MoviesApiController@show');
Route::post('movies', 'MoviesApiController@store');
Route::put('movies/{movie}', 'MoviesApiController@update');
Route::delete('movies/{movie}', 'MoviesApiController@delete');

Route::get('genres', 'GenresApiController@index');

Route::get('ratings', 'RatingsApiController@index');

Route::get('movie_sessions', 'MovieSessionsApiController@index');
Route::get('movie_sessions/by_movie/{movie_id}', 'MovieSessionsApiController@for_movie');
Route::get('movie_sessions/{movie_session}', 'MovieSessionsApiController@show');
Route::post('movie_sessions', 'MovieSessionsApiController@store');
Route::put('movie_sessions/{movie_session}', 'MovieSessionsApiController@update');
Route::delete('movie_sessions/{movie_session}', 'MovieSessionsApiController@delete');

Route::get('cinemas', 'CinemasApiController@index');
Route::get('cinemas/{cinema}', 'CinemasApiController@show');
Route::post('cinemas', 'CinemasApiController@store');
Route::put('cinemas/{cinema}', 'CinemasApiController@update');
Route::delete('cinemas/{cinema}', 'CinemasApiController@delete');

Route::get('bookings', 'BookingsApiController@index');
Route::get('bookings/{booking}', 'BookingsApiController@show');

Route::get('tickets', 'TicketsApiController@index');
Route::get('tickets/{ticket}', 'TicketsApiController@show');
Route::post('tickets', 'TicketsApiController@store');
Route::put('tickets/{ticket}', 'TicketsApiController@update');
Route::delete('tickets/{ticket}', 'TicketsApiController@delete');

Route::get('ticket_types', 'TicketTypesApiController@index');
Route::get('ticket_types/{ticket_type}', 'TicketTypesApiController@show');
Route::post('ticket_types', 'TicketTypesApiController@store');
Route::put('ticket_types/{ticket_type}', 'TicketTypesApiController@update');
Route::delete('ticket_types/{ticket_type}', 'TicketTypesApiController@delete');

Route::get('users', 'UsersApiController@index');
Route::get('users/{user}', 'UsersApiController@show');
Route::post('users', 'UsersApiController@store');
Route::put('users/{user}', 'UsersApiController@update');
Route::delete('users/{user}', 'UsersApiController@delete');
