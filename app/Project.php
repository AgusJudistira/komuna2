<?php

namespace App;

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

    public function projectowner()
    {
        return $this->belongsToMany(User::class, 'projectowners_projects', 'project_id', 'projectowner_id');
    }

    public function isCompleted()
    {
    	return false;
    }
}
