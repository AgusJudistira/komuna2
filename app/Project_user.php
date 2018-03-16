<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_user extends Model
{
    public $timestamps = false;

    public function project()
    {
        return $this->belongsToMany(Project::class, 'projects');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'users');
    }

}
