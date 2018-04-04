<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
        protected $fillable = [
        	'id',
			'liked_id',
			'liking_user_id',
			'like',
			'stars',
			'review'
    ];
     
    public function studyExperience()
    {
        return $this->hasOne(User::class);
    }
}
