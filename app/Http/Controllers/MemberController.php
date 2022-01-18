<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Hash;

class MemberController extends Controller
{


	use AuthenticatesUsers;

	   protected $redirectTo = '/member/home';

	    protected function guard(){
        return Auth::guard('member');
    }




	public function loginForm(Request $request)
   {
   	return view('member_auth.login');
   }

   public function memberIndex(Request $request)
   {
   	$data= (new Role())->paginate('30');
   	return view('member.index',compact('data'));
   }

   public function createRole(Request $request)
   { 
   	if($request->isMethod('get'))
   	{


   	return view('member.create');
   }

   else
   {
   	$inputs=$request->except(['scale','_token']);
   	$inputs['password']=HASH::make($inputs['password']);
   	$create=(new Role())->create($inputs);
   	return redirect()->route('member.index')->with('success','Role Created successfully');

   }
   }

   public function memberHome(Request $request)
   {
   	return view('member.home');
   }

   public function EditRole(Request $request,$id)
   {
      if($request->isMethod('get'))
      {
         $data =(new  Role())->where('id',$id)->first();
         return view('member.edit',compact('data'));
      }

      else
      {
            $inputs=$request->except(['scale','_token']);
            $data = [
               'dashboard'=>isset($inputs['dashboard'])?$inputs['dashboard']:0,
               'users'=>isset($inputs['users'])?$inputs['users']:0,
               'alerts_on_map'=>isset($inputs['alerts_on_map'])?$inputs['alerts_on_map']:0,
               'emergency_alert'=>isset($inputs['emergency_alert'])?$inputs['emergency_alert']:0

            ];
          
            $update = (new Role())->where('id',$id)->update($data);
             return redirect()->route('member.index')->with('success','Role Updated  successfully');


      }
   }
}
