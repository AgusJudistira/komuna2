<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function project()
    {
        return $this->belongsToMany(Project::class, 'organizations_projects', 'organization_id', 'project_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'organizations_users', 'organization_id', 'user_id');
    }
}
