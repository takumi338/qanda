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

// Route::get('/','PostController@index')->name('index');

// Route::get('/posts/create','PostController@create')->name('create')->middleware('auth');
// Route::post('/posts/store','PostController@store')->name('store')->middleware('auth');

// Route::get('/posts/{id}','PostController@show')->name('show');

// Route::get('/posts/edit/{id}','PostController@edit')->name('edit')->middleware('auth');
// Route::post('/posts/update','PostController@update')->name('update')->middleware('auth');

// Route::post('/posts/destroy/{id}','PostController@destroy')->name('destroy')->middleware('auth');

//user

Route::get('/users/{id}','UserController@show')->name('usershow')->middleware('auth');

Route::get('/users/edit/{id}','UserController@edit')->name('usersedit')->middleware('auth');
Route::post('/users/update','UserController@update')->name('usersupdate')->middleware('auth');

Route::get('/', 'PostController@index')->name('posts.index');
Route::resource('/posts', 'PostController')->except(['index', 'show'])->middleware('auth');
Route::resource('/posts', 'PostController')->only(['show']);