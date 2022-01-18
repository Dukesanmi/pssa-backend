<?php

namespace App\Http\Controllers\DepartmentAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class DepartmentLoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('department_backend.auth.login');
    }
    protected function guard(){
        return Auth::guard('department');
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
        $this->middleware('guest:department')->except('logout');
    }

    public function logout(Request $request){
        Auth::guard('department')->logout();
        $request->session()->flush();
        return redirect()->guest(route( 'department.login' ));
    }



    
}
