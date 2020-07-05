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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','PostContorller@index');

//resource route ko use yin resource controller create
Route::resource('post', 'PostContorller');

Route::resource('category','CategoryController');

Route::resource('comment','CommentController');

Route::post('getcomments', 'CommentController@getcomments')->name('getcomments');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profile', 'ProfileController');