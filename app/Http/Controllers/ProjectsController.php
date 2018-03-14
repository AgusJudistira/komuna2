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

	public function show($id)
	{

		$project = project::find($id);
		
		return view('projects.show', compact('project'));
	}
}
