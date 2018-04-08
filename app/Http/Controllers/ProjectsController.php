<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Auth;
use App;
use App\User;
use App\Skill;
use App\Competence;
use Carbon\Carbon;
use Session;

class ProjectsController extends Controller
{	
	public function __construct()
	{
		$this->middleware('auth')->except('index');	
		setlocale(LC_ALL, 'nl_NL');		
	}


	public function index() 
	{
		$projects = Project::with('user')->get();

		$thisUser = Auth::guard('web')->user();

		
		$listed_projects = Array();		
		
		
		foreach ($projects as $project) {

			$project_skills = $project->skill()->get();
			$user_skills = $thisUser->skill()->get();

			$project_competences = $project->competence()->get();
			$user_competences = $thisUser->competence()->get();			

			$found_skills = Array();
			$found_competences = Array();
			
			foreach ($user_skills as $user_skill) {
				foreach ($project_skills as $project_skill) {
					if ($user_skill->id == $project_skill->id) {
						array_push($found_skills, $project_skill);
					}
				}
			}			

			foreach ($user_competences as $user_competence) {
				foreach ($project_competences as $project_competence) {
					if ($user_competence->id == $project_competence->id) {
						array_push($found_competences, $project_competence);
					}
				}
			}
						
			$one_project = Array();			
					
			$one_project[] = (count($found_skills)+0.1) * (count($found_competences)+0.5);
			$one_project[] = $project;
			$one_project[] = $found_skills;
			$one_project[] = $found_competences;
			$listed_projects[] = $one_project;		
						
		}		

		rsort($listed_projects); //gesorteerd aan de hand van de gematchedte competenties. De meeste bovenaan.

		return view('projects.index', compact('listed_projects', 'user'));		
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
		$skills = $project->skill()->get();
		$competences = $project->competence()->get();

		return view('projects.show', compact('project', 'isProjectOwner', 'isProjectMember', 'list_of_projectusers', 'skills', 'competences'));
	}


    public function search()
    {        
        $zoekstring = "%" . request('searchstring') . "%";

		$projects = Project::with('user')
							->where('name', 'LIKE', $zoekstring)
							->orWhere('description', 'LIKE', $zoekstring)
							->get();

		$listed_projects = Array();

		foreach ($projects as $project) {
			$project_skills = $project->skill()->get();
			$project_competences = $project->competence()->get();
			
			$one_project = Array();
			$one_project[] = Array();
			$one_project[] = $project;
			$one_project[] = $project_skills;
			$one_project[] = $project_competences;
			$listed_projects[] = $one_project;
		}		

        return view('projects.index', compact('listed_projects', 'projectowner'));
    }


	public function create()
	{
		$competences = Competence::all();
		$skills = Skill::all();
		$skills_selected = "";

		return view('projects.create', compact('competences', 'skills'));
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
		if (request('cancel') == 'cancel') {
			return redirect('/projects');
		}

		$user_id = Auth::guard('web')->user()->id;

		$this->validate(request(),[			
			'name' => 'required', 
			//'description' => 'required', 
			'start_date' => 'required',
			//'due_date' => 'required'
		]);

		$project = Project::create(request([
			'name', 
			'description', 
			'start_date', 
			'due_date'
		]));
		
		// maak de gebruiker die het project aanmaakt de projectowner
		// en vul ook de begindatum in wanneer de projectowner bij het project betrokken is
		$project->user()->attach($user_id, ['projectowner' => true,
											'start_date_user' => \Carbon\Carbon::now()->toDateTimeString()
										]);

		$skills = Skill::all();
		$skills_selected = Array();

		return view('projects.edit_skills', compact('project', 'skills', 'skills_selected'));
	}


    public function editSkills(Project $project)
    {   
        $skills = Skill::all();
        $skills_selected = $project->Skill()->get();
		
        if ($this->isOwner(Auth::guard('web')->user(), $project)) {
            return view('projects.edit_skills', compact( 'skills_selected','skills','project'));
        }
        else {
            return back();
        }
    }

    public function storeSkill(Project $project, Request $request) 
    {
        $this->validate(request(),[
            
            'skill' => 'required'
            
			]);

        $newSkill = Skill::updateOrCreate(request([

            'skill' 

            ]));

        $newSkill->project()->sync($project->id);
		
		$skills_selected = $project->skill()->get();
		$skills = Skill::all();
		
		//return back();
        return view('projects.edit_skills', compact( 'skills_selected','skills','project'));
    }

    public function detachSkills(Project $project, Request $request)
    {   
        
        $skill = $request->input('skill');  
        //$user_id = Auth::guard('web')->project()->id;
       

        $foundSkill = Skill::find($skill);
		$foundSkill->project()->detach($project->id);
		
		$skills_selected = $project->skill()->get();
		$skills = Skill::all();

        return view('projects.edit_skills', compact( 'skills_selected','skills','project'));
        //return back();

    }

	public function editCompetences(Project $project)
	{   
		$competences = Competence::all();
		$competences_selected = $project->competence()->get();

		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();

		if ($isProjectOwner)
			return view('projects.edit_competences', compact('project', 'isProjectOwner', 'list_of_projectusers', 'competences_selected','competences'));
		else {
			return back();
		}
	}


	public function addCompetences(Project $project, Request $request)
	{
		$competences_select = $request->input('competences_select'); 
        
        if ($competences_select !=null) {
            foreach ($competences_select as $competence) {
                $foundCompetence = Competence::find($competence);
                $foundCompetence->project()->sync($project->id);
            }
        }
		
		return back();
	}

	
	public function detachCompetences(Project $project, Request $request)
	{   		
		$competence = $request->input('competence');  
		//$user_id = Auth::guard('web')->user()->id;	
		$foundCompetence = Competence::find($competence);
		$foundCompetence->project()->detach($project->id);
					
		return back();
	}


	public function save_existing(Project $project)
	{			
		//dd(request('competences_select'));
		if (request('invoeren') == 'invoeren') {
			$user_id = Auth::guard('web')->user()->id;
			if (request('enough_members') == 'enough_members') {
				$enough_members = true;
			}
			else {
				$enough_members = false;
			}
			
			$this->validate(request(),[

				'name' => 'required', 				
				'start_date' => 'required'				

			]);

			$savedProject = $project->update(request([

				'name', 
				'description', 
				'start_date', 
				'due_date'

			]));

			$project->enough_members = $enough_members;
			$project->save();

			return redirect()->route('projects.edit_skills', $project);
		}
		elseif (request('afmelden') == 'afmelden') {
			// dismiss project members from the project
			$deleted_projectmembers_id = request('deleted_projectmembers');
			
			if ($deleted_projectmembers_id) {
				foreach ($deleted_projectmembers_id as $deleted_projectmember_id) {
					
					$remove_user = $project->user()->withPivot('start_date_user')->find($deleted_projectmember_id);
					
					$start_date_user = $remove_user->pivot->start_date_user;
					
					$remove_user->project()->detach($project->id);

					$remove_user->projectExperience()->attach($project->id,
						['start_date_user' => $start_date_user,
						 'end_date_user' => \Carbon\Carbon::now()->toDateTimeString()
						]);

					$sender = Auth::guard('web')->user();
					
					$this->sendDismissedFromProjectMsg($project, $sender, $remove_user);
				}			
			}
			
			//return redirect()->route('project_edit', $project);
			$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

			$list_of_projectusers = $project->user()->withPivot('projectowner')->get();
			$competences = Competence::all();
	
			return view('projects.edit', compact('project', 'isProjectOwner', 'list_of_projectusers', 'competences'));
		}
		else {		
			return redirect()->route('project_show', $project);			
		}		
	}

	public function sendDismissedFromProjectMsg($project, $sender, $recipient)
	{			
		$sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "U bent afgemeld van het project $project->name";		
		$message = "<p><b>Mededeling:</b></p>";
		$message .= "<p>$sender_fullname heeft u van het project&nbsp;<a href='/projects/$project->id' target='_blank'>$project->name</a>&nbsp;afgemeld.</p>";
		$message .= "<p>U bent geen projectmedewerker meer.</p>";
		$user_message = "";
		$actions  = "";
		
		
		$newMessage = App\Message::create([
			'sender_id' => $sender->id,
			'recipient_id' => $recipient->id,
			'project_id' => $project->id,
			'subject' => $subject,
			'message' => $message,
			'user_message' => $user_message,
			'actions' => $actions,
			'action_taken' => 0
		]);
	}

	public function edit(Project $project)
	{		
		$isProjectOwner = $this->isOwner(Auth::guard('web')->user(), $project);

		$list_of_projectusers = $project->user()->withPivot('projectowner')->get();
		$competences = Competence::all();

		return view('projects.edit', compact('project', 'isProjectOwner', 'list_of_projectusers', 'competences'));
	}

	public function seekMembers(Project $project)
	{		
		$thisProject = $project;

		$members = $thisProject->User()->get();
		$invitable_members = Array();		
		$volunteers = User::all();
		
		foreach ($volunteers as $volunteer) {

			$user_skills = $volunteer->skill()->get();
			$project_skills = $thisProject->skill()->get();

			$user_competences = $volunteer->competence()->get();
			$project_competences = $thisProject->competence()->get();			

			$found_skills = Array();
			$found_competences = Array();
			
			foreach ($user_skills as $user_skill) {
				foreach ($project_skills as $project_skill) {
					if ($user_skill->id == $project_skill->id) {
						array_push($found_skills, $project_skill);
					}
				}
			}			

			foreach ($user_competences as $user_competence) {
				foreach ($project_competences as $project_competence) {
					if ($user_competence->id == $project_competence->id) {
						array_push($found_competences, $project_competence);
					}
				}
			}
						
			$one_volunteer = Array();
			// leden die geen competentiematch of skillsmatch hebben eruit filteren
			// leden die al lid zijn van het project eruit filteren.
			if (!$this->isMember($volunteer, $thisProject)) {
				if (count($found_competences) > 0 || count($found_skills) > 0 ) {

					$one_volunteer[] = (count($found_skills)+0.1) * (count($found_competences)+0.5);
					$one_volunteer[] = $volunteer;
					$one_volunteer[] = $found_skills;
					$one_volunteer[] = $found_competences;
					$invitable_members[] = $one_volunteer;		
				}
			}			
		}		

		//dd($invitable_members);

		rsort($invitable_members); //gesorteerd aan de hand van de gematchedte competenties. De meeste bovenaan.

		return view('projects.seekMembers', compact('thisProject', 'invitable_members'));
	}

	public function showInvitee(Project $project, User $user)
	{
		if ($this->isOwner(Auth::guard('web')->user(), $project)) {

			$competences_selected = $user->competence()->get();
			$skills_selected = $user->Skill()->get();
			//$projects = $user->project()->withPivot('projectowner', 'start_date_user', 'end_date_user')->get();

			$projects = $user->project()->withPivot('projectowner', 'start_date_user', 'end_date_user')->orderBy('start_date', 'DESC')->get();
			$projectExperiences = $user->projectExperience()->withPivot('start_date_user', 'end_date_user')->orderBy('start_date', 'DESC')->get();

			$workExperiences = $user->workExperience()->orderBy('start_date', 'DESC')->get();
			$studyExperiences = $user->StudyExperience()->orderBy('start_date', 'DESC')->get();

			$date1 = date_create($user->birthday);
			$date2 = date_create(date("Y-m-d"));
			$age = date_diff($date1, $date2)->format('%y jaar');

			return view('projects.showInvitee', compact('user', 'projectExperiences', 'projects', 'project', 'competences_selected', 'skills_selected', 'workExperiences', 'studyExperiences', 'age'));
			// $invitee_competences = $invitee->competence()->get();
			// return view('projects.showInvitee', compact('project', 'invitee', 'invitee_competences'));
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

		if (request('inquire') == 'inquire') {
			return view('projects.inquire_invitee', compact('project', 'invitee'));
		}

		if (request('invite') == 'invite') {
			return view('projects.invite', compact('project', 'invitee'));
		}
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
			
			$message = "<p>$sender_fullname nodigt je uit om aan het project&nbsp;<a href='/projects/$project_id' target='_blank'>$thisProject->name</a>&nbsp;mee te werken.</p>";
			$message .= "<p>Klik op accepteren of weigeren.</p>";
			//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
			$actions  = "<div class=\"row\"><div class=\"col-md-12\"><b><i>Eventuele persoonlijke bericht:</i></b></div>";
			$actions .= "<div class=\"col-md-12\"><textarea class=\"form-control\" type=\"text\" name=\"user_message\"></textarea></div>";
			$actions .= "</div>";
			$actions .= "<div class=\"card-footer\">";
			$actions .= "<div class=\"row\">";
			$actions .= "<div class=\"col-md-4\"></div>";
			$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"refuse\" value=\"refuse\" type=\"submit\" class=\"btn btn-info btn-lg\">Weigeren</button></div>";
			$actions .= "<div class=\"col-md-4\"><button form=\"decide\" name=\"accept\" value=\"accept\" type=\"submit\" class=\"btn btn-primary btn-lg\">Accepteren</button></div>";
			$actions .= "</div></div>";
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
				'user_message' => request('user_message'),
				'actions' => $actions,
				'action_taken' => 0
			]);
		}


		return redirect()->route('seek_members', $thisProject);
	}


	public function sendProjectInquiry()
	{
		$project_id = request('project_id');
		$applicant_id = request('applicant_id');
		$user_message = request('user_message');

		$thisProject = Project::find($project_id);

		if (request('inquire') == 'inquire')	{
			$sender = Auth::guard('web')->user();
			$sender_fullname = $sender->firstname . " " . $sender->lastname;
			$subject = "Over '$thisProject->name'... ";
			
			$message = "<p><i>$sender_fullname heeft met betrekking tot&nbsp;<a href='/projects/$project_id' target='_blank'>$thisProject->name</a>&nbsp;wat vragen:</i></p>";

			//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
			$actions  = "<div class=\"card-footer\">";
			$actions  = "<div class=\"row\">";			
			$actions .= "<div class=\"col-md-4\"></div>";
			$actions .= "<div class=\"col-md-8 text-right\"><button form=\"decide\" name=\"reply\" value=\"reply\" type=\"submit\" class=\"btn btn-info btn-lg\">Beantwoorden</button></div>";
			$actions .= "</div></div>";
			$actions .= "<input type=\"hidden\" name=\"project_id\" value=\"$project_id\">";
			$actions .= "<input type=\"hidden\" name=\"applicant_id\" value=\"$applicant_id\">";
			$actions .= "<input type=\"hidden\" name=\"decider\" value=\"applicant\">";
			//$action .= "</form>";
			
			$project_owners = $thisProject->user()->withPivot('projectowner')->where('projectowner', true)->get();

			foreach ($project_owners as $project_owner) {
				$newMessage = App\Message::create([
					'sender_id' => $sender->id,
					'recipient_id' => $project_owner->id,
					'project_id' => $project_id,
					'subject' => $subject,
					'message' => $message,
					'user_message' => $user_message,
					'actions' => $actions,
					'action_taken' => 0
				]);
			}
		}

		return redirect()->route('project_index');
	}


	public function sendPersonalInquiry()
	{
		$project_id = request('project_id');
		$invitee_id = request('invitee_id');
		$user_message = request('user_message');

		$thisProject = Project::find($project_id);

		if (request('inquire') == 'inquire')	{
			$sender = Auth::guard('web')->user();
			$sender_fullname = $sender->firstname . " " . $sender->lastname;
			$subject = "Over '$thisProject->name'... ";
			
			$message = "<p><i>$sender_fullname heeft met betrekking tot&nbsp;<a href='/projects/$project_id' target='_blank'>$thisProject->name</a>&nbsp;wat vragen:</i></p>";

			//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
			$actions  = "<div class=\"card-footer\">";
			$actions  = "<div class=\"row\">";			
			$actions .= "<div class=\"col-md-4\"></div>";
			$actions .= "<div class=\"col-md-8 text-right\"><button form=\"decide\" name=\"reply\" value=\"reply\" type=\"submit\" class=\"btn btn-info btn-lg\">Beantwoorden</button></div>";
			$actions .= "</div></div>";
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
				'user_message' => $user_message,
				'actions' => $actions,
				'action_taken' => 0
			]);
		}


		return redirect()->route('seek_members', $thisProject);
	}


	public function prepareReplyMessage(Project $project, App\Message $old_message) 
	{
		
		return view('projects.message_reply', compact('project', 'old_message'));
	}


	public function sendReplyMessage() 
	{	
		if (request('reply') == 'reply') {
			$user_message = request('user_message');
			$project_id = request('project_id');
			$recipient_id = request('recipient_id');
			$old_message = App\Message::find(request('old_message_id'));		
			$sender = Auth::guard('web')->user();
			$sender_fullname = $sender->firstname . " " . $sender->lastname;
			$old_message->action_taken = 3; // 1 = accepted, 2 = refused, 3 = replied
			$old_message->save();

			// $new_message  = $old_message->message;
			// $new_message .= "<p>" . $old_message->user_message . "</p>";

			$this_message = App\Message::create([
				'sender_id' => $sender->id,
				'recipient_id' => $recipient_id,
				'project_id' => $project_id,
				'subject' => $old_message->subject,
				'message' => $old_message->message . "<br />" . $old_message->user_message,
				'user_message' => "<b><i>$sender_fullname</i></b>: " . $user_message,
				'actions' => $old_message->actions,
				'action_taken' => 0
			]);
		}

		return redirect('home');
	}


	// voorbereidende data verzamelen voor een join message
	public function prepareJoinMessage(Project $project)
	{
		if (request('inquire') == 'inquire') {
			return view('projects.inquire_project', compact('project'));
		}
		else {
			return view('projects.join', compact('project'));
		}
	}


	// verzoek om aan een project mee te werken wordt daadwerkerlijk verstuurd
	public function sendJoinProjectMessage(Project $project)	
	{
		if (request('cancel') == 'cancel') {
			return redirect('/projects/' . $project->id);
		}

		$user_message = request('user_message');

		//$projectmembers = $project->user()->withPivot('projectowner')->get();
		$project_owners = $project->user()->withPivot('projectowner')->where('projectowner', true)->get();
		//verstuur een bericht aan iedere projecteigenaar
		foreach($project_owners as $project_owner) {			
			$this->sendPermissionToJoinMessage($project, Auth::guard('web')->user()->id, $project_owner->id, $user_message);
		}

		return redirect('home');
	}

	//bericht wordt aangemaakt en gelinkt aan de ontvanger
	public function sendPermissionToJoinMessage(Project $project, $sender_id, $recipient_id, $user_message)
	{
		$project_id = $project->id;
		$sender = User::find($sender_id);
		$sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "Mag ik aan het project '$project->name' meewerken?";
		
		$message = "<p>$sender_fullname wilt graag meewerken aan het project&nbsp;<a href='/projects/$project_id' target='_blank'>$project->name</a>.</p>";
		$message .= "<p>Klik op accepteren of weigeren.</p>";		
		//$action .= "<form id=\"decide\" method=\"POST\" action=\"/projects/decide\">";
		$actions  = "<div class=\"row\"><div class=\"col-md-12\"><b><i>Eventuele persoonlijke bericht:</i></b></div>";
		$actions .= "<div class=\"col-md-12\"><textarea class=\"form-control\" type=\"text\" name=\"user_message\"></textarea></div>";
		$actions .= "<div class=\"row col-md-12\">";
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
			'user_message' => $user_message,
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
			'message' => $message,
			'user_message' => request('user_message')
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
			'message' => $message,
			'user_message' => request('user_message')
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

		if (request('reply') == 'reply') {			
			
			if ($thisuser_id != $this_message->sender_id) {
				$old_message = $this_message;
				return view('projects.message_reply', compact('project', 'old_message'));				
			}
		}
		elseif ($thisuser_id != $applicant_id && $decider == "project owner") {
			if (request('accept') == 'accept') {
				//make applicant a projectmember by linking it to the project via a pivot table
				//first check if the applicant is already member

				if (!$project->user()->find($applicant_id)) {				

					$this_message->action_taken = 1;
					$this_message->save();
					$project->user()->attach($applicant_id, ['start_date_user' => \Carbon\Carbon::now()->toDateTimeString()]);
					
					// $$project->user()->updateExistingPivot($applicant_id, 
					// 	['start_date_user' => \Carbon\Carbon::now()->toDateTimeString()]);

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

				// if (count($project->user()->find($applicant_id)) == 0) {
				if (!$project->user()->find($applicant_id)) {

					$this_message->action_taken = 1;
					$this_message->save();
					$project->user()->attach($applicant_id, ['start_date_user' => \Carbon\Carbon::now()->toDateTimeString()]);
					
					// $project->user()->updateExistingPivot($applicant_id, 
					// 	['start_date_user' => \Carbon\Carbon::now()->toDateTimeString()]);
					
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
		$competences = $project->competence()->get();
		$skills = $project->skill()->get();

		return view('projects.show', compact('project', 'isProjectOwner', 'isProjectMember', 'list_of_projectusers', 'skills', 'competences'));
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
				'message' => $message,
				'user_message' => request('user_message')
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
		//$message .= "<p>$original_message->user_message</p>";
		

		$projectOwners = $this->getProjectOwners($project);

		foreach ($projectOwners as $projectOwner) {
			$newMessage = App\Message::create([
				'sender_id' => $sender->id,
				'recipient_id' => $projectOwner->id,
				'project_id' => $project->id,
				'subject' => $subject,
				'message' => $message,
				'user_message' => request('user_message')
			]);
		}
	} 

   
}