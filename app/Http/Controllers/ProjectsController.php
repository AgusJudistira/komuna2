<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use App;
use Carbon\Carbon;
use Session;

class ProjectsController extends Controller
{	
	public function __construct()
	{
		$this->middleware('auth')->except('index');	
		setlocale(LC_ALL, 'nl_NL');
		// Session::put('locale', 'nl');
	}


	public function index() 
	{
		$projects = Project::with('user')->get();

		return view('projects.index', compact('projects', 'user'));		
	}


	public function show(Project $project)
	{
		$isProjectOwner = $this->isOwner($project);
		$list_of_projectowners = $project->user()->get();		

		return view('projects.show', compact('project', 'isProjectOwner', 'list_of_projectowners'));
	}


    public function search()
    {
        
        $zoekstring = "%" . request('searchstring') . "%";

		$projects = Project::with('user')
							->where('name', 'LIKE', $zoekstring)
							->orWhere('description', 'LIKE', $zoekstring)
							->get();


        return view('projects.index', compact('projects', 'projectowner'));
    }


	public function create()
	{
		return view('projects.create');
	}


	public function isOwner($project)
	{
		$user_id = Auth::guard('web')->user()->id;

		//$project = Project::find($project_id);
		$list_of_projectowners = $project->user()->get();
		
		$result = false;

		foreach($list_of_projectowners as $projectowner) {
			if ($projectowner->id == $user_id) {
				$result = true;
				break;
			}
		}
		 
		return $result;
	}


	public function store()
	{	
		$user_id = Auth::guard('web')->user()->id;

		$this->validate(request(),[

			'name' => 'required', 
			'description' => 'required', 
			'start_date' => 'required', 
			'due_date' => 'required'

		]);


		$newProject = Project::create(request([

			'name', 
			'description', 
			'start_date', 
			'due_date'

		]));

		$newProject->user()->attach($user_id);
		$newProject->user()->project_id = $newProject->id;

		//maak de gebruiker die het project aanmaakt de projecteigenaar
		$newProject->user()->projectowner = true; 

		return redirect('/projects');
	}


	public function edit(Project $project)
	{
		$isProjectOwner = $this->isOwner($project);
		$list_of_projectowners = $project->user()->get();		

		return view('projects.edit', compact('project', 'isProjectOwner', 'list_of_projectowners'));
	}


	public function save_existing(Project $project)
	{	
		$user_id = Auth::guard('web')->user()->id;
		

		$this->validate(request(),[

			'name' => 'required', 
			'description' => 'required', 
			'start_date' => 'required', 
			'due_date' => 'required'

		]);


		$savedProject = $project->update(request([

			'name', 
			'description', 
			'start_date', 
			'due_date'

		]));


		$projects = Project::with('user')->get(); // als voorbereiding op projects.index view

		return view('projects.index', compact('projects', 'user'));
	}

}
