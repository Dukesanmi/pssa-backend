<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class FireDepartmentRequest extends FormRequest
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
    public function rules()
    {

        if(Request::segment(2)==null){
            return [
                'name' => 'required',
                'email' => 'required|email|unique:departments,email,id',
                'mobile_number' => 'required|numeric|unique:departments,mobile_number,id',
                'password' => 'required|min:8',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'state' => 'required',
            ];
        }else{
            return [
                'name' => 'required',
                'email' => 'required|email|unique:departments,email,id',
                'mobile_number' => 'required|numeric|unique:departments,mobile_number,id',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2000,',
                'address' => 'required',
                'state' => 'required',
            ];
        }

    }
}
