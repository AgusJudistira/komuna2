<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;

class ProjectsController extends Controller
{	
	public function __construct()
	{
	
		$this->middleware('auth')->except('index', 'show');
	
	}


	public function index() 
	{

		$projects = Project::with('projectowner')->get();
		//$projects = Project::all();
		// dd($projects);

		return view('projects.index', compact('projects', 'projectowner'));
		
	}


	public function show(Project $project)
	{
		$isProjectOwner = $this->isOwner($project);

		return view('projects.show', compact('project', 'isProjectOwner'));

	}


    public function search()
    {
        
        $zoekstring = "%" . request('searchstring') . "%";

		$projects = Project::with('projectowner')
							->where('name', 'LIKE', $zoekstring)
							->orWhere('description', 'LIKE', $zoekstring)
							->get();


        return view('projects.index', compact('projects', 'projectowner'));
    }


	public function create()
	{

		return view('projects.create');

	}

	public function isOwner($project_id)
	{
		$user_id = Auth::guard('web')->user()->id;

		$project = Project::find($project_id);

		// dd($project);
		dd($project->projectowner()->projectowner_id);
		// return $project->projectowner()->projectowner_id == $user_id;		
		// return ($project->projectowner_id == $user_id);

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

		$newProject->projectowner()->attach($user_id);
		$newProject->projectowner()->project_id = $newProject->id;

		return redirect('/projects');
	}
}
