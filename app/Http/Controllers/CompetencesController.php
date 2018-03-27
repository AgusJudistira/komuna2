<?php

namespace App\Http\Controllers;
use App\Competence;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CompetencesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() 

	{
		$competences= DB::table('competences')->get();
		return view('competences.index', compact('competences', 'competence'));		
	}


	public function createCompetences()
	{
		return view('competences.create_competences');
	}

	public function storeCompetences(Request $request)
	{	
		$user_id = Auth::guard('web')->user()->id;

		$this->validate(request(),[
			
			'competence' => 'required'
			
			]);


		$newCompetence = Competence::create(request([

			'competence' 

			]));

		return redirect('/competences/create_competences');
	}

}
