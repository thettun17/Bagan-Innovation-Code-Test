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

Route::get('/', 'TblBookController@showblade')->name('home');
Route::get('books', 'TblBookController@index')->name('book.index');

Route::get('/create', 'TblBookController@create')->name('create');
Route::get('book-edit/{id}', 'TblBookController@edit');
Route::put('book-update/{id}', 'TblBookController@update');
Route::get('book-destry', 'TblBookController@destroy');

Route::post('book/create', 'TblBookController@store');
