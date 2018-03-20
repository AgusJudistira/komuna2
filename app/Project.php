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

    public function projectUser()
    // dit is om toegang te krijgen tot de variabelen die in de pivot tabel opgeslagen zijn
    {
         return $this->belongsToMany(Project_user::class);
    }

    public function isCompleted()
    {
    	return false;
    }
}
