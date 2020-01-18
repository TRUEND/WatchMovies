<?php

Route::get('/', "WelcomeController@index")->name("index.logout");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{nickname}', 'UserController@index')->name('user.profile');

Route::patch('/profile/{nickname}', 'UserController@update')->name('profile.update');

Route::post('/auth_user/ajax/', 'UserController@auth_user')->name('auth_user.ajax');

Route::post('/movies/{nickname}/store', 'MovieController@store')->name('movie.store');

route::get('/movies/{nickname}/favorites', 'MovieController@favorites')->name('user.favorites');

Route::delete('/movies/favorites/{id}', 'MovieController@destroy')->name('favorite.destroy');

