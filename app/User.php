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

    
    // public function projectUser()
    // // dit is om toegang te krijgen tot de variabelen die in de pivot tabel opgeslagen zijn
    // {
    //      return $this->belongsToMany(Project_user::class, 'projects_user');
    // }


    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organizations_users', 'user_id', 'organization_id');
    }
}
