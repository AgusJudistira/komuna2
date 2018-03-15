<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{

	public function index() 
	{

    	$projects = Project::all();

		return view('projects.index', compact('projects'));
		
	}


	public function show(Project $project)
	{

		return view('projects.show', compact('project'));

	}


	public function create()
	{

		return view('projects.create');

	}


public function store()
	{

		dd(http_request()->all());

	}
}
