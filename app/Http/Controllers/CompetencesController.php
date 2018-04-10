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
        $this->middleware('auth:admin');
    }


	public function editCompetences()

	{	
		$competences= DB::table('competences')->orderby('competence', 'ASC')->get();

		return view('admin.edit_competences', compact('competences'));
	}

	public function storeCompetences(Request $request)
	{	
		$user_id = Auth::guard('admin')->user()->id;

		$this->validate(request(),[
			
			'competence' => 'required',
			'description' =>'required'
			
			]);


		$newCompetence = Competence::updateOrCreate(request([

			'competence' 

			]));

		return back();
		
	}

	public function deleteCompetences(Request $request)
	{
		 $competence = $request->input('competence');  
		 $foundCompetence = Competence::find($competence);
		 $foundCompetence->delete();

		 return back();
	}

}
