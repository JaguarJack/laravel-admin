<?php

namespace Lizyu\Admin\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends BaseController
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
    protected $redirectTo = '/index';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('lizadmin::index.login');
    }
    
    public function logout(Request $request)
    {
        $this->guard()->logout();
        
        $request->session()->invalidate();
        
        return redirect('/login');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }
}
