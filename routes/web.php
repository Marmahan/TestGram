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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//create a post (show the form)
Route::get('/p/create', 'PostsController@create');

//show a post
Route::get('/p/{post}', 'PostsController@show');

//Store a new post
Route::post('/p', 'PostsController@store');

//show a user profile
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

// Auth::routes();

// Route::get('/home', 'ProfilesController@index')->name('home');
