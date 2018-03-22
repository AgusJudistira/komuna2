<?php

namespace App;

class Message extends Model
{
    public function creator()
    {
        return $this->hasOne(User::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'messages_users', 'message_id', 'user_id');
    }

}
