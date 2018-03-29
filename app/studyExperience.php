<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Competence;
use App\WorkExperience;
use Illuminate\Database\Eloquent\Model;

class studyExperience extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'start_date', 
        'end_date', 
        'level', 
        'diploma'
    ];
     
    public function studyExperience()
    {
        return $this->hasOne(User::class);
    }
}
