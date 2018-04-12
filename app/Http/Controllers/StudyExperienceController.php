<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyExperienceController extends Controller
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
		$studyExperience = DB::table('study_experiences')->user()->get();
		return view('studyExperience.index');		
	}
}
