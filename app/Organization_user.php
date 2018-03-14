<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization_user extends Model
{
    public $timestamps = false;

    public function organization()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
