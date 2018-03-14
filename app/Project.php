<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function organization()
    {
        return $this->belongsToMany(Organization_project::class, 'organizations_projects', 'organization_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsToMany(Project_user::class, 'projects_users', 'project_id', 'user_id');
    }

    public function isCompleted()
    {
    	return false;
    }
}
