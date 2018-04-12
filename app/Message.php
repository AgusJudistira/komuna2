<?php

namespace App;

class Message extends Model //every message has one sender and one receiver
{
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function recipient()
    {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }

}
