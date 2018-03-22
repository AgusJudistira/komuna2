<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competences extends Model
{
	protected $guarded =['competence'];
    public function user()
    {
        return $this->belongsToMany(User::class, 'competence_user', 'competence_id', 'user_id');
    }
}
