<?php

namespace App\Http\Controllers;
use App\Competences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetencesController extends Controller
{
   public function createCompetences()
	{
		return view('competences.create_competences');
	}


	public function updateCompetences()
	{	
		$user_id = Auth::guard('web')->user()->id;

		$this->validate(request(),[
			
			'competence' => 'required', 
			
		]);


		$newCompetence = Competences::create(request([

			'competence' 


			

		]));
		




		return redirect('/competences/create_competences');
	}

}
