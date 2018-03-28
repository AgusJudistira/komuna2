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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createCompetences()
	{
		return view('competences.create_competences');
	}

}
