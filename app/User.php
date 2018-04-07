<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Competence;
use App\Skill;

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
        'phone_private', 'phone_work', 'gender', 'birthday'
            ];

    protected $attributes = [
        'streetname_number' => "",
        'postal_code' => "",
        'city' => "",
        'phone_private' => "", 
        'phone_work' => "", 
        'gender' => "",
        
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
        return $this->belongsToMany(Project::class, 'projects_users', 'user_id', 'project_id');
    }

    public function projectExperience()
    {
        return $this->belongsToMany(Project::class, 'projectexperiences_users', 'user_id', 'project_id');
    }
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organizations_users', 'user_id', 'organization_id');
    }

    public function competence()

    {
        return $this->belongsToMany(Competence::class, 'competences_user');
    }

    public function message_sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function message_received()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function workExperience()
    {
        return $this->hasMany(WorkExperience::class);
    }
    
    public function studyExperience()
    {
        return $this->hasMany(StudyExperience::class);
    }


    public function skill()

    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'rating_user_id', 'user_id');
    }

    public function reviewed()
    {
        return $this->hasMany(Review::class, 'rated_user_id', 'user_id');
    }
}
