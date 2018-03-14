<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    public function project()
    {
        return $this->belongsToMany(Project_user::class, 'projects_users', 'project_id', 'user_id');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization_user::class, 'organizations_users', 'organization_id', 'user_id');
    }
    */
}
