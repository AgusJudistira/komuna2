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

Route::get('/', function () {

	$projects = DB::table('projects')->latest()->get();

	return view('welcome', compact('projects'));
});


Route::get('/projects/{projects}', function ($id) {

	$project = DB::table('projects')->find($id);

	
	return view('projects/show', compact('project'));
});


