<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organizations_projects', 'organization_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'projects_users', 'project_id', 'user_id');
    }

    public function isCompleted()
    {
    	return false;
    }
}
