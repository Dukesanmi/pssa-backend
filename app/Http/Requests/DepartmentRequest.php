<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DepartmentRequest extends FormRequest
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

                'email' => 'required|email|unique:departments,email,'.$userId.',id',
                'mobile_number' => 'required|numeric|unique:departments,mobile_number,'.$userId.',id',
                'password' => 'required|min:8',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'state' => 'required',

            ];
        }
        else {

            $userId =  \Request::segment(2) > 0 ? \Request::segment(2) : 0;

            return [
               'name' => 'required',
                'email' => 'required|email|unique:departments,email,'.$userId.',id',
                'mobile_number' => 'required|numeric|unique:departments,mobile_number,'.$userId.',id',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'state' => 'required',
            ];
        }
        return [];
    }
}
