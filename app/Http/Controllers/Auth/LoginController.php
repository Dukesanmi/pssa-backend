<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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



public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect(route('login'));
    }

    public function postLogin(Request $request)
    {
        $inputs = $request->all();

        $remember = isset($inputs['remember']) && $inputs['remember']  == 'on' ? true : false;

        if (Auth::attempt(['mobile_number' => $inputs['mobile_number']],$remember )) {

            return redirect(route('home'))->with('message', 'You are now logged in!');
        }
        else {
            return redirect(route('login'))
                ->with('errormessage', 'Your username/password combination was incorrect or not active')
                ->withInput();
        }

    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:department')->except('logout');
        $this->middleware('guest:fire')->except('logout');
    }
}
