<?php

namespace App;

class Message extends Model //iedere bericht heeft maar een zender en een ontvanger
{
    public function sender()
    {
        return $this->hasOne(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->hasOne(User::class, 'recipient_id');        
    }

}
