<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
	protected $fillable = [
        'user_id', 
        'name', 
        'start_date', 
        'end_date', 
        'position', 
        'description', 
        'department'
    ];
     
     public function workExperience()
    {
        return $this->hasOne(User::class);
    }
}
