<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization_project extends Model
{
    public $timestamps = false;

    public function organization()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function project()
    {
        return $this->belongsToMany(Project::class);        
    }
}
