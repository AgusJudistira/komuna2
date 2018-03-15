<?php

Route::get('/', function(){

	return view('welcome');

});

Route::get('projects', 'ProjectsController@index');

Route::get('projects/{project}', 'ProjectsController@show')->where('project', '[0-9]+');

Route::get('projects/create', 'ProjectsController@create');

Route::post('/projects', 'ProjectsController@store');



