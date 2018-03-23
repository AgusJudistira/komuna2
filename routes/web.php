<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//show a list of projects
Route::get('projects', 'ProjectsController@index');

//detailed view of ONE project
Route::get('projects/{project}', 'ProjectsController@show')->where('project', '[0-9]+');

//show edit form of an existing project
Route::get('projects/edit/{project}', 'ProjectsController@edit')->where('project', '[0-9]+');

//save an existing/modified project
Route::post('/projects/save_existing/{project}', 'ProjectsController@save_existing')->where('project', '[0-9]+');

//show input form for a new project
Route::get('projects/create', 'ProjectsController@create');

//save a new project
Route::post('/projects', 'ProjectsController@store');

//accept or refuse an applicant
Route::post('/projects/decide', 'ProjectsController@decide');

//show search results
Route::post('projects.index', 'ProjectsController@search');

//show join project form after pressing project join button
Route::get('/projects/join/{project}', 'ProjectsController@join')->where('project', '[0-9]+');
// message to join is created and sent (linked to sender and receiver)
Route::get('/messages/send/{project}', 'ProjectsController@joinProjectMessage')->where('project', '[0-9]+');

//show a list of messages
Route::post('/messages/msg-index', 'MessagesController@showMessages');
//read one message
Route::get('/messages/msg-show/{message}', 'MessagesController@focusMessage')->where('message', '[0-9]+');


Route::get('/organizations/org-input-form', 'OrganizationsController@showInputForm')->name('org.inputform');
Route::post('/organizations', 'OrganizationsController@saveOrganization');
Route::get('organizations', 'OrganizationsController@org_index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Route::get('/user-login', 'Auth\LoginController@showLoginForm')->name('user.login');
Route::post('/user-login', 'Auth\LoginController@userLogin')->name('user.login.submit');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

//edit user profile
Route::get('/users/{user}',  ['as' => 'users.edit_personal', 'uses' => 'UsersController@edit']);
Route::patch('/users/{user}/update',  ['as' => 'users.update', 'uses' => 'UsersController@update']);
Route::get('/users/{user}/edit_avatar',  ['as' => 'users.edit_avatar', 'uses' => 'UsersController@editAvatar']);
Route::post('/users/{user}/update_avatar',  ['as' => 'users.update_avatar', 'uses' => 'UsersController@updateAvatar']);
Route::get('/users/{user}/edit_competences',  ['as' => 'users.edit_competences', 'uses' => 'UsersController@editCompetences']);
Route::post('/users/{user}/update_competences',  ['as' => 'users.update_competences', 'uses' => 'UsersController@updateCompetences']);

//create competences
Route::get('/competences/create_competences',  ['as' => 'competences.create_competences', 'uses' => 'CompetencesController@createCompetences']);
Route::post('/competences/update_competences',  ['as' => 'competences.update_competences', 'uses' => 'CompetencesController@updateCompetences']);

Route::get('/users/{user}/edit_competences',  ['as' => 'users.edit_competences', 'uses' => 'competencesController@editCompetences']);
Route::post('/users/{user}/update_competences',  ['as' => 'users.update_competences', 'uses' => 'competencesController@updateCompetences']);
