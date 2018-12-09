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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// list books
Route::get('books', 'BookController@index');

// list single book
Route::get('book/{id}', 'BookController@show');

// create new book
Route::post('book', 'BookController@store');

// update book
Route::put('book', 'BookController@store');

// delete book
Route::delete('book/{id}', 'BookController@destroy');