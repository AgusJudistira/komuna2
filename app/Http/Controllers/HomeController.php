<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sent_messages = Auth::guard('web')->user()->message_sent()->count();
        //$user_id = Auth::guard('web')->user()->id;
        //$all_messages = \App\Message::all();
        //dd($all_messages);

        $incoming_messages = Auth::guard('web')->user()->message_received()->count();
        //dd($incoming_messages);

        $unread_messages = Auth::guard('web')->user()->message_received()->where('is_read', 'false')->count();

        //dd($verzonden_berichten);
        return view('home', compact('sent_messages', 'incoming_messages', 'unread_messages'));
    }
}
