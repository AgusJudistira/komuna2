<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization_user extends Model
{
    public $timestamps = false;

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organizations');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'users');
    }
}
