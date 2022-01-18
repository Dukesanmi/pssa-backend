<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PoliceOfficerRequest;
use App\AppUser;
use App\PoliceOfficer;
use DB;
use Auth;
class PoliceOfficerController extends Controller
{
     /**
     * @Get all user function
     * @param Request $request
     *
     */
      public function __construct()
    {
       // $this->middleware('auth');
       // $this->middleware(['auth','auth:department']);


    }

    public  function index(Request $request){
        try {
            if ($request->isMethod('get')) {
                $inputs = $request->all();
                $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';
              
                $getUsers = (new AppUser())->getLoginOfficerInfoList($searchKey)->orderBy('id','desc')->paginate(\Config::get('constants.PAGINATION'));
                
                return view('police_officer.index',compact('getUsers','searchKey'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {

            echo $e->getMessage();
            // something went wrong
        }
    }



	public  function create(Request $request){
        try {

            if ($request->isMethod('get')) {

                return view('police_officer.create');
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }




 	public  function store(PoliceOfficerRequest $request){
        try {

            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $otp = generateOtpToken();
                $inputs = $request->all();
    
                $image = $request->file('image');
                if (!empty($image)) {
                    $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constants.OFFICER.IMAGE_FOLDER'));
                    $image->move($destinationPath, $input['file_name']);

                }
                $userImagePath = \Config::get('constants.OFFICER.IMAGE_FOLDER');
                $imageUrl = fileBashUrl($userImagePath);
                $arrAppUser = array(
                        'country_code' => isset($inputs['country_code']) && $inputs['country_code'] != '' ? $inputs['country_code'] : '',
                        'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                        'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                        'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                        'otp' =>    $otp != '' ? $otp : '',
                        'type' =>    1,
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        'registered'=>1,
                    );     
   
                $appUsertId = (new AppUser())->insertGetId($arrAppUser);
                $arrUserInfo = array(
                    'user_id' => isset($appUsertId) && $appUsertId > 0 ? $appUsertId : '',
                    'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                    'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                    'dob' => isset($inputs['dob']) && $inputs['dob'] != '' ? $inputs['dob'] : '',
                    'gender' => isset($inputs['gender']) && $inputs['gender'] != '' ? $inputs['gender'] : '',
                    'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                    'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '',
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                    'state' => isset($inputs['state']) && $inputs['state'] != '' ? $inputs['state'] : '',
                    'police_id' =>  isset($inputs['police_id']) && $inputs['police_id'] != '' ? $inputs['police_id'] : '',
                    'rank' => isset($inputs['rank']) && $inputs['rank'] != '' ? $inputs['rank'] : '',
                    'dept' =>  isset($inputs['dept']) && $inputs['dept'] != '' ? $inputs['dept'] : '',
                    'station' =>  isset($inputs['station']) && $inputs['station'] != '' ? $inputs['station'] : '',
                    'status' =>  isset($inputs['status']) && $inputs['status'] != '' ? $inputs['status'] : '',
                    'password' =>  isset($inputs['password']) && $inputs['password'] != '' ? bcrypt($inputs['password']) : '',
                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                    'device_type' =>   isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                    'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                    'created_at' => date('y-m-d h:i:s'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'department_id' => (isset(Auth::guard('department')->user()->id)) ? Auth::guard('department')->user()->id : Auth::user()->id,
                    'login_type'=>(isset(Auth::guard('department')->user()->name)) ? 'department' : 'admin' ,
                );
                $userInfoId = (new PoliceOfficer())->insertGetId($arrUserInfo);    
                DB::commit();
                if ($appUsertId && $userInfoId) {
                    return redirect(route('officer.index'))->with('success', 'Officer created successfully');
                }
                else {
                    return redirect()->back()->with('success', 'Officer could not be created');
                }
            }
            return view('police_officer.create', compact('riderData'));
        } catch (\Exception $e) {
            DB::rollback();
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

                $getUsers = (new PoliceOfficer())->where('user_id',$id)->first();

                return view('police_officer.edit',compact('getUsers'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }



    public  function update(PoliceOfficerRequest $request, $id){
        try {

            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $otp = generateOtpToken();
                $inputs = $request->all();

 				$getUsers = (new PoliceOfficer())->where('id',$id)->first();
                $image = $request->file('image');
                if (!empty($image)) {
                    $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constants.OFFICER.IMAGE_FOLDER'));
                    $image->move($destinationPath, $input['file_name']);

                }
                $userImagePath = \Config::get('constants.OFFICER.IMAGE_FOLDER');
                $imageUrl = fileBashUrl($userImagePath);


                    $arrAppUser = array(
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : $getUsers['name'],
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : $getUsers['surname'],
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : $getUsers['profile_pic'],
                        'otp' =>    $otp != '' ? $otp : '',
                        'type' =>    1,
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        'registered'=>1,
                    );    

                $updateProfile = array(
                    
                    'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : $getUsers['name'],
                    'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : $getUsers['surname'],
                    'dob' => isset($inputs['dob']) && $inputs['dob'] != '' ? $inputs['dob'] : '',
                    'gender' => isset($inputs['gender']) && $inputs['gender'] != '' ? $inputs['gender'] : '',
                    'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : $getUsers['email'],
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : $getUsers['address'],
                    'state' => isset($inputs['state']) && $inputs['state'] != '' ? $inputs['state'] : '',
                    'police_id' => isset($inputs['police_id']) && $inputs['police_id'] != '' ? $inputs['police_id'] : $getUsers['police_id'],
                    'rank' => isset($inputs['rank']) && $inputs['rank'] != '' ? $inputs['rank'] : $getUsers['rank'],
                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : $getUsers['profile_pic'],
                    'dept' => isset($inputs['dept']) && $inputs['dept'] != '' ? $inputs['dept'] : $getUsers['dept'],
                    'station' => isset($inputs['station']) && $inputs['station'] != '' ? $inputs['station'] : $getUsers['station'],
                    'status' => isset($inputs['status']) && $inputs['status'] != '' ? $inputs['status'] : $getUsers['status'],
                    'department_id' => 1,
                );

                $updateAppUser = (new AppUser())->where('id', $id)->update($arrAppUser);
                $updateProfile = (new PoliceOfficer())->where('id',$id)->update($updateProfile);
                DB::commit();
                if ($updateProfile) {
                    return redirect(route('officer.index'))->with('success', 'Officer updated successfully');
                }
                else {
                    return redirect()->back()->with('success', 'Officer could not be updated');
                }
            }
            return view('police_officer.edit');
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }




    public function destroy(Request $request,$userId){
        try{
            if($request->isMethod('delete')){
                $user = (new PoliceOfficer())->where('user_id', $userId)->first();
                if($user->profile_pic){
                    
                    if (file_exists(public_path(\Config::get('constants.OFFICER.IMAGE_FOLDER') . '/' . $user->profile_pic))) {
                        unlink(public_path(\Config::get('constants.OFFICER.IMAGE_FOLDER') . '/' . $user->profile_pic));
                    }
                 }
                (new PoliceOfficer())->where('user_id', $userId)->delete();
                (new AppUser())->where('id', $userId)->delete();
                return redirect()->back()->with('success', 'Officer deleted successfully');
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
                $user = (new AppUser())->getLoginOfficerInfo($inputs);
                return view('police_officer.view',compact('user'));
            }
            return redirect()->back()->with('error', 'Opps! something went wrong, Please try again.');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
