<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//show a list of projects
Route::get('projects', 'ProjectsController@index')->name('project_index');

//detailed view of ONE project
Route::get('projects/{project}', 'ProjectsController@show')->name('project_show')->where('project', '[0-9]+');

//show edit form of an existing project
Route::post('projects/edit/{project}', 'ProjectsController@edit')->name('project_edit')->where('project', '[0-9]+');

// Route::post('projects/edit/{project}', array(
//     'uses' => 'ProjectsController@edit',
//     'as'   => 'project_edit'
// ))->where('project', '[0-9]+');

Route::get('projects/seekMembers/{project}', 'ProjectsController@seekMembers')->name('seek_members')->where('project', '[0-9]+');

// get details about a volunteer before inviting.
Route::get('projects/showInvitee/{project}/{user}', 'ProjectsController@showInvitee')->where(['project' => '[0-9]+', 'user' => '[0-9]+']);

// invite a volunteer to join project
Route::post('projects/prepare_invitation', 'ProjectsController@prepareInvitation');
Route::post('projects/send_invitation', 'ProjectsController@sendInvitation');

//inquiry without possible action
Route::post('projects/send_personal_inquiry', 'ProjectsController@sendPersonalInquiry');
Route::post('projects/send_project_inquiry', 'ProjectsController@sendProjectInquiry');

//reply to an inquiry
Route::post('projects/send_reply', 'ProjectsController@sendReplyMessage');

//save an existing/modified project
Route::post('/projects/save_existing/{project}', 'ProjectsController@save_existing')->where('project', '[0-9]+');

//show input form for a new project
Route::post('projects/create', 'ProjectsController@create');

//save a new project and go to add skills screen
Route::post('/projects/store', 'ProjectsController@store');

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


Route::get('/projects/{project}/edit_skills',  ['as' => 'projects.edit_skills', 'uses' => 'ProjectsController@editSkills'])->where('project', '[0-9]+');

Route::post('/projects/{project}/store_skills',  ['as' => 'projects.store_skills', 'uses' => 'ProjectsController@storeSkill'])->where('project', '[0-9]+');

Route::post('/projects/{project}/detach_skills',  ['as' => 'projects.detach_skills', 'uses' => 'ProjectsController@detachSkills'])->where('project', '[0-9]+');


Route::get('/projects/{project}/edit_competences',  ['as' => 'projects.edit_competences', 'uses' => 'ProjectsController@editCompetences'])->where('project', '[0-9]+');
//attach competences to project
Route::post('/projects/{project}/update_competences',  ['as' => 'projects.update_competences', 'uses' => 'ProjectsController@addCompetences'])->where('project', '[0-9]+');
//detacth competences from project
Route::post('/projects/{project}/detach_competences',  ['as' => 'projects.detach_competences', 'uses' => 'ProjectsController@detachCompetences'])->where('project', '[0-9]+');


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

//Admin edit competences
Route::get('/admin/edit_competences',  ['as' => 'admin.edit_competences', 'uses' => 'CompetencesController@editCompetences']);

//Admin edit create competences
Route::post('/admin/update_competences',  ['as' => 'admin.update_competences', 'uses' => 'CompetencesController@storeCompetences']);
//Admin delete competences
Route::post('/admin/delete_competences',  ['as' => 'admin.delete_competences', 'uses' => 'CompetencesController@deleteCompetences']);

//update user profile

//view NAW
Route::get('/users/{user}/edit_personal',  ['as' => 'users.edit_personal', 'uses' => 'UsersController@edit'])->where('user', '[0-9]+');

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

//edit project experience
Route::get('/users/{user}/edit_projectExperience',  ['as' => 'users.edit_projectExperience', 'uses' => 'UsersController@editProjectExperience'])->where('user', '[0-9]+');

//edit project experience
Route::post('/users/{user}/detach_projects',  ['as' => 'users.detach_projects', 'uses' => 'UsersController@detachProjects'])->where('user', '[0-9]+');

//edit work experience
Route::get('/users/{user}/edit_workExperience',  ['as' => 'users.edit_workExperience', 'uses' => 'UsersController@editWorkExperience'])->where('user', '[0-9]+');

//update workExperience
Route::post('/users/{user}/update_workExperience',  ['as' => 'users.update_workExperience', 'uses' => 'UsersController@storeWorkExperience'])->where('user', '[0-9]+');

//edit study experience
Route::get('/users/{user}/edit_studyExperience',  ['as' => 'users.edit_studyExperience', 'uses' => 'UsersController@editStudyExperience'])->where('user', '[0-9]+');

//study workExperience
Route::post('/users/{user}/update_studyExperience',  ['as' => 'users.update_studyExperience', 'uses' => 'UsersController@storeStudyExperience'])->where('user', '[0-9]+');

//edit skills
Route::get('/users/{user}/edit_skills',  ['as' => 'users.edit_skills', 'uses' => 'UsersController@editSkills'])->where('user', '[0-9]+');

//sla skills op en koppel ze aan gerbruiker
Route::post('/users/{user}/store_skills',  ['as' => 'users.store_skills', 'uses' => 'UsersController@storeSkill'])->where('user', '[0-9]+');

//detach skills from user
Route::post('/users/{user}/detach_skills',  ['as' => 'users.detach_skills', 'uses' => 'UsersController@detachSkills'])->where('user', '[0-9]+');

//detailed view of one user
Route::get('/users/{user}/show', ['as' => 'users.show', 'uses' =>  'UsersController@show'])->where('user', '[0-9]+');

//zoek users
Route::get('users/users', ['as' => 'users.users', 'uses' =>  'UsersController@seekUsers'])->where('user', '[0-9]+');

//store rating
Route::post('users/{user}/store_rating', ['as' => 'users.store_rating', 'uses' =>  'UsersController@storeOrUpdateUserRating'])->where('user', '[0-9]+');

//view editDescription 
//Route::get('/users/{user}/edit_description',  ['as' => 'users.edit_description', 'uses' => 'UsersController@editDescription'])->where('user', '[0-9]+');

Route::get('/users/{user}/edit_description',  ['as' => 'users.edit_description', 'uses' => 'UsersController@editDescription'])->where('user', '[0-9]+');

// update description
Route::patch('/users/{user}/update_description',  ['as' => 'users.update_description', 'uses' => 'UsersController@updateDescription'])->where('user', '[0-9]+');

Route::get('/users/{user}/edit_hobbies',  ['as' => 'users.edit_hobbies', 'uses' => 'UsersController@editHobbies'])->where('user', '[0-9]+');

//save hobbies and attach to user
Route::post('/users/{user}/store_hobbies',  ['as' => 'users.store_hobbies', 'uses' => 'UsersController@storeHobbies'])->where('user', '[0-9]+');

//detach hobbies from user
Route::post('/users/{user}/detach_hobbies',  ['as' => 'users.detach_hobbies', 'uses' => 'UsersController@detachHobbies'])->where('user', '[0-9]+');
