<?php

Route::get('/', function(){

	return view('welcome');


});

Route::get('projects', 'ProjectsController@index');

Route::get('projects/{project}', 'ProjectsController@show')->where('project', '[0-9]+');

Route::get('projects/create', 'ProjectsController@create');

Route::post('/projects', 'ProjectsController@store');




Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Route::get('/user-login', 'Auth\LoginController@showLoginForm')->name('user.login');
Route::post('/user-login', 'Auth\LoginController@userLogin')->name('user.login.submit');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

