<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{	
	public function __construct()
	{
	
		$this->middleware('auth')->except('index', 'show');
	
	}


	public function index() 
	{

		$projects = Project::all();

		return view('projects.index', compact('projects'));
		
	}


	public function show(Project $project)
	{

		return view('projects.show', compact('project'));

	}


    public function search()
    {
        
        $zoekstring = "%" . request('searchstring') . "%";

        $projects = Project::where('name', 'LIKE', $zoekstring)
							->orWhere('description', 'LIKE', $zoekstring)
							->get();


        return view('projects.index', compact('projects'));
    }


	public function create()
	{

		return view('projects.create');

	}


	public function store()
	{	
		$this->validate(request(),[

			'name' => 'required', 
			'description' => 'required', 
			'start_date' => 'required', 
			'due_date' => 'required'

		]);


		Project::create(request([

			'name', 
			'description', 
			'start_date', 
			'due_date'

		]));

		return redirect('/projects');
	}
}
