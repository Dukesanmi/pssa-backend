<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PoliceOfficerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
      
        if($request->isMethod('post')) {

            $inputs = \Request::all();
            $userId =  \Request::segment(2) > 0 ? \Request::segment(2) : 0;
            return [
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email|unique:police_officers,email,'.$userId.',id',
                'mobile_number' => 'required|numeric|unique:police_officers,mobile_number,'.$userId.',id',
                'mobile_number' => 'required|numeric|unique:app_users,mobile_number,'.$userId.',id',
                'password' => 'required|min:8',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'state' => 'required',
                'police_id' => 'required',
                'rank' => 'required',
                'dept' => 'required',
                'station' => 'required',
            ];
        }
        else {
         
            $userId =  \Request::segment(3) > 0 ? \Request::segment(3) : 0;
       
            return [
                'name' => 'required',
                'email' => 'required|email|unique:police_officers,email,'.$userId.',id',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'state' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'police_id' => 'required',
                'rank' => 'required',
                'dept' => 'required',
                'station' => 'required',
            ];
        }
        return [];
    }
}
