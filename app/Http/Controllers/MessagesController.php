<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organization;
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
        // $projectmembers = $project->user()->withPivot('projectowner')->get();        

        switch (request('message_type')) {
            case 'sent':
                $msg_titel = "Verzonden berichten";
                $messages = $user->message_sent()->get();
                break;
            case 'unread':
                $msg_titel = "Ongelezen berichten";
                $messages = $user->message_received()->where('is_read', '=', false)->get();
                break;
            case 'incoming':
                $msg_titel = "Ontvangen berichten";
                $messages = $user->message_received()->get();
                break;
        }                        
        
        return view('messages.msg-index', compact('msg_titel', 'messages'));
    }


}
