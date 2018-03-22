<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organization;
use Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function joinProject(Project $project)
    {
        $user_id = Auth::guard('web')->user()->id;        
        $projectmembers = $project->user()->withPivot('projectowner')->get();
        
        
        return view('organizations.org-index', compact('org_list', 'all_org_list'));
    }

    public function showInputForm()
    {
        return view('organizations.org-input-form');
    }

}
