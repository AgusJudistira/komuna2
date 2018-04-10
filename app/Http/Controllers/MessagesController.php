<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organization;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showMessages()
    {
        $user = Auth::guard('web')->user();        

        switch (request('message_type')) {
            case 'sent':
                $msg_type = "Verzonden berichten";
                $messages = $user->message_sent()->whereHas('recipient')->latest()->get();                
                break;
            case 'unread':
                $msg_type = "Ongelezen berichten";                
                $messages = $user->message_received()->whereHas('sender')->where('is_read', '=', false)->latest()->get();
                break;
            case 'incoming':
                $msg_type = "Ontvangen berichten";
                $messages = $user->message_received()->whereHas('sender')->latest()->get();                
                break;
            default:
                $messages = Array();
                break;
        }
        
        return view('messages.msg-index', compact('msg_type', 'messages'));
    }

    public function focusMessage(Message $message)
    {
        $user_id = Auth::guard('web')->user()->id;

        if ($message->sender_id != $user_id && $message->recipient_id != $user_id) {
            return back();
        }

        if ($message->sender_id != $user_id) { // if the user reading is not the sender
            $message->is_read = true; //Mark message as read
            $message->save();
        }        

        return view('messages/msg-show', compact('message'));
    }

}
