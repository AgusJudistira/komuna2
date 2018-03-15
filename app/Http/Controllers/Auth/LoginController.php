<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except(['logout', 'userLogout']);
    }

    public function showLoginForm()
    {
        

        return view('auth/user-login');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::guard('web')->attempt(['email'=> $request->email, 'password' => $request->password], $request->remember)) {
            //login success
            return redirect()->route('home');
            //return redirect()->intended(route('home'));
        }
        
        //login failed
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function userLogout()
    {
        $this->guard('web')->logout();

        return redirect()->home();
    }
}
