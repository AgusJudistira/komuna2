<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{	
	protected $guarded = ['id'];
	
	

	

    public function user()
    {
        return $this->belongsToMany(User::class, 'competence_user', 'competence_id', 'user_id');
    }
}
