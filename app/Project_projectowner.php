<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_projectowner extends Model
{
    public $timestamps = false;

    public function project()
    {
        return $this->belongsToMany(Project::class, 'projects');
    }

    public function projectowner()
    {
        return $this->belongsToMany(User::class, 'users');
    }

}
