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
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
