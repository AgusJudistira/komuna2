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
        $sent_messages = Auth::guard('web')->user()->message_sent()->whereHas('recipient')->count();

        $incoming_messages = Auth::guard('web')->user()->message_received()->whereHas('sender')->count();

        $unread_messages = Auth::guard('web')->user()->message_received()->whereHas('sender')->where('is_read', 'false')->count();

        return view('home', compact('sent_messages', 'incoming_messages', 'unread_messages'));
    }
}
