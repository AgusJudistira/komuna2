<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use Auth;

class OrganizationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function org_index()
    {
        $user_id = Auth::guard('web')->user()->id;
        //dd('user id: ' . $user_id);
        $org_list = User::find($user_id)->organization()->get();

        return view('organizations.org-index', compact('org_list'));
    }
}
