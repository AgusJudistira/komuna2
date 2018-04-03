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

    public function update(User $user)
    { 
        $this->validate(request(), [
        	'birthday' => 'required',
        	'gender' => 'required',
            'streetname_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'phone_private' => 'required',
            'phone_work' => 'required'

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
        if($request->hasFile('avatar')){
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
            'end_date' => 'required',
            'department' => 'required',
            'position' => 'required',
            'description' => 'required',
          
            
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
            'end_date' => 'required',
            'level' => 'required',
            'diploma' => 'required'
      
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

}


