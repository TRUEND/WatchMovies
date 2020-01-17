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

Route::get('/', "WelcomeController@index")->name("index.logout");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{nickname}', 'UserController@index')->name('user.profile');

Route::patch('/profile/{nickname}', 'UserController@update')->name('profile.update');



