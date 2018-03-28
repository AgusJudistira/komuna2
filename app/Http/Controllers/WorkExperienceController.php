<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Competence;
use App\WorkExperience;

class WorkExperienceController extends Controller
{
	protected $fillable = [
        'user_id' 
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() 

	{
		$WorkExperience = DB::table('work_experiences')->user()->get();
		return view('competences.index');		
	}


}
