<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responder;
use Twilio\Rest\Client; 
use Illuminate\Support\Facades\Mail;
use App\EmergencyAlert;
class ResponderController extends Controller
{
    public function Index(Request $request)
    {
        $getUsers = (new Responder())->paginate(30);
        return view('responder.index',compact('getUsers'));
    }

    public function Create(Request $request)
    {   
        if($request->isMethod('get'))
        {
            return view('responder.create');
        }

        else{
            $inputs = $request->all();
            $data = [
                'first_name'=>$inputs['f_name'],
                'last_name'=>$inputs['l_name'],
                'email'=>$inputs['email'],
                'password'=>$inputs['password'],
                'phone_number'=>$inputs['mobile_number'],
                'dob'=>$inputs['dob'],
                'status'=>$inputs['status'],

            ];

            $create = (new Responder())->create($data);
            if($data)
            {
                return redirect()->route('responder');
            }
        }
    }

    public function ShareLocation(Request $request)
    {
        $inputs = $request->all();
        $responder_detail = (new Responder())->where('id',$inputs['responder_id'])->first();
        if($inputs['medium']=='email')
        {
            Mail::send('email_design.localtion_sharing',array('otplocation'=>$inputs['directions']), function($email) use($responder_detail){
                $email->to($responder_detail->email)->subject('Location Sharing');
            });

            return "email";
        }
        
        
    }

    public function ChangeEmergencyStatus(Request $request)
    {
        $inputs = $request->all();
        $update = (new EmergencyAlert())->where('id',$inputs['em_id'])->update(['status'=>0]);
        if($update){
            return "true";
        }
    }

    public function EditResponder(Request $request,$id)
    {  
        if($request->isMethod('get'))
        {
            $responder = (new Responder())->where('id',$id)->first();
        return view('responder.edit',compact('responder'));
        }

        else{
            $inputs = $request->all();
            $data = [
                'first_name'=>$inputs['f_name'],
                'last_name'=>$inputs['l_name'],
                'email'=>$inputs['email'],
                
                'phone_number'=>$inputs['mobile_number'],
                'dob'=>$inputs['dob'],
                'status'=>$inputs['status'],

            ];

            $update = (new Responder())->where('id',$id)->update($data);
            if($data)
            {
                return redirect()->route('responder')->with('success', 'Responder Updated Successfully');
            }
        }
        
    }
}
