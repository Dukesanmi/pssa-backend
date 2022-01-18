<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Validator;
use App\Department;

use App\AppUser;
use DB;
use Auth;
use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = (new AppUser())->where('type',0)->count();
        $officerCount = (new AppUser())->where('type',1)->count();
        $emergencyAlertCount = DB::table('emergency_alerts')->count();
        $reportCrimeCount = DB::table('report_crimes')->count();
        $reportPolicieCount = DB::table('report_policies')->count();
        $requestAmbulanceCount = DB::table('request_ambulances')->count();
        $departmentCount = DB::table('departments')->count();
        $fireDepartmentsCount = DB::table('fire_departments')->count();
       
        return view('dashboard.index',compact('userCount','officerCount','emergencyAlertCount','reportCrimeCount','reportPolicieCount','requestAmbulanceCount','departmentCount','fireDepartmentsCount'));
       
    }


   
     public function showChangePasswordForm(){
        
                return view('department_backend.auth.changepassword');

    }

     public function admin_credential_rules(array $data)
    {
      $messages = [
        'current-password.required' => 'Please enter current password',
        'password.required' => 'Please enter password',
      ];

      $validator = Validator::make($data, [
        'current-password' => 'required',
        'password' => 'required|same:password',
        'password_confirmation' => 'required|same:password',     
      ], $messages);

      return $validator;
    } 



    public function postCredentials(ChangePasswordRequest $request)
    {

      if(Auth::guard('department'))
      { 
        $request_data = $request->All();
        
        $current_password = Auth::guard('department')->user()->password;

        
          if(Hash::check($request_data['current-password'], $current_password))
          {           
            $user_id = Auth::guard('department')->user()->id;                       
            $obj_user = (new Department())->find($user_id);
            $obj_user->password = Hash::make($request_data['password']);;
            $obj_user->save(); 
            return redirect(route('change.password'))->with('success', 'Your password updated successfully');
          }
          else
          {           
            $error = array('current-password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);   
          }
                
      }
      else
      {
        return redirect()->to('/');
      }    
    }
}
