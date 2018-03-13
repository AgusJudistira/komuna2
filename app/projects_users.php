<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projects_users extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function projects()
    {
        return $this->belongsToMany(organizations::class);
    }
}
