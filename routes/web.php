<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//show a list of projects
Route::get('projects', 'ProjectsController@index')->name('project_index');

//detailed view of ONE project
Route::get('projects/{project}', 'ProjectsController@show')->where('project', '[0-9]+');

//show edit form of an existing project
Route::post('projects/edit', 'ProjectsController@edit');

Route::post('projects/seekMembers', 'ProjectsController@seekMembers');

// get details about a volunteer before inviting.
Route::get('projects/showInvitee/{project}/{invitee}', 'ProjectsController@showInvitee')->where(['project' => '[0-9]+', 'invitee' => '[0-9]+']);

// invite a volunteer to join project
Route::post('projects/prepare_invitation', 'ProjectsController@prepareInvitation');
Route::post('projects/send_invitation', 'ProjectsController@sendInvitation');

//inquiry without possible action
Route::post('projects/send_inquiry', 'ProjectsController@sendInquiry');

//reply to an inquiry
Route::post('projects/send_reply', 'ProjectsController@sendReplyMessage');

//save an existing/modified project
Route::post('/projects/save_existing/{project}', 'ProjectsController@save_existing')->where('project', '[0-9]+');

//show input form for a new project
Route::post('projects/create', 'ProjectsController@create');

//save a new project
Route::post('/projects', 'ProjectsController@store');

//accept or refuse an applicant (input from message)
Route::post('/projects/decide', 'ProjectsController@decide');

//show search results
Route::post('projects.index', 'ProjectsController@search');

//show join project form after pressing project join button
Route::get('/projects/join/{project}', 'ProjectsController@prepareJoinMessage')->where('project', '[0-9]+');
// message to join is created and sent (linked to sender and receiver)
//Route::get('/messages/send/{project}', 'ProjectsController@sendJoinProjectMessage')->where('project', '[0-9]+');
Route::get('/projects/send_join_request/{project}', 'ProjectsController@sendJoinProjectMessage');
//show a list of messages
Route::get('/messages/msg-index', 'MessagesController@showMessages');
//read one message
Route::get('/messages/msg-show/{message}', 'MessagesController@focusMessage')->where('message', '[0-9]+');


Route::post('/organizations/org-input-form', 'OrganizationsController@showInputForm')->name('org.inputform');
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

//update user profile

//view NAW
Route::get('/users/{user}',  ['as' => 'users.edit_personal', 'uses' => 'UsersController@edit'])->where('user', '[0-9]+');

//updat NAW
Route::patch('/users/{user}/update',  ['as' => 'users.update', 'uses' => 'UsersController@update'])->where('user', '[0-9]+');

//show active avatar
Route::get('/users/{user}/edit_avatar',  ['as' => 'users.edit_avatar', 'uses' => 'UsersController@editAvatar'])->where('user', '[0-9]+');
//update avatar
Route::post('/users/{user}/update_avatar',  ['as' => 'users.update_avatar', 'uses' => 'UsersController@updateAvatar'])->where('user', '[0-9]+');

//show active competences
Route::get('/users/{user}/edit_competences',  ['as' => 'users.edit_competences', 'uses' => 'UsersController@editCompetences'])->where('user', '[0-9]+');

//attach competences to user
Route::post('/users/{user}/update_competences',  ['as' => 'users.update_competences', 'uses' => 'UsersController@addCompetences'])->where('user', '[0-9]+');

//detacth competences from user
Route::post('/users/{user}/detach_competences',  ['as' => 'users.detach_competences', 'uses' => 'UsersController@detachCompetences'])->where('user', '[0-9]+');

//show competences for creations
Route::get('/competences/create_competences',  ['as' => 'competences.create_competences', 'uses' => 'CompetencesController@createCompetences']);

//create competences
Route::post('/competences/update_competences',  ['as' => 'competences.update_competences', 'uses' => 'CompetencesController@storeCompetences']);
