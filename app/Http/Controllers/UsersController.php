<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Competence;
use App\WorkExperience;

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
        $workExperiences = $user->workExperience()->get();
        
        return view('users.edit_workExperience', compact('user', 'workExperiences'));
    }

    public function storeWorkExperience(Request $request, User $user)
    {   
        //$user = Auth::guard('web')->user()->id;
        $workExperiences = $user->workExperience()->get();
    
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

    return view('users.edit_workExperience', compact('user', 'workExperiences'));
    }


}






    // public function editWorkExperience(User $user)
    // {   
    
    //  return view('users.edit_workExperience', compact('user'));
    // }

    // public function storeWorkExperience(Request $request)
    // {   
    //     $user_id = Auth::guard('web')->user()->id;

    //     $this->validate(request(),[
            
    //         'name' => 'required',
    //         'start_date' => 'required',
    //         'end_date' => 'required',
    //         'department' => 'required',
    //         'position' => 'required',
    //         'description' => 'required',
    //         'phone_work' => 'required'
            
    //         ]);

        
    //     $newWorkExperience = WorkExperience::create(request([

    //         'name',
    //         'start_date',
    //         'end_date',
    //         'department',
    //         'position',
    //         'description',
    //         'phone_work'

    //         ]));
    //     dd($newWorkExperience);
        
        
    //     save();

    // }
   

      // return view('users.edit_workExperience', compact('user'));
        // $workExperience = $user->work_experiences()->get();