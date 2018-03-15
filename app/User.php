<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
        'streetname_number', 'postal_code', 'city',
        'phone_private', 'phone_work', 'gender'
    ];

    protected $attributes = [
        'streetname_number' => "",
        'postal_code' => "",
        'city' => "",
        'phone_private' => "", 
        'phone_work' => "", 
        'gender' => ""
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'projects_users', 'project_id', 'user_id');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organizations_users', 'organization_id', 'user_id');
    }
}
