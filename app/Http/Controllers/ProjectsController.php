<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use App;
use App\User;
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

		if ($isProjectOwner) {
			$isProjectMember = true;
		}
		else {
			$isProjectMember = $this->isMember(Auth::guard('web')->user(), $project);
		}
		
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


	public function getProjectOwners($project) 
	{
		$projectUsers = $project->user()->withPivot('projectowner')->get();
		$projectOwners = Array();

		foreach ($projectUsers as $user) {			
			if ($user->pivot->projectowner) {
				array_push($projectOwners, $user);
			}
		}

		return $projectOwners;
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


	public function edit()
	{
		$project_id = request('project_id');
		$project = Project::find($project_id);
		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();


		return view('projects.edit', compact('project', 'isProjectOwner', 'list_of_projectusers'));
	}

	public function seekMembers()
	{
		$project_id = request('project_id');
		$thisProject = Project::find($project_id);

		$members = $thisProject->User()->get();

		$invitable_members = Array();

		$volunteers = User::all();
		// leden die al lid zijn van het project eruit filteren.
		foreach ($volunteers as $volunteer) {			
			if	(!$this->isMember($volunteer, $thisProject)) {
				array_push($invitable_members, $volunteer);				
			}
		}
		return view('projects.seekMembers', compact('thisProject', 'invitable_members'));
	}

	public function showInvitee(Project $project, User $invitee)
	{
		if ($this->isOwner(Auth::guard('web')->user(), $project)) {
			return view('projects.showInvitee', compact('project', 'invitee'));
		} else {
			return back();
		}
	}

	public function prepareInvitation()
	{
		$project_id = request('project_id');
		$invitee_id = request('invitee_id');

		$invitee = User::find($invitee_id);
		$project = Project::find($project_id);

		return view('projects.invite', compact('project', 'invitee'));
	}
	// Uitnodigingsbericht maken
	public function sendInvitation()
	{	
		
		$project_id = request('project_id');
		$invitee_id = request('invitee_id');

		$thisProject = Project::find($project_id);

		if (request('invite') == 'invite')	{
			$sender = Auth::guard('web')->user();		
			$sender_fullname = $sender->firstname . " " . $sender->lastname;
			$subject = "Wil je aan het project '$thisProject->name' meewerken?";
			
			$message = "<p>$sender_fullname nodigt je uit om aan het project <a href='/projects/$project_id' target='_blank'>$thisProject->name</a>.</p>";
			$message .= "Klik op accepteren of weigeren.";		
			//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
			
			$actions  = "<div class=\"row\">";
			$actions .= "<div class=\"col-md-4\"></div>";
			$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"refuse\" value=\"refuse\" type=\"submit\" class=\"btn btn-info btn-lg\">Weigeren</button></div>";
			$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"accept\" value=\"accept\" type=\"submit\" class=\"btn btn-primary btn-lg\">Accepteren</button></div>";
			$actions .= "</div>";
			$actions .= "<input type=\"hidden\" name=\"project_id\" value=\"$project_id\">";
			$actions .= "<input type=\"hidden\" name=\"applicant_id\" value=\"$invitee_id\">";
			$actions .= "<input type=\"hidden\" name=\"decider\" value=\"invitee\">";
			//$action .= "</form>";
			
			$newMessage = App\Message::create([
				'sender_id' => $sender->id,
				'recipient_id' => $invitee_id,
				'project_id' => $project_id,
				'subject' => $subject,
				'message' => $message,
				'actions' => $actions,
				'action_taken' => 0
			]);
		}

		//$members = $thisProject->User()->get();

		$invitable_members = Array();

		$volunteers = User::all();
		// leden die al lid zijn van het project eruit filteren.
		foreach ($volunteers as $volunteer) {			
			if	(!$this->isMember($volunteer, $thisProject)) {
				array_push($invitable_members, $volunteer);				
			}
		}
		return view('projects.seekMembers', compact('thisProject', 'invitable_members'));
	}

	// voorbereidende data verzamelen voor een join message
	public function prepareJoinMessage(Project $project)
	{
		return view('projects.join', compact('project'));
	}


	// verzoek om aan een project mee te werken wordt daadwerkerlijk verstuurd
	public function sendJoinProjectMessage(Project $project)	
	{
		if (request('cancel') == 'cancel') {
			return redirect('/projects/' . $project->id);
		}

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
		$sender = User::find($sender_id);
		$sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "Mag ik aan het project '$project->name' meewerken?";
		
		$message = "<p>$sender_fullname wilt graag meewerken aan het project <a href='/projects/$project_id' target='_blank'>$project->name</a>.</p>";
		$message .= "Klik op accepteren of weigeren.";		
		//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
		
		$actions  = "<div class=\"row\">";
		$actions .= "<div class=\"col-md-4\"></div>";
		$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"refuse\" value=\"refuse\" type=\"submit\" class=\"btn btn-info btn-lg\">Weigeren</button></div>";
		$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"accept\" value=\"accept\" type=\"submit\" class=\"btn btn-primary btn-lg\">Accepteren</button></div>";
		$actions .= "</div>";
		$actions .= "<input type=\"hidden\" name=\"project_id\" value=\"$project_id\">";
		$actions .= "<input type=\"hidden\" name=\"applicant_id\" value=\"$sender_id\">";
		$actions .= "<input type=\"hidden\" name=\"decider\" value=\"project owner\">";
		//$action .= "</form>";
		
		$newMessage = App\Message::create([
			'sender_id' => $sender_id,
			'recipient_id' => $recipient_id,
			'project_id' => $project_id,
			'subject' => $subject,
			'message' => $message,
			'actions' => $actions,
			'action_taken' => 0
		]);
	
	}

	public function sendAcceptedToProjectMessage(Project $project, $sender_id, $recipient_id)
	{
		$project_id = $project->id;
		$sender = User::find($sender_id);
		$sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "U bent toegelaten tot het project '$project->name'!";
		$message = "<p>Gefeliciteerd!</p>";
		$message .= "<p>Projecteigenaar $sender_fullname heeft u geaccepteerd om aan het project <a href='/projects/$project_id' target='_blank'>$project->name</a> mee te werken.</p>";
		
		$newMessage = App\Message::create([
			'sender_id' => $sender_id,
			'recipient_id' => $recipient_id,
			'project_id' => $project_id,
			'subject' => $subject,
			'message' => $message
		]);
	}

	public function sendRefusedToProjectMessage(Project $project, $thisuser_id, $applicant_id) 
	{
		$project_id = $project->id;
		$sender = User::find($thisuser_id);
		$sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "Uw bent helaas geweigerd voor het project '$project->name'!";
		$message = "<p>Helaas...</p>";
		$message .= "<p>Projecteigenaar $sender_fullname heeft uw verzoek om aan het project <a href='/projects/$project_id' target='_blank'>$project->name</a> mee te werken geweigerd.</p>";
		
		$newMessage = App\Message::create([
			'sender_id' => $sender->id,
			'recipient_id' => $applicant_id,
			'project_id' => $project_id,
			'subject' => $subject,
			'message' => $message
		]);
	}

	public function decide() // decider = "project owner" or "invitee"
	{
		$decider = request('decider');
		$message_id = request('message_id');
		$this_message = App\Message::find($message_id);

		$applicant_id = request('applicant_id');
		$project_id = request('project_id');
		$project = Project::find($project_id);
		$thisuser_id = Auth::guard('web')->user()->id;

		if ($thisuser_id != $applicant_id && $decider == "project owner") {
			if (request('accept') == 'accept') {
				//make applicant a projectmember by linking it to the project via a pivot table
				//first check if the applicant is already member
				if ($project->user()->find($applicant_id)->exists()) {
					$this_message->action_taken = 1;
					$this_message->save();
					$project->user()->attach($applicant_id);
					
					$this->sendAcceptedToProjectMessage($project, $thisuser_id, $applicant_id);
					
				}
			} elseif (request('refuse') == 'refuse') {
				$this_message->action_taken = 2;
				$this_message->save();

				$this->sendRefusedToProjectMessage($project, $thisuser_id, $applicant_id);
			}
		}
		elseif ($thisuser_id == $applicant_id && $decider == "invitee") {
			if (request('accept') == 'accept') {
				//make applicant a projectmember by linking it to the project via a pivot table
				//first check if the applicant is already member
				if ($project->user()->find($applicant_id)->exists()) {
					$this_message->action_taken = 1;
					$this_message->save();
					$project->user()->attach($applicant_id);
					
					$this->sendAcceptInvitationToProject($project, $applicant_id, $this_message);
					
				}
			} 
			elseif (request('refuse') == 'refuse') {
				$this_message->action_taken = 2;
				$this_message->save();

				$this->sendRefuseToJoinProject($project, $applicant_id, $this_message);
			}
		}


		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

		if ($isProjectOwner) {
			$isProjectMember = true;	
		}
		else {
			$isProjectMember = $this->isMember(Auth::guard('web')->user(), $project);
		}

		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();

		return view('projects.show', compact('project', 'isProjectOwner', 'isProjectMember', 'list_of_projectusers'));
	}


	public function sendAcceptInvitationToProject($project, $applicant_id, $original_message)
	{		
		$sender = Auth::guard('web')->user();
		$sender_fullname = $sender->firstname . " " . $sender->lastname;

		$inviter = User::find($original_message->sender_id);
		$inviter_fullname = $inviter->firstname . " " . $inviter->lastname;
				
		$subject = $sender_fullname . " heeft de uitnodiging van om aan het project '$project->name' mee te werken geaccepteerd!";
		$message = "<p>Gefeliciteerd!</p>";
		$message .= "<p>$sender_fullname heeft de uitnodiging van $inviter->fullname om aan het project <a href='/projects/$project->id' target='_blank'>$project->name</a> mee te werken <b>geaccepteerd</b>.</p>";
		
		$projectOwners = $this->getProjectOwners($project);

		foreach ($projectOwners as $projectOwner) {
			$newMessage = App\Message::create([
				'sender_id' => $sender->id,
				'recipient_id' => $projectOwner->id,
				'project_id' => $project->id,
				'subject' => $subject,
				'message' => $message
			]);
		}
	} 

	public function sendRefuseToJoinProject($project, $applicant_id, $original_message)
	{		
		$sender = Auth::guard('web')->user();
		$sender_fullname = $sender->firstname . " " . $sender->lastname;

		$inviter = User::find($original_message->sender_id);
		$inviter_fullname = $inviter->firstname . " " . $inviter->lastname;
		
		$subject = $sender_fullname . " heeft de uitnodiging van om aan het project '$project->name' mee te werken geweigerd.";
		$message = "<p>Helaas...</p>";
		$message .= "<p>$sender_fullname heeft de uitnodiging van $inviter->fullname om aan het project <a href='/projects/$project->id' target='_blank'>$project->name</a> mee te werken <b>geweigerd</b>.</p>";
		
		$projectOwners = $this->getProjectOwners($project);

		foreach ($projectOwners as $projectOwner) {
			$newMessage = App\Message::create([
				'sender_id' => $sender->id,
				'recipient_id' => $projectOwner->id,
				'project_id' => $project->id,
				'subject' => $subject,
				'message' => $message
			]);
		}
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
