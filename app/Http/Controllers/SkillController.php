<?php


namespace App\Http\Controllers;
use App\Competence;
use App\User;
use App\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class SkillController extends Controller
{
	public function __construct()
    {
        $this->middleware('web');
    }
}
