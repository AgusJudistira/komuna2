<?php

Route::get('/projects', 'ProjectsController@index');

Route::get('projects/{projects}', 'ProjectsController@show');




