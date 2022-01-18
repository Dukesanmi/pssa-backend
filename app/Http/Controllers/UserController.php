<?php

namespace App\Http\Controllers;

use App\Move;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\AppUser;
use Hash;
use DB;
use App\UserInfo;

class UserController extends Controller
{
    /**
     * @Get all user function
     * @param Request $request
     *
     */
     public function __construct()
    {
        //$this->middleware('auth');
    }

    public  function index(Request $request){
        try {
            if ($request->isMethod('get')) {
                $inputs = $request->all();
                $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';
              
                $getUsers = (new AppUser())->getLoginUserInfoList($searchKey)->orderBy('id','desc')->paginate(\Config::get('constant.PAGINATION'));

                return view('user.index',compact('getUsers','searchKey'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {

            echo $e->getMessage();
            // something went wrong
        }
    }


    /**
     * @Edit Rider post Method
     * @param Request $request
     *
     */


    public  function edit(Request $request, $id){
        try {

            if ($request->isMethod('get')) {

                $getUsers = (new AppUser())->getUser($id)->first();

                return view('user.edit',compact('getUsers'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }



    public  function update(UserRequest $request, $id){
        try {
            $validated = $request->validated();
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $inputs = $request->all();

                $image = $request->file('image');
                if (!empty($image)) {
                   $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                   pr($input['file_name']);
                    $destinationPath = public_path(\Config::get('constant.USER_IMAGE'));
                    $image->move($destinationPath,  $input['file_name']);
                }
                $userImagePath = \Config::get('constant.USER_IMAGE');
                $imageUrl = fileBashUrl($userImagePath);

                $updateProfile = array(
                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '' ,
                    'email'=>isset($inputs['email']) && $inputs['email']!=''? $inputs['email']:'',
                    'dob'=>isset($inputs['dob']) && $inputs['dob']!='' ? $inputs['dob'] : '',
                    'home_state'=>isset($inputs['state']) && $inputs['state']!='' ? $inputs['state'] :'',
                    'name'=>isset($inputs['user_name']) && $inputs['user_name']!='' ? $inputs['user_name']: '',
                    'mobile_number' => isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                    'latitude' => isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : 0,
                    'longitude' => isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : 0,
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                    'device_token' => isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                    'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                );

                (new AppUser())->where('id',$id)->update(['country_code'=>isset($inputs['country_code']) && $inputs['country_code'] != '' ? $inputs['country_code'] : '']);
                    if(empty($image)){
                        unset($updateProfile['profile_pic']);
                    }
                $updateProfile=(new UserInfo())->where('user_id',$id)->update($updateProfile);
                DB::commit();
                if ($updateProfile) {
                    return redirect(route('user.index'))->with('success', 'User updated successfully');
                }
                else {
                    return redirect()->back()->with('success', 'User could not be updated');
                }
            }
            return view('rider.edit', compact('riderData'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }




    public function destroy(Request $request,$userId){

        try{
            if($request->isMethod('delete')){
                $user = (new AppUser())->where('id', $userId)->first();

                if (file_exists(public_path(\Config::get('constant.USER_IMAGE') . '/' . $user->profile_pic)) && !empty($user->profile_pic)) {
                    unlink(public_path(\Config::get('constant.USER_IMAGE') . '/' . $user->profile_pic));
                }
                (new AppUser())->where('id', $userId)->delete();
                return redirect()->back()->with('success', 'User deleted successfully');
            }
            return redirect()->back()->with('error','Whoops,looks like something went wrong');
        } catch (\Exception $e){
            echo $e->getMessage();
            // something went wrong
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        try {
            if ($request->isMethod('get')) {
                $inputs['user_id'] = $id;
                $user = (new AppUser())->getLoginUserInfo($inputs);
                return view('user.view',compact('user'));
            }
            return redirect()->back()->with('error', 'Opps! something went wrong, Please try again.');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }





}

