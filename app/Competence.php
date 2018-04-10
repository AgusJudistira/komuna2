<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{	
	// protected $guarded = [
	// 	'id'
	// ];
	protected $fillable = [
        'competence' 
    ];

    protected $attributes = [
        'competence' => ""
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', '_token'

	];

    public function user()
    {
        return $this->belongsToMany(User::class, 'competences_user', 'competence_id', 'user_id');
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'competences_projects', 'competence_id', 'project_id');
    }
}
