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
		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);
		$isProjectMember = $this->isMember(Auth::guard('web')->user(), $project);
		
		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();

		return view('projects.show', compact('project', 'isProjectOwner', 'isProjectMember', 'list_of_projectusers'));
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

	public function isMember($check_user, $project)
	{
		$projectUsers = $project->user()->get();
		foreach ($projectUsers as $user) {
			if ($user->id == $check_user->id) {
				return true;
			}
		}

		return false;
	}

	public function isOwner($check_user, $project)
	{				
		$projectUsers = $project->user()->withPivot('projectowner')->get();		
		
		foreach ($projectUsers as $user) {
			if ($user->id == $check_user->id) {
				return $user->pivot->projectowner;
			}
		}

		return false;
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

		$newProject->user()->attach($user_id, ['projectowner' => true]);


		return redirect('/projects');
	}


	public function edit(Project $project)
	{
		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();


		return view('projects.edit', compact('project', 'isProjectOwner', 'list_of_projectusers'));
	}

	// voorbereidende data verzamelen voor een join message
	public function join(Project $project)
	{
		return view('projects.join', compact('project'));
	}


	// verzoek om aan een project mee te werken wordt daadwerkerlijk verstuurd
	public function joinProjectMessage(Project $project)
	{
		$projectmembers = $project->user()->withPivot('projectowner')->get();

		//verstuur een bericht aan iedere projecteigenaar
		foreach($projectmembers as $member) {
			if ($member->pivot->projectowner) {
				$this->sendPermissionToJoinMessage($project, Auth::guard('web')->user()->id, $member->id);
			}
		}

		return redirect('home');
	}

	//bericht wordt aangemaakt en gelinkt aan de ontvanger
	public function sendPermissionToJoinMessage(Project $project, $sender_id, $recipient_id)
	{
		$project_id = $project->id;		
		$subject = "Mag ik aan het project '$project->name' meewerken?";
		$message = "<p>Graag wil ik meewerken aan het project <span class='text-primary'>$project->name</span></p>." .
					"<p>Als u geintesseerd bent in mijn hulp en expertise, ben ik voor een nader gesprek beschikbaar.</p>";
		
		$newMessage = App\Message::create([
			'sender_id' => $sender_id,
			'recipient_id' => $recipient_id,
			'project_id' => $project_id,
			'subject' => $subject,
			'message' => $message
		]);
		
	}

	public function save_existing(Project $project)
	{			
		if (request('invoeren') == 'invoeren') {
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
		}

		$projects = Project::with('user')->get(); // als voorbereiding op projects.index view

		return view('projects.index', compact('projects', 'user'));
	}

}
