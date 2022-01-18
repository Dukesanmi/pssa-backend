<?php

namespace App\Http\Controllers\FireDepartmentAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class FireDepartmentLoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('fire_backend.auth.login');
    }
    protected function guard(){
        return Auth::guard('fire');
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:fire')->except('logout');
    }

    public function logout(Request $request){
        Auth::guard('fire')->logout();
        $request->session()->flush();
        return redirect()->guest(route( 'fire.login' ));
    }
}
