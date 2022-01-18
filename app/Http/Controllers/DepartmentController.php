<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use DB;

class DepartmentController extends Controller
{

     public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
        public  function index(Request $request){
        try {
            if ($request->isMethod('get')) {
                $inputs = $request->all();
                $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';
              
                $getDepartment = (new Department())->getDepartmentList($searchKey)->orderBy('id','desc')->paginate(\Config::get('constants.PAGINATION'));
               
                return view('department.index',compact('getDepartment','searchKey'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {

            echo $e->getMessage();
            // something went wrong
        }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function create(Request $request){
        try {

            if ($request->isMethod('get')) {


                return view('department.create');
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
       
       try {

            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $otp = generateOtpToken();
                $inputs = $request->all();
    
                $image = $request->file('image');
                if (!empty($image)) {
                    $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constants.DEPARTMENT_IMAGE'));
                    $image->move($destinationPath, $input['file_name']);

                }
                $userImagePath = \Config::get('constants.DEPARTMENT_IMAGE');
                $imageUrl = fileBashUrl($userImagePath);
             
                $arrUserInfo = array(
                    'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                    'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                    'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                    'city' => isset($inputs['city']) && $inputs['city'] != '' ? $inputs['city'] : '',
                    'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '',
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                    'state' => isset($inputs['state']) && $inputs['state'] != '' ? $inputs['state'] : '',
                    'status' => isset($inputs['status']) && $inputs['status'] != '' ? $inputs['status'] : 1,
                    'password' =>  isset($inputs['password']) && $inputs['password'] != '' ? bcrypt($inputs['password']) : '',
                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                    'device_type' =>   isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                    'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                    'created_at' => date('y-m-d h:i:s'),
                    'updated_at' => date('y-m-d h:i:s'),
                );
           
                $userInfoId = (new Department())->insertGetId($arrUserInfo);    
                if ($userInfoId) {
                    DB::commit();
                    return redirect(route('department.index'))->with('success', 'Department created successfully');
                }
                else {
                    return redirect()->back()->with('success', 'Department could not be created');
                }
            }
            return view('department.edit');
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
          try {

            if ($request->isMethod('get')) {
                $user = (new Department())->where('id',$id)->first();
                return view('department.view',compact('user'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
            try {

            if ($request->isMethod('get')) {

                $getUsers = (new Department())->where('id',$id)->first();
              
                return view('department.edit',compact('getUsers'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        try {

                
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $otp = generateOtpToken();
                $inputs = $request->all();
                $getUsers = (new Department())->where('id',$id)->first();
                $image = $request->file('image');
                if (!empty($image)) {
                    $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constants.DEPARTMENT_IMAGE'));
                    $image->move($destinationPath, $input['file_name']);

                }
                $userImagePath = \Config::get('constants.DEPARTMENT_IMAGE');
                $imageUrl = fileBashUrl($userImagePath);
             
                $updateProfile = array(
                    'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : $getUsers['mobile_number'],
                    'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : $getUsers['name'],
                    'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : $getUsers['surname'],
                    'city' => isset($inputs['city']) && $inputs['city'] != '' ? $inputs['city'] : $getUsers['city'],
                    'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : $getUsers['email'],
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : $getUsers['address'],
                    'state' => isset($inputs['state']) && $inputs['state'] != '' ? $inputs['state'] : $getUsers['state'],
                                        'status' => isset($inputs['status']) && $inputs['status'] != '' ? $inputs['status'] : $getUsers['status'],

                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : $getUsers['profile_pic'],
                    'device_type' =>   isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : $getUsers['device_type'],
                    'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : $getUsers['device_token'],
                    'created_at' => date('y-m-d h:i:s'),
                    'updated_at' => date('y-m-d h:i:s'),
                );
           
                $updateProfile = (new Department())->where('id',$id)->update($updateProfile);
                if ($updateProfile) {
                    DB::commit();
                    return redirect(route('department.index'))->with('success', 'Department created successfully');
                }
                else {
                    return redirect()->back()->with('success', 'Department could not be created');
                }
            }
            return view('department.edit', compact('getUsers'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $department, $id)
    {
          try{
            if($department->isMethod('delete')){
                $user = (new Department())->where('id', $id)->first();

                if($user->profile_pic){
               
                     if (file_exists(public_path(\Config::get('constants.DEPARTMENT_IMAGE') . '/' . $user->profile_pic))) {
                    unlink(public_path(\Config::get('constants.DEPARTMENT_IMAGE') . '/' . $user->profile_pic));
                }
                 }
               
                (new Department())->where('id', $id)->delete();
                return redirect()->back()->with('success', 'Department deleted successfully');
            }
            return redirect()->back()->with('error','Whoops,looks like something went wrong');
        } catch (\Exception $e){
            echo $e->getMessage();
            // something went wrong
        }
    }
}
