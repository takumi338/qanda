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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','PostController@index')->name('index');

Route::get('/posts/create','PostController@create')->name('create');
Route::post('/posts/store','PostController@store')->name('store');

Route::get('/posts/{id}','PostController@show')->name('show');

Route::get('/posts/edit/{id}','PostController@edit')->name('edit');
Route::post('/posts/update','PostController@update')->name('update');

Route::post('/posts/destroy/{id}','PostController@destroy')->name('destroy');

