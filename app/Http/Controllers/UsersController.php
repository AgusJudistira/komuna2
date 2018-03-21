<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;

class UsersController extends Controller


{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        //$user = Auth::guard('web')->user()->id;
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
            // 'firstname' => 'required',
            // 'lastname' => 'required',
            //'email' => 'email|required|unique:users,email',
            //'password' => 'required|min:6|confirmed',
        	'birthday' => 'required',
        	'gender' => 'required',
            'streetname_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'phone_private' => 'required',
            'phone_work' => 'required'

        ]);

        // $user->firstname = request('firstname');
        // $user->lastname = request('lastname');
        //$user->email = request('email');
        //$user->password = bcrypt(request('password'));
        $user->birthday = request('birthday');
        $user->gender = request('gender');
        $user->streetname_number = request('streetname_number');
        $user->postal_code = request('postal_code');
        $user->city = request('city');
        $user->phone_private = request('phone_private');
        $user->phone_work = request('phone_work');
		$user->save();


		return redirect('/users/' . $user->id . '/edit_avatar');
        //return back();
    }

    public function editAvatar(User $user)
    {   
        //$user = Auth::guard('web')->user()->id;
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
}