<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = [
    	'hobby'
    ];
    
    public function user()
    {
        return $this->belongsToMany(User::class, 'hobby_user');
    }
}
