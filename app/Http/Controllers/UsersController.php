<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Skill;
use App\Competence;
use App\WorkExperience;
use App\StudyExperience;
use App\Review;
use App\Project;
use App\Message;


use Image;

class UsersController extends Controller


{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    { 
        if ($user->id == Auth::guard('web')->user()->id) {
            return view('users.edit_personal', compact('user'));
        }
        else {
            return back();
        }
        
    }

   
    public function show(User $user) 
    {
        $competences_selected = $user->competence()->get();
        $skills_selected = $user->Skill()->get();

        $projects = $user->project()->withPivot('projectowner', 'start_date_user', 'end_date_user')->orderBy('start_date', 'DESC')->get();
        $projectExperiences = $user->projectExperience()->withPivot('start_date_user', 'end_date_user')->orderBy('start_date', 'DESC')->get();

        $workExperiences = $user->WorkExperience()->orderBy('start_date', 'DESC')->get();
        $studyExperiences = $user->StudyExperience()->orderBy('start_date', 'DESC')->get();
        $rating = DB::table('reviews')->where('rated_user_id', '=', $user->id)->avg('rating');
        $date1 = date_create($user->birthday);
        $date2 = date_create(date("Y-m-d"));
        $age = date_diff($date1, $date2)->format('%y jaar');

        return view('users.show', compact('user', 'projects', 'projectExperiences', 'competences_selected', 'skills_selected', 'workExperiences', 'studyExperiences', 'age', 'rating'));
    }
   

    public function update(User $user)
    { 
        $this->validate(request(), [
        	'birthday',
        	'gender',
            'streetname_number',
            'postal_code',
            'city' => 'required',
            'phone_private',
            'phone_work' 

        ]);
        
        $user->birthday=request('birthday');
        $user->gender = request('gender');
        $user->streetname_number = request('streetname_number');
        $user->postal_code = request('postal_code');
        $user->city = request('city');
        $user->phone_private = request('phone_private');
        $user->phone_work = request('phone_work');
		$user->save();


		return redirect('/users/' . $user->id . '/edit_avatar');
    }


    public function editAvatar(User $user)
    {   

        if ($user->id == Auth::guard('web')->user()->id) {
            return view('users.edit_avatar', compact('user'));
        }
        else {
            return back();
        }
        
    }

   public function updateAvatar(Request $request)
    { 
        if ($request->hasFile('avatar')){
        	$avatar= $request->file('avatar');
        	$filename = time() . '.' . $avatar->getClientOriginalExtension();
        	Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

        	$user =Auth::user();
        	$user->avatar = $filename;
        	$user->save();

          
        	return view('users.edit_avatar', compact('user'));
        }
    }

   
    public function editCompetences(User $user)
    {   
        $competences = Competence::all();
        $competences_selected = $user->competence()->get();

        if ($user->id == Auth::guard('web')->user()->id) {
            return view('users.edit_competences', compact( 'competences_selected','competences','user'));
        }
        else {
            return back();
        }
    }


    public function addCompetences(Request $request)
    {   
        $competences_select = $request->input('competences_select'); 

        $user_id = Auth::guard('web')->user()->id;
        if ($competences_select !=null) {
            foreach ($competences_select as $competence) {
                $foundCompetence = Competence::find($competence);
                $foundCompetence->user()->sync($user_id);
            }
        }
        return back();
    }

      
    public function detachCompetences(Request $request)
    {   
        
        $competence = $request->input('competence');  
        $user_id = Auth::guard('web')->user()->id;
       

        $foundCompetence = Competence::find($competence);
        $foundCompetence->user()->detach($user_id);
       
                
        return back();
 
    }


    public function editProjectExperience(User $user)
    {        
        $projects = $user->project()->withPivot('projectowner', 'start_date_user', 'end_date_user')->where('projectowner', false)->orderBy('start_date', 'DESC')->get();
        $projectExperiences = $user->projectExperience()->withPivot('start_date_user', 'end_date_user')->orderBy('start_date', 'DESC')->get();

        return view('users.edit_projectExperience', compact('user', 'projects', 'projectExperiences'));
    }


    public function detachProjects(User $user, Project $projects, Request $request)
    {        
        $exited_projects = $request->input('exited_projects');
        //dd($exited_projects);
        foreach($exited_projects as $exited_project) {
            // copy the start_date_user from old pivot table to the new pivot table
            $targetProject = $user->project()->withPivot('start_date_user')->find($exited_project);            
            $start_date_user = $targetProject->pivot->start_date_user;            
            $user->project()->detach($exited_project); // delete old pivot table
            // create new pivot table for project history
            $user->projectExperience()->attach($exited_project, 
                ['start_date_user' => $start_date_user,
                 'end_date_user' => \Carbon\Carbon::now()->toDateTimeString()]);

            $sender = Auth::guard('web')->user();
            $this->sendLeftFromProjectMsg($targetProject, $sender);
        }
        //return view('users.edit_projectExperience', compact('user', 'projects'));
        return back();
    }


    public function sendLeftFromProjectMsg($project, $sender)
    {
        $sender_fullname = $sender->firstname . " " . $sender->lastname;
		$subject = "$sender_fullname heeft zich afgemeld van het project $project->name";
		$message = "<p><b>Mededeling:</b></p>";
		$message .= "<p>$sender_fullname heeft zich van het project&nbsp;<a href='/projects/$project->id' target='_blank'>$project->name</a>&nbsp;afgemeld.</p>";
		$message .= "<p>$sender->firstname is geen projectmedewerker meer.</p>";
		$user_message = "";
		$actions  = "";		
        
        $recipients = $project->user()->withPivot('projectowner')->where('projectowner', true)->get();

        foreach ($recipients as $recipient) {
            $newMessage = Message::create([
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
    }


    public function editWorkExperience(User $user)
    {        
        $workExperiences = $user->workExperience()->orderBy('start_date', 'DESC')->get();

        return view('users.edit_workExperience', compact('user', 'workExperiences'));
    }


    public function storeWorkExperience(User $user)
    {   
       
        $this->validate(request(),[
            'user_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date',
            'department',
            'position',
            'description',      
            
        ]);

        $newWorkExperience = WorkExperience::create(request([
            'user_id',
            'name',
            'start_date',
            'end_date',
            'department',
            'position',
            'description',

        ]));

        $workExperiences = $user->WorkExperience()->orderBy('start_date', 'DESC')->get();
    
        return back();
    
    }

    public function editStudyExperience(User $user)
    {
        $studyExperiences = $user->StudyExperience()->orderBy('start_date', 'DESC')->get();

        return view('users.edit_studyExperience', compact('user', 'studyExperiences'));
    }

    public function storeStudyExperience(User $user)
    {   

        $this->validate(request(),[
            'user_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date',
            'level',
            'diploma'
        ]);

        $newStudyExperience = StudyExperience::create(request([
            'user_id',
            'name',
            'start_date',
            'end_date',
            'level',
            'diploma'
     
        ]));

        $studyExperiences = $user->studyExperience()->orderBy('start_date', 'DESC')->get();
    
        return back();
    
    }

    public function editSkills(User $user)
    {   
        $skills = Skill::all();
        $skills_selected = $user->Skill()->get();

            if ($user->id == Auth::guard('web')->user()->id) {
            return view('users.edit_skills', compact( 'skills_selected','skills','user'));
        }
        else {
            return back();
        }
    }

    public function storeSkill(Request $request) 
    {

        $this->validate(request(),[
            
            'skill' => 'required'
            
            ]);
        $newSkill = Skill::updateOrCreate(request([

            'skill' 

            ]));
                    
        $user_id = Auth::guard('web')->user()->id;
        $newSkill->user()->sync($user_id);

        return back();
    }

    public function detachSkills(Request $request)
    {   
        
        $skill = $request->input('skill');  
        $user_id = Auth::guard('web')->user()->id;
       

        $foundSkill = Skill::find($skill);
        $foundSkill->user()->detach($user_id);
       
                
        return back();

    }
    public function seekMembers()
    { 
        $users = User::all('firstname', 'lastname', 'city', 'id');

       return view('users.seekMembers', compact('users'));
    }



    public function storeOrUpdateUserRating(User $user)
    {   

        $rating_user_id = request('rating_user_id');
        $rated_user_id = request('rated_user_id');

        $alreadyReviewd = Review::where('rating_user_id', $rating_user_id)->where('rated_user_id', $rated_user_id)->get();
        if ($alreadyReviewd->count() < 1 && $rating_user_id != $rated_user_id ) {

                $this->validate(request(),[
                    'rated_user_id',
                    'rating_user_id',
                    'rating'
                ]);
        
                $newRating = Review::create(request([
                    'rated_user_id',
                    'rating_user_id',
                    'rating'
                ]));
 
                 
        return back();
        
        }
            
        elseif ($alreadyReviewd->count() >= 1 && $rating_user_id != $rated_user_id ){

            $this->validate(request(),[
                    'rated_user_id',
                    'rating_user_id',
                    'rating'
                ]);

            $updated = Review::where('rating_user_id', $rating_user_id)->where('rated_user_id', $rated_user_id)->update(request([
            'rated_user_id',
            'rating_user_id',
            'rating'
                ]));
        
            return back();
         
         } else{

            return back();
         }
    }



}


