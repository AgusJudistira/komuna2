<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizations_users extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(organizations::class);
    }
}
