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
		

				
		//dd($competences);
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

	






	public function bindCompetences(Competence $competence)
	{	
		$user_id = Auth::guard('web')->user()->id;
		$competences= DB::table('competences')->get();

		

		//dd($user_id);

		return view('users.edit_competences', compact('competences'));
		// $user_id = Auth::guard('web')->user()->id;
		// $competence_id = '2';
		// $competence_id = 'competence_id';
		// $user = User::find($user_id);
		// $user->competences()->sync($competence_id);
		// dd($user);	
	}

}
