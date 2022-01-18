<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;
use Validator;
use App\AppUser;
use App\EmergencyContact;
use DB;
use Hash;
use App\Test;
use App\UserInfo;
use App\TestFile;
use App\EmergencyAlertFile;
use App\EmergencyAlert;
use App\Crime;
use App\CrimeFile;
use App\Police;
use App\User;
use App\PoliceFile;
use App\PoliceOfficer;
use App\Ambulance;
use App\Department;
use App\Notification;
use App\UserRequest;
use Carbon\Carbon;
use App\Contact;

class UserController extends Controller
{
    
    /**
     * @User Login post function
     * @param Request $request
     */

    public function login(Request $request)
    {

        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();
                $inputs = $request->all();
                $otp = generateOtpToken();
                $otp = "1234";
                $getUserInfo = (new AppUser())->checkExistUserMobileNumber($inputs);

                $updateOtp = '';

                if($getUserInfo){

                $updateOtp  = (new AppUser())->where('id', $getUserInfo['id'])->update(['otp' => $otp]);

                } else{


                    $arrAppUser = array(
                        'country_code' => isset($inputs['country_code']) && $inputs['country_code'] != '' ? $inputs['country_code'] : '',
                        'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                        'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '',
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                        'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                        'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                        'otp' =>    $otp != '' ? $otp : '',
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                    );   
                    $appUsertId = (new AppUser())->insertGetId($arrAppUser);
                    $arrUserInfo = array(
                        'user_id' => isset($appUsertId) && $appUsertId > 0 ? $appUsertId : '',
                        'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                        'mobile_number2' =>  isset($inputs['mobile_number2']) && $inputs['mobile_number2'] != '' ? $inputs['mobile_number2'] : '',
                        'mobile_number3' =>  isset($inputs['mobile_number3']) && $inputs['mobile_number3'] != '' ? $inputs['mobile_number3'] : '',
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                        'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '',
                        'dob' => isset($inputs['dob']) && $inputs['dob'] != '' ? $inputs['dob'] : '',
                        'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                        'home_state' => isset($inputs['home_state']) && $inputs['home_state'] != '' ? $inputs['home_state'] : '',
                        'office_state' => isset($inputs['office_state']) && $inputs['office_state'] != '' ? $inputs['office_state'] : '',
                        'office_address' =>  isset($inputs['office_address']) && $inputs['office_address'] != '' ? $inputs['office_address'] : '',
                        'current_address' => isset($inputs['current_address']) && $inputs['current_address'] != '' ? $inputs['current_address'] : '',
                        'gender' =>  isset($inputs['gender']) && $inputs['gender'] != '' ? $inputs['gender'] : 0,
                        'hospital_name' =>  isset($inputs['hospital_name']) && $inputs['hospital_name'] != '' ? $inputs['hospital_name'] : '',
                        'blood_group' =>  isset($inputs['blood_group']) && $inputs['blood_group'] != '' ? $inputs['blood_group'] : '',
                        'nhis_number' =>  isset($inputs['nhis_number']) && $inputs['nhis_number'] != '' ? $inputs['nhis_number'] : '',
                        'allergy' =>  isset($inputs['allergy']) && $inputs['allergy'] != '' ? $inputs['allergy'] : '',
                        'medicine' => isset($inputs['medicine']) && $inputs['medicine'] != '' ? $inputs['medicine'] : '',
                        'vital_info' =>  isset($inputs['vital_info']) && $inputs['vital_info'] != '' ? $inputs['vital_info'] : '',
                        'latitude' =>  isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : 0,
                        'longitude' =>  isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : 0,
                        'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                        'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                    );

                   $userInfoId = (new UserInfo())->insertGetId($arrUserInfo);
                }

                if ($updateOtp || $appUsertId && $userInfoId) {

                    // $phoneMessage = 'Hi ' . $getUserInfo['name'] . ' your otp  is ' . $otp;
                    // otpSendMessage($otp,$getUserInfo['mobile_number']);
                    DB::commit();

                    if(isset($getUserInfo) && $getUserInfo!=''){

                        return ['success'=>true,'statusCode'=>200,"message"=>"Please verify your mobile number",'result'=>$getUserInfo->toArray()];

                    } else {

                        return ['success'=>true,'statusCode'=>200,"message"=>"Please verify your mobile number",'result'=>['id'=>$appUsertId,'mobile_number'=>$inputs['mobile_number'],'registered'=>0,'type'=>0]];
                    }
                   
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "Invalid mobile number");
                    
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }




     /**
     * @Match otp  post method
     * @param Request $request
     * @return mixed
     */

    public function otpVerification(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();
  
                $deviceType =  isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '';
                $deviceToken =  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '';
                $latitude =  isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                $longitude =  isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                          
                $updateOtp = (new AppUser())->where('id', $inputs['user_id'])->update(['device_type' => $deviceType,'device_token' => $deviceToken,'mobile_number_verify_status' => 1]);
   
                // revoke token

                if($inputs['type'] == 0){

                    (new UserInfo())->where('user_id', $inputs['user_id'])->update(['device_type' => $deviceType,'device_token' => $deviceToken, 'latitude' => $latitude, 'longitude' => $longitude]);
                    $getUserInfo = (new AppUser())->getVerifyUserInfo($inputs);

                }    
                else { 
                    (new PoliceOfficer())->where('user_id', $inputs['user_id'])->update(['device_type' => $deviceType,'device_token' => $deviceToken, 'latitude' => $latitude, 'longitude' => $longitude]);
                    $getUserInfo = (new AppUser())->getVerifyOfficerInfo($inputs);
 
                }
       
                $getUserInfoArr = isset($getUserInfo) && $getUserInfo != '' ? $getUserInfo->toArray() : [];
                if ($getUserInfo && $updateOtp) {
                    DB::commit();
                    // $data=$this->registeringToken($inputs['user_id']);
                    $getUserInfoArr['token'] = 'access_token';
                    return jsonResponse(true, 200, "Your otp match successfully",[],$getUserInfoArr);
                } 
                else {
                   
                    return ['success'=>false, 'status_code'=>200, "message"=>"Your otp does not match"];
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }



      /**
     * @Driver resend verification token post function
     * @param Request $request
     * @return mixed
     */
    public function resentOtp(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $otp = generateOtpToken();
                $inputs = $request->all();
                $updateOtp = (new AppUser())->where('id', $inputs['user_id'])->update(['otp' => $otp]);
                $getUserInfo = (new AppUser())->getLoginUserInfo($inputs);
                if ($updateOtp) {
                    otpSendMessage($otp,$getUserInfo['mobile_number']);
                    DB::commit();
                    return jsonResponseWithoutResult(true, 200, "Otp has been sent to your phone");
                } 
                else {
                   
                    return jsonResponseWithoutResult(false, 200, "Oops! something went wrong, please try again?");
                }
            }
           
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
}


        public function register(Request $request)
        {

            try {

                if ($request->isMethod('post')) {
                    DB::beginTransaction();
                    $inputs = $request->all();
			        //Auth::guard('app_user')->user()->token()->revoke();

                    $getUserInfo = (new AppUser())->getLoginUserInfo($inputs);

                    if(!$getUserInfo){
                        
                        return jsonResponseWithoutResult(false, 200, "Invalid user id");

                        } else {
                    $otp = generateOtpToken();
                    $getUserInfoArr = isset($getUserInfo) && $getUserInfo != '' ? $getUserInfo->toArray() : [];
                     $image = $request->file('profile_pic');
                    if (!empty($image)) {
                        $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path(\Config::get('constants.USER.IMAGE_FOLDER'));
                        $image->move($destinationPath, $input['file_name']);
                    }

                    $userImagePath = \Config::get('constants.USER.IMAGE_FOLDER');
                    $imageUrl = fileBashUrl($userImagePath);


                      $arrAppUser = array(
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : $getUserInfo['name'],
                        'country_code'=>isset($inputs['country_code']) && $inputs['country_code'] != '' ? $inputs['country_code'] : $getUserInfo['country_code'],
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : $getUserInfo['surname'],
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : $getUserInfo['profile_pic'],
                        'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : $getUserInfo['device_type'],
                        'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : $getUserInfo['device_token'],
                        'otp' =>    $otp != '' ? $otp : '',
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        'registered'=>1,
                    );
                    $arrUpdateProfile = array(
                        'user_id' =>isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '',
                        'mobile_number' =>  isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                        'mobile_number2' =>  isset($inputs['mobile_number2']) && $inputs['mobile_number2'] != '' ? $inputs['mobile_number2'] : '',
                        'mobile_number3' =>  isset($inputs['mobile_number3']) && $inputs['mobile_number3'] != '' ? $inputs['mobile_number3'] : '',
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '',
                        'surname' => isset($inputs['surname']) && $inputs['surname'] != '' ? $inputs['surname'] : '',
                        'email' => isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '',
                        'dob' => isset($inputs['dob']) && $inputs['dob'] != '' ? $inputs['dob'] : '',
                        'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                        'home_state' => isset($inputs['home_state']) && $inputs['home_state'] != '' ? $inputs['home_state'] : '',
                        'office_state' => isset($inputs['office_state']) && $inputs['office_state'] != '' ? $inputs['office_state'] : '',
                        'office_address' =>  isset($inputs['office_address']) && $inputs['office_address'] != '' ? $inputs['office_address'] : '',
                        'current_address' => isset($inputs['current_address']) && $inputs['current_address'] != '' ? $inputs['current_address'] : '',
                        'gender' =>  isset($inputs['gender']) && $inputs['gender'] != '' ? $inputs['gender'] : 0,
                        'hospital_name' =>  isset($inputs['hospital_name']) && $inputs['hospital_name'] != '' ? $inputs['hospital_name'] : '',
                        'blood_group' =>  isset($inputs['blood_group']) && $inputs['blood_group'] != '' ? $inputs['blood_group'] : '',
                        'nhis_number' =>  isset($inputs['nhis_number']) && $inputs['nhis_number'] != '' ? $inputs['nhis_number'] : '',
                        'allergy' =>  isset($inputs['allergy']) && $inputs['allergy'] != '' ? $inputs['allergy'] : '',
                        'medicine' => isset($inputs['medicine']) && $inputs['medicine'] != '' ? $inputs['medicine'] : '',
                        'vital_info' =>  isset($inputs['vital_info']) && $inputs['vital_info'] != '' ? $inputs['vital_info'] : '',
                        'latitude' =>  isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : 0,
                        'longitude' =>  isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : 0,
                        'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                        'device_token' =>  isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                        'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        
                    );

                
                    $updateAppUser = (new AppUser())->where('id', $inputs['user_id'])->update($arrAppUser);
                    $updateUserInfo = (new UserInfo())->where('user_id', $inputs['user_id'])->update($arrUpdateProfile);
                    $getNewUserInfo = (new AppUser())->getLoginUserInfo($inputs);
                    $generateAuthToken = (new AppUser())->where('id',$inputs['user_id'])->first();
                    $getLastUserInfoArr = isset($getNewUserInfo) && $getNewUserInfo != '' ? $getNewUserInfo->toArray() : [];

                    if ($updateAppUser && !empty($getUserInfo) && $updateUserInfo) {
                       // $data=$this->registeringToken($inputs['user_id']);
                        //$getLastUserInfoArr['token'] =  $data['access_token'];
                        DB::commit();
                        return jsonResponse(true, 200, "Profile update successfully", [], $getLastUserInfoArr);
                       
                    } else {
                     
                        return jsonResponseWithoutResult(false, 200, "Your Profile could not be updated");
                    }
                }
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
                DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }
        }

//        Function to create access token
    public function registeringToken($user_id){

        $generateAuthToken = (new AppUser())->where('id',$user_id)->first();

        if (!session('app_user_id')) {
           session(['app_user_id' => $user_id]);
        }

        $userId = session()->get('app_user_id');
        DB::table('oauth_access_tokens')->where('user_id', $userId)->update(['revoked' => true]);

        $tokenResult = $generateAuthToken->createToken('Personal Access Token');
        $token = $tokenResult->token;

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
    }

         /**
     * @User Change Password post function
     * @param Request $request
     * @return mixed
     */


    public function changePassword(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();
                $getUserInfo = (new AppUser())->getLoginUser($inputs);
                $newPassword = Hash::make(trim($inputs['new_password']));
                $oldPassword = trim($inputs['old_password']);
                if (Hash::check(trim($oldPassword), $getUserInfo['password']) && !empty($getUserInfo)) {
                    $updateUserPassword = (new AppUser())->where('id', $getUserInfo['id'])->update(['password' => $newPassword]);
                    DB::commit();
                    if ($updateUserPassword) {
                       
                            return jsonResponseWithoutResult(true, 200, "Password update successfully.");
                        
                    } else {
                        
                            return jsonResponseWithoutResult(false, 200, "Your password could not be changed successfully please try again?");
                       
                    }
                } else {
                  
                        return jsonResponseWithoutResult(false, 200, "Your old password does not match!");
                   
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            //echo $e->getMessage();
            // something went wrong
        }
    }




       public function logout(Request $request)
       {
    	  $userInfo =  Auth::guard('app_user')->user();
	
           if($userInfo['type'] == 0){

                    (new UserInfo())->where('user_id', $userInfo['id'])->update(['device_token' => '']);
                    (new AppUser())->where('id',$userInfo['id'])->update(['device_token' => '']);

                }    
                else {
                    (new PoliceOfficer())->where('user_id', $userInfo['id'])->update(['device_token' => '']);
                    (new AppUser())->where('id',$userInfo['id'])->update(['device_token' => '']);
 
                }
         
                Auth::guard('app_user')->user()->token()->revoke();

            //$request->user()->token()->revoke();
            // return response()->json([
            //     'message' => 'Successfully logged out'
            // ]);
            return jsonResponseWithoutResult(true, 200, "Successfully logged out");

        }
        public function user(Request $request)
        {
                return Auth::user();
        }



          public function emergencyContact(Request $request)
         {
            try {
                if ($request->isMethod('post')) {
                    DB::beginTransaction();
                    $inputs = $request->all();
                    $getUserInfo = DB::table('app_users')->where('id', $inputs['user_id'])->first();
                    $image = $request->file('contact_pic');

                    if (!empty($image)) {
                        $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path(\Config::get('constants.USER.IMAGE_FOLDER'));
                        $image->move($destinationPath, $input['file_name']);
                    }
                    $userImagePath = \Config::get('constants.USER.IMAGE_FOLDER');
                    $imageUrl = fileBashUrl($userImagePath);

                    if(!$getUserInfo){
                    
                         return jsonResponse(false, 200, "Invalid user id");

                    }else{

                        $inputs['name'] = isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '';
                        $inputs['email'] = isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : '';
                        $inputs['mobile_number'] = isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '';
                        $inputs['address'] = isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '';
                        $inputs['relation'] = isset($inputs['relation']) && $inputs['relation'] != '' ? $inputs['relation'] : '';
                        $inputs['contact_pic']= isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name']:'';
                        $emergencyContact = (new EmergencyContact())->create($inputs);
                        $inputs['ec_id'] = $emergencyContact->id;
                    }
                    $getNewUserInfo = (new EmergencyContact())->getUserEcInfo($inputs);
                    $getLastUserInfoArr = isset($getNewUserInfo) && $getNewUserInfo != '' ? $getNewUserInfo->toArray() : [];

                    if ($emergencyContact && !empty($getUserInfo)) {
                        DB::commit();
                        return jsonResponse(true, 200, "User emergency contact created successfully",[],$getLastUserInfoArr);
                       
                    } else {
                       
                        return jsonResponse(false, 200, "Could not be created user emergency contact",[],$getLastUserInfoArr);
                        
                    }
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
                DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }
         }




            /**
     * @Match otp  post method
     * @param Request $request
     * @return mixed
     */

    public function emergencyContactList(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
              
                $inputs = $request->all();
                $emergencyContactList = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->get();
                //pr($emergencyContactList);
                //die;
               //!$emergencyContactList->isEmpty()
                $emergencyContactListArr = isset($emergencyContactList) && $emergencyContactList != '' ? $emergencyContactList->toArray() : [];
                if ($emergencyContactListArr) {
                      
                    return jsonResponse(true, 200, "User emergency contact found successfully",[],$emergencyContactListArr);
              
                } else {
                   
                    return jsonResponse(false, 200, "Could not be found emergency contact",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }

      public function deleteEmergencyContact(Request $request){
            

             try {
                if ($request->isMethod('post')) {
                    
                  DB::beginTransaction();
                    $inputs = $request->all();
                    $getUserInfo = DB::table('app_users')->where('id', $inputs['user_id'])->first();
                 
                    if(!$getUserInfo){
                        
                             return jsonResponse(false, 200, "Invalid user id");

                        } else{

                            $deleteEmergencyContact = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->where('id', $inputs['contact_id'])->delete();
                          
                            if ($deleteEmergencyContact) {
                                  DB::commit();
                                return jsonResponseWithoutResult(true, 200, "User emergency contact deleted successfully");
                  
                             } else {
                           
                                return jsonResponseWithoutResult(false, 200, "Could not be deleted emergency contact");
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }

        }



        public function test(Request $request){
             try {

                if ($request->isMethod('post')) {
                    $otp = generateOtpToken();
                    DB::beginTransaction();
                    $inputs = $request->all();

                    $getUserInfo = DB::table('user_informations')->where('user_id', $inputs['user_id'])->first();

                    if(!$getUserInfo){
                        
                             return jsonResponseWithoutResult(false, 200, "Invalid user id");

                        } else{

                        
                            $imageFiles = $request->file('image');
                            $audio = $request->file('recording');
                            $imageUrl = fileBashUrl(\Config::get('constants.TEST_IMAGE'));
                            $audioUrl = fileBashUrl(\Config::get('constants.TEST_AUDIO'));


                            if (!empty($audio)) {
                                $input['audio_file_name'] = time() . '.' . $audio->getClientOriginalExtension();
                                $destinationPath = public_path(\Config::get('constants.TEST_AUDIO'));
                                $audio->move($destinationPath, $input['audio_file_name']);
                            }
                          
                            $inputs['user_id'] = isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '';
                            $inputs['recording'] = isset($input['audio_file_name']) && $input['audio_file_name'] != '' ? $audioUrl .'/'. $input['audio_file_name'] : '';

                            $inputs['latitude'] = isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                            $inputs['longitude'] = isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                            $inputs['battery_label'] = isset($inputs['battery_label']) && $inputs['battery_label'] != '' ? $inputs['battery_label'] : '';
                            $inputs['recording']= isset($input['audio_file_name']) && $input['audio_file_name'] != '' ? $audioUrl . '/' . $input['audio_file_name']:'';
                             $inputs['unique_code']= 'NPF-TEST'.$otp;
                            $inputs['network_provider']= isset($inputs['network_provider']) && $inputs['network_provider'] != ''  ? $inputs['network_provider'] : '';
                            $inputs['types_of_problem']= isset($inputs['types_of_problem']) && $inputs['types_of_problem'] != ''  ? $inputs['types_of_problem'] : '';
                            $inputs['person_count']= isset($inputs['person_count']) && $inputs['person_count'] != ''  ? $inputs['person_count'] : 0;
                            $inputs['network_strength']= isset($inputs['network_strength']) && $inputs['network_strength'] != ''  ? $inputs['network_strength'] : 0;
                          
                            $textData = (new Test())->create($inputs);

                            //$inputs['text_id'] = $textData->id;

                                if (!empty($imageFiles)) {

                                    foreach($imageFiles as $image) {
                                        $input['image_name'] = time() . rand(0, 9) . uniqid() . '.' . $image->getClientOriginalExtension();
                                        $destinationPath = public_path(\Config::get('constants.TEST_IMAGE'));
                                        $image->move($destinationPath, $input['image_name']);
                                   (new TestFile())->create(['test_id' => $textData->id,  'file' => $imageUrl .'/'. $input['image_name']] );

                                    }
                                }

                                $messageData =   "Name - ".$getUserInfo->name.", Email - ".$getUserInfo->email.", Mobile Number - ".$getUserInfo->mobile_number.", Current address - ".$getUserInfo->current_address.", Blood group - ".$getUserInfo->blood_group.", Allergy - ".$getUserInfo->allergy.", Medicine - ".$getUserInfo->medicine.", Network provider - ".$inputs['network_provider'].", Network strength - ".$inputs['network_strength'].", Battery label- ".$inputs['battery_label'].",Problem type - ".$inputs['types_of_problem'].",Person count - ".$inputs['person_count'].",Recording - ".$inputs['recording'].", https://www.google.de/maps?q=".$inputs['latitude'].",".$inputs['longitude']."  Googe Map";
                                    
                                sendMessage($messageData,$getUserInfo->mobile_number);
                                //  pr(sendMessage($data1,$getUserInfo->mobile_number));    
                                 // die;            

                                //  \Mail::send('email_design.text',compact('inputs'), function($email) use ($getUserInfo, $inputs)
                                // {

                                //     $email->to($getUserInfo->email)->subject('NPFRecueMe - '.'Hi ' . $getUserInfo->name);
                                // });

                                
                            if ($textData) {
                                DB::commit();
                                return jsonResponseWithoutResult(true, 200, "Send text successfully");
                  
                             } else {
                           
                                return jsonResponseWithoutResult(false, 200, "Could not Send text successfully");
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }

        }




        public function emergencyAlert(Request $request){
             try {
                if ($request->isMethod('post')) {
                    $otp = generateOtpToken();
                    DB::beginTransaction();
                    $inputs = $request->all();
                    $getUserInfo = DB::table('user_informations')->where('user_id', $inputs['user_id'])->first();
                    $officerData = (new PoliceOfficer())->getNearByPoliceOfficer($inputs);
                    $departmentData = (new Department())->findStateDepartment($inputs);

                    $getUserInfoMobile = DB::table('app_users')->where('id', $inputs['user_id'])->first();

                    if(!$getUserInfo){
                        
                             return jsonResponseWithoutResult(false, 200, "Invalid user id");

                        } else {

                            $emergencyContacts = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->get();
                            $imageFiles = $request->file('image');
                            $audio = $request->file('recording');
                            $imageUrl = fileBashUrl(\Config::get('constants.EM_IMAGE'));
                            $audioUrl = fileBashUrl(\Config::get('constants.EM_AUDIO'));

                            if (!empty($audio)) {
                                $input['audio_file_name'] = time() . '.' . $audio->getClientOriginalExtension();
                                $convertAudio =  "ffmpeg -i ".$input['audio_file_name']." -c:a libmp3lame ".time() . '.' ."mp3";
                                $mp3 = substr($convertAudio, strpos($convertAudio, 'libmp3lame') + 11);
                                $destinationPath = public_path(\Config::get('constants.EM_AUDIO'));
                                $audio->move($destinationPath, $mp3);
                            }
                          
                            //$convertAudio = exec("sox ".$destinationPath.'/'.$input['audio_file_name']." ".$destinationPath."  ".time() . '.' ."mp3");
                       
                            $inputs['user_id'] = isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '';
                            $inputs['recording'] = isset($mp3) && $mp3 != '' ? $audioUrl .'/'.$mp3 : '';
                            $inputs['latitude'] = isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                            $inputs['longitude'] = isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                            $inputs['battery_label'] = isset($inputs['battery_label']) && $inputs['battery_label'] != '' ? $inputs['battery_label'] : '';
                            $inputs['unique_code']= 'PSSA-EC'.$otp;
                            $inputs['network_provider']= isset($inputs['network_provider']) && $inputs['network_provider'] != ''  ? $inputs['network_provider'] : '';
                            $inputs['types_of_problem']= isset($inputs['types_of_problem']) && $inputs['types_of_problem'] != ''  ? $inputs['types_of_problem'] : '';
                            $inputs['person_count']= isset($inputs['person_count']) && $inputs['person_count'] != ''  ? $inputs['person_count'] : 0;
                            $inputs['network_strength']= isset($inputs['network_strength']) && $inputs['network_strength'] != ''  ? $inputs['network_strength'] : 0;
                            $inputs['department_id'] =  isset($departmentData) && $departmentData->id > 0  ? $departmentData->id : 0;
                            $inputs['comment'] =  '';
                            $inputs['police_officer_id']= 0;

                            $textData = (new EmergencyAlert())->create($inputs);
                        //getting location from lat and long start
                        $curl = curl_init();
                        $lat=$inputs['latitude'];
                        $long=$inputs['longitude'];
                        $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyDCnPPUlxFHB2SfT50yFeYrPDOpw85HxIk";

//                        AIzaSyB_qKPUMBlxYHTkYST7hpy3d0aqKHwsLrM  not working api key
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'APIKEY: 111111111111111111111',
                            'Content-Type: application/json',
                            'Accept: application/json',
                        ));
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        $result = curl_exec($curl);
                        if(!$result){die("Connection Failure");}
                        curl_close($curl);
                        $data=json_decode($result,true);
                        $inputs['formatted_address']= $data['results']['0']['formatted_address'];
                        (new EmergencyAlert())->where('id',$textData->id)->update(['em_address'=>$inputs['formatted_address']]);
                        //end
                            if (!empty($imageFiles)) {


                                $fileUrl = array();

                                foreach($imageFiles as $image) {

                                    $input['image_name'] = time() . rand(0, 9) . uniqid() . '.' . $image->getClientOriginalExtension();
                                    $destinationPath = public_path(\Config::get('constants.EM_IMAGE'));
                                    $image->move($destinationPath, $input['image_name']);
                                    (new EmergencyAlertFile())->create(['em_alert_id' => $textData->id,  'file' => $imageUrl .'/'. $input['image_name']] );
                                    $fileUrl[] =  $imageUrl .'/'. $input['image_name'];
                                }
                                

                                //$stringFile = implode(",", $fileUrl);
                                $stringFile =  implode(",\n",$fileUrl);

                        

                            }
                            $imagesUrl =  isset($stringFile) && $stringFile != '' ? $stringFile : '';
                           
                            $messageData =   "Name - ".$getUserInfo->name.", Email - ".$getUserInfo->email.", Mobile Number - ".$getUserInfoMobile->mobile_number.", Current address - ".$getUserInfo->current_address.", Blood group - ".$getUserInfo->blood_group.", Allergy - ".$getUserInfo->allergy.", Medicine - ".$getUserInfo->medicine.", Network provider - ".$inputs['network_provider'].", Network strength - ".$inputs['network_strength'].", Battery label- ".$inputs['battery_label'].",Problem type - ".$inputs['types_of_problem'].", Person count - ".$inputs['person_count'].",Recording - ".$inputs['recording'].",  Picture - "   .$imagesUrl.",  https://www.google.de/maps?q=".$inputs['latitude'].",".$inputs['longitude']."  Googe Map";
                           

                            $emergencyContactMobileNumber = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->pluck('mobile_number');
                          
                            $userInformations = DB::table('user_informations')->whereIn('mobile_number', $emergencyContactMobileNumber)->get();

                        
                            if($userInformations){

                                $notificationMessage = ucfirst($getUserInfo->name).' is in emergency';

                               foreach ($userInformations as $key => $userInformation) {


                                sendNotification($textData->id, $userInformation->device_token, $userInformation->device_type, $notificationMessage, 'emergency_contact_request');

                                (new Notification())->create(['request_id' => $textData->id,'sender_id' => $getUserInfo->user_id,'receiver_id' => $userInformation->user_id, 'message_type' => 'emergency_contact_request', 'message' => $notificationMessage,'notification_type' => '0']);


                             
                             }

                            }


                            foreach ($emergencyContacts as $key => $contact) {
                            
                                sendMessage($messageData,$contact->mobile_number);
                      
                                 \Mail::send('email_design.text',compact('inputs','getUserInfo','imagesUrl'), function($email) use ($contact, $inputs,$getUserInfo, $imagesUrl)
                                {

                                    $email->to($contact->email)->subject('Pssa Alert - '.'Hi ' . $contact->name);
                                });

                            }    

                            if($departmentData){

                                sendMessage($messageData,$departmentData->mobile_number);
                      
                                \Mail::send('email_design.text',compact('inputs','getUserInfo','imagesUrl'), function($email) use ($departmentData, $inputs)
                                {

                                    $email->to($departmentData->email)->subject('Pssa Alert - '.'Hi ' . $departmentData->name);
                                });
                            }
                            
                           
                            if($officerData){

                                $notificationMessage = ucfirst($getUserInfo->name).' is in emergency';


                               foreach ($officerData as $key => $officer) {


                                sendNotification($textData->id, $officer->device_token, $officer->device_type, $notificationMessage, 'officer_request');


                                (new Notification())->create(['request_id' => $textData->id,'sender_id' => $getUserInfo->user_id,'receiver_id' => $officer->user_id, 'message_type' => 'officer_request','message' => $notificationMessage,'notification_type' => '1']);

                                
                                (new UserRequest())->create(['emergency_alert_id' => $textData->id,  'police_officer_id' => $officer->user_id] );

                                sendMessage($messageData,$officer->mobile_number);
                      
                                \Mail::send('email_design.text',compact('inputs','getUserInfo','imagesUrl'), function($email) use ($officer, $inputs)
                                {
                                    $email->to($officer->email)->subject('Pssa Alert - '.'Hi ' . $officer->name);
                                });
                             }

                            }
                            $result=array(

                                'id'=>$textData->id,
                                'unique_code'=>$textData->unique_code

                            );

                            if ($textData && $emergencyContacts) {
                                DB::commit();
                                 sendPushNotification($textData);
                                 return ['success'=>true,'statusCode'=>200,'message'=>'Emergency alert message sent  successfully','result'=>$result];
                  
                            } else {
                           
                                return ['success'=>false,'statusCode'=>200,'message'=>'Could not emergency alert message sent','emergency_id'=>0];
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
                DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }

        }
           public function reportCrime(Request $request){
             try {
                if ($request->isMethod('post')) {
                    $otp = generateOtpToken();
                    DB::beginTransaction();
                    $inputs = $request->all();
                    $getUserInfoMobile = DB::table('app_users')->where('id', $inputs['user_id'])->first();
                    $getUserInfo = DB::table('user_informations')->where('user_id', $inputs['user_id'])->first();
                    $departmentData = (new Department())->findStateDepartment($inputs);

                    if(!$getUserInfo){
                        
                             return jsonResponse(false, 200, "Invalid user id");

                        } else {

                          
                            $imageFiles = $request->file('image');
                            $audioFiles = $request->file('audio');
                            //$videoFiles = $request->file('vidio');
                            $imageUrl = fileBashUrl(\Config::get('constants.CRIME_IMAGE'));
                            $audioUrl = fileBashUrl(\Config::get('constants.CRIME_AUDIO'));
                           // $videoUrl = fileBashUrl(\Config::get('constants.CRIME_VIDEO'));


                                if (!empty($audioFiles)) {

                                        $input['audio_name'] = time() . rand(0, 9) . uniqid() . '.' . $audioFiles->getClientOriginalExtension();
                                        $destinationPath = public_path(\Config::get('constants.CRIME_AUDIO'));
                                        $audioFiles->move($destinationPath, $input['audio_name']);
                                }    

                            $inputs['user_id'] = isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '';
                            $inputs['unique_code']= 'NPF-CR'.$otp;
                            $inputs['nature_of_crime'] = isset($inputs['nature_of_crime']) && $inputs['nature_of_crime'] != '' ? $inputs['nature_of_crime'] : '';
                            $inputs['state_id'] = isset($inputs['state_id']) && $inputs['state_id'] != '' ? $inputs['state_id'] : '';
                            $inputs['lga'] = isset($inputs['lga']) && $inputs['lga'] != '' ? $inputs['lga'] : '';
                            $inputs['location'] = isset($inputs['location']) && $inputs['location'] != '' ? $inputs['location'] : '';
                            $inputs['latitude'] = isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                            $inputs['longitude'] = isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                            $inputs['neighbour_address'] = isset($inputs['neighbour_address']) && $inputs['neighbour_address'] != '' ? $inputs['neighbour_address'] : '';
                            $inputs['report']= isset($inputs['report']) && $inputs['report'] != '' ? $inputs['report']:'';
                            $inputs['contacted_more_info']= isset($inputs['contacted_more_info']) && $inputs['contacted_more_info'] != ''  ? $inputs['contacted_more_info'] : 1;
                            $inputs['contact_type']= isset($inputs['contact_type']) && $inputs['contact_type'] != ''  ? $inputs['contact_type'] : 1;
                            $inputs['audio'] = isset($input['audio_name']) && $input['audio_name'] != '' ? $audioUrl .'/'. $input['audio_name'] : '';
                            $inputs['department_id'] =  isset($departmentData) && $departmentData->id > 0  ? $departmentData->id : 0;
                      
                          
                            $crimeData = (new Crime())->create($inputs);

                                if (!empty($imageFiles)) {

                                    foreach($imageFiles as $image) {
                                        $input['image_name'] = time() . rand(0, 9) . uniqid() . '.' . $image->getClientOriginalExtension();
                                        $destinationPath = public_path(\Config::get('constants.CRIME_IMAGE'));
                                        $image->move($destinationPath, $input['image_name']);
                                        (new CrimeFile())->create(['report_crime_id' => $crimeData->id, 'file_type' => 'image',  'file' => $imageUrl .'/'. $input['image_name']] );

                                       $fileUrl[] =  $imageUrl .'/'. $input['image_name'];

                                    }

                                    //$stringFile = implode(",", $fileUrl);
                                    $stringFile =  implode(",\n",$fileUrl);

                                }
                                   $imagesUrl =  isset($stringFile) && $stringFile != '' ? $stringFile : '';


                                  $emergencyContacts = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->get();


                                  $messageData =   "Name - ".$getUserInfo->name.", Email - ".$getUserInfo->email.", Mobile Number - ".$getUserInfoMobile->mobile_number.", Current address - ".$getUserInfo->current_address.", Blood group - ".$getUserInfo->blood_group.", Allergy - ".$getUserInfo->allergy.", Medicine - ".$getUserInfo->medicine.", Nature of crime - ".$inputs['nature_of_crime'].", State - ".$inputs['state'].", LGA- ".$inputs['lga'].",Location - ".$inputs['location'].", Neighbour Address - ".$inputs['neighbour_address'].", Recording - "   .$inputs['audio'].",   Picture - "   .$imagesUrl.",   https://www.google.de/maps?q=".$inputs['latitude'].",".$inputs['longitude']."  Googe Map";
                                  


                                 if($departmentData){

                                        sendMessage($messageData,$departmentData->mobile_number);
                              
                                        \Mail::send('email_design.crime_email',compact('inputs','getUserInfo','imagesUrl'), function($email) use ($departmentData, $inputs)
                                        {

                                            $email->to($departmentData->email)->subject('NPFRecueMe - '.'Hi ' . $departmentData->name);
                                        });
                                    }

                               
                            if ($crimeData && $emergencyContacts) {
                                DB::commit();
                                return jsonResponseWithoutResult(true, 200, "Crime report sent successfully");
                  
                             } else {
                           
                                return jsonResponseWithoutResult(false, 200, "Could not Sent crime report successfully");
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }

        }



         public function reportPolice(Request $request){
             try {
                if ($request->isMethod('post')) {
                    $otp = generateOtpToken();
                    DB::beginTransaction();
                    $inputs = $request->all();

                    $getUserInfo = DB::table('user_informations')->where('user_id', $inputs['user_id'])->first();
                    $departmentData = (new Department())->findStateDepartment($inputs);

                    if(!$getUserInfo){
                        
                             return jsonResponse(false, 200, "Invalid user id");

                        } else {

                          
                            $imageFiles = $request->file('image');
                            $audioFiles = $request->file('audio');
                            //$videoFiles = $request->file('vidio');
                            $imageUrl = fileBashUrl(\Config::get('constants.POLICE_IMAGE'));
                            $audioUrl = fileBashUrl(\Config::get('constants.POLICE_AUDIO'));
                           // $videoUrl = fileBashUrl(\Config::get('constants.CRIME_VIDEO'));


                            if (!empty($audioFiles)) {

                                $input['audio_name'] = time() . rand(0, 9) . uniqid() . '.' . $audioFiles->getClientOriginalExtension();
                                $destinationPath = public_path(\Config::get('constants.POLICE_AUDIO'));
                                $audioFiles->move($destinationPath, $input['audio_name']);
                            }    

                            $inputs['user_id'] = isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '';
                            $inputs['unique_code']= 'NPF-PO'.$otp;
                            $inputs['reason'] = isset($inputs['reason']) && $inputs['reason'] != '' ? $inputs['reason'] : '';
                            $inputs['state_id'] = isset($inputs['state_id']) && $inputs['state_id'] != '' ? $inputs['state_id'] : '';
                            $inputs['lga'] = isset($inputs['lga']) && $inputs['lga'] != '' ? $inputs['lga'] : '';
                            $inputs['location'] = isset($inputs['location']) && $inputs['location'] != '' ? $inputs['location'] : '';
                            $inputs['latitude'] = isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                            $inputs['longitude'] = isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                            $inputs['duty_address'] = isset($inputs['duty_address']) && $inputs['duty_address'] != '' ? $inputs['duty_address'] : '';
                            $inputs['report']= isset($inputs['report']) && $inputs['report'] != '' ? $inputs['report']:'';
                            $inputs['contacted_more_info']= isset($inputs['contacted_more_info']) && $inputs['contacted_more_info'] != ''  ? $inputs['contacted_more_info'] : 1;
                            $inputs['contact_type']= isset($inputs['contact_type']) && $inputs['contact_type'] != ''  ? $inputs['contact_type'] : 1;
                            $inputs['audio'] = isset($input['audio_name']) && $input['audio_name'] != '' ? $audioUrl .'/'. $input['audio_name'] : '';
                            $inputs['department_id'] =  isset($departmentData) && $departmentData->id > 0  ? $departmentData->id : 0;

                          
                            $policeData = (new Police())->create($inputs);

                            if (!empty($imageFiles)) {

                                foreach($imageFiles as $image) {
                                    $input['image_name'] = time() . rand(0, 9) . uniqid() . '.' . $image->getClientOriginalExtension();
                                    $destinationPath = public_path(\Config::get('constants.POLICE_IMAGE'));
                                    $image->move($destinationPath, $input['image_name']);
                                    (new PoliceFile())->create(['report_police_id' => $policeData->id, 'file_type' => 'image',  'file' => $imageUrl .'/'. $input['image_name']] );

                                   $fileUrl[] =  $imageUrl .'/'. $input['image_name'];

                                }

                                //$stringFile = implode(",", $fileUrl);
                                $stringFile =  implode(",\n",$fileUrl);

                            }
                            $imagesUrl =  isset($stringFile) && $stringFile != '' ? $stringFile : '';


                            $emergencyContacts = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->get();


                            $messageData =   "Name - ".$getUserInfo->name.", Email - ".$getUserInfo->email.", Mobile Number - ".$getUserInfo->mobile_number.", Current address - ".$getUserInfo->current_address.", Blood group - ".$getUserInfo->blood_group.", Allergy - ".$getUserInfo->allergy.", Medicine - ".$getUserInfo->medicine.", Reason - ".$inputs['reason'].", State - ".$inputs['state'].", LGA- ".$inputs['lga'].",Location - ".$inputs['location'].", Duty address - ".$inputs['duty_address'].", Recording - "   .$inputs['audio'].",   Picture - "   .$imagesUrl.",    https://www.google.de/maps?q=".$inputs['latitude'].",".$inputs['longitude']."  Googe Map";
                          

                              if($departmentData){

                                   sendMessage($messageData,$departmentData->mobile_number);
                      
                                 \Mail::send('email_design.police_email',compact('inputs','getUserInfo','imagesUrl'), function($email) use ($departmentData, $inputs)
                                {

                                    $email->to($departmentData->email)->subject('NPFRecueMe - '.'Hi ' . $departmentData->name);
                                });
                            }

                          
                            if ($policeData && $emergencyContacts) {
                                DB::commit();
                                return jsonResponseWithoutResult(true, 200, "Police report sent successfully");
                  
                             } else {
                           
                                return jsonResponseWithoutResult(false, 200, "Could not sent police report successfully");
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             DB::rollback();
                echo $e->getMessage();
                // something went wrong
            }

        }
           public function requestAmbulance(Request $request){
             try {
                if ($request->isMethod('post')) {
                    $inputs = $request->all();
                    $otp = generateOtpToken();
                    $officerData = (new AppUser())->findStateOfficer($inputs);

                    DB::beginTransaction();
                    $inputs = $request->all();

                    $getUserInfo = DB::table('user_informations')->where('user_id', $inputs['user_id'])->first();

                    if(!$getUserInfo){
                        
                             return jsonResponse(false, 200, "Invalid user id");

                        } else {

                            $inputs['user_id'] = isset($inputs['user_id']) && $inputs['user_id'] != '' ? $inputs['user_id'] : '';
                            $inputs['unique_code']= 'NPF-AM'.$otp;
                            $inputs['nature_of_incedent'] = isset($inputs['nature_of_incedent']) && $inputs['nature_of_incedent'] != '' ? $inputs['nature_of_incedent'] : '';
                            $inputs['state_id'] = isset($inputs['state_id']) && $inputs['state_id'] != '' ? $inputs['state_id'] : '';
                            $inputs['number_of_person'] = isset($inputs['number_of_person']) && $inputs['number_of_person'] != '' ? $inputs['number_of_person'] : '';
                            $inputs['hospital_name'] = isset($inputs['hospital_name']) && $inputs['hospital_name'] != '' ? $inputs['hospital_name'] : '';
                            $inputs['location'] = isset($inputs['location']) && $inputs['location'] != '' ? $inputs['location'] : '';
                            $inputs['latitude'] = isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : '';
                            $inputs['longitude'] = isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : '';
                            $inputs['name'] = isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : '';
                            $inputs['mobile_number']= isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number']:'';
                            $inputs['medication']= isset($inputs['medication']) && $inputs['medication'] != '' ? $inputs['medication']: 1;
                           
                            $policeData = (new Ambulance())->create($inputs);

                            $emergencyContacts = DB::table('emergency_contacts')->where('user_id', $inputs['user_id'])->get();
                            $messageData =   "Name - ".$getUserInfo->name.", Email - ".$getUserInfo->email.", Mobile Number - ".$getUserInfo->mobile_number.", Current address - ".$getUserInfo->current_address.", Blood group - ".$getUserInfo->blood_group.", Allergy - ".$getUserInfo->allergy.", Medicine - ".$getUserInfo->medicine.", Mobile number - ".$inputs['mobile_number'].", Hospital - ".$inputs['hospital_name'].", Number of person- ".$inputs['number_of_person'].",Location - ".$inputs['location'].", Nature of incedent - ".$inputs['nature_of_incedent'].",   https://www.google.de/maps?q=".$inputs['latitude'].",".$inputs['longitude']."  Googe Map";
                         

                                  if($officerData){

                                           sendMessage($messageData,$officerData->mobile_number);
                              
                                         \Mail::send('email_design.ambulance_email',compact('inputs'), function($email) use ($officerData, $inputs)
                                        {

                                            $email->to($officerData->email)->subject('NPFRecueMe - '.'Hi ' . $officerData->name);
                                        });
                                    }

                            

                            if ($policeData && $emergencyContacts) {
                                DB::commit();
                                return jsonResponseWithoutResult(true, 200, "Ambulance request sent successfully");
                  
                            } else {
                           
                                return jsonResponseWithoutResult(false, 200, "Could not Sent Ambulance request successfully");
                            }

                        }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             DB::rollback();
             echo $e->getMessage();
                // something went wrong
            }

        }


        public function state(Request $request){
            try {
                if ($request->isMethod('get')) {
                  
                    $states = DB::table('states')->select('id','country_id','state')->get();
            
                    $statesArr = isset($states) && $states != '' ? $states->toArray() : [];
                    if ($statesArr) {
                          
                        return jsonResponse(true, 200, "Data found successfully",[],$statesArr);
                  
                    } else {
                       
                        return jsonResponseWithoutResult(false, 200, "No 
                            data found");
                    }
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             
                echo $e->getMessage();
                // something went wrong
            }
        }

        public function search(Request $request){

            try {

                if ($request->isMethod('post')) {
                  
                    $inputs = $request->all();
                    $code  = $inputs['search_code'];

                    if (strpos($code, \Config::get('constants.EMERGENCY_ALERT')) !== false) {

                        $emergencyAlert = (new EmergencyAlert())->where('unique_code', $code)
                        ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
                        ->select(
                             DB::Raw('IFNULL( `emergency_alerts`.`comment`, "") as comment'),
                            'emergency_alerts.department_id','emergency_alerts.police_officer_id','emergency_alerts.id','user_informations.name', 'user_informations.surname', 'user_informations.email',   'user_informations.state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info', 'emergency_alerts.latitude','emergency_alerts.longitude','user_informations.profile_pic','emergency_alerts.status','emergency_alerts.unique_code','emergency_alerts.network_provider','emergency_alerts.network_strength','emergency_alerts.recording','emergency_alerts.latitude','emergency_alerts.longitude','emergency_alerts.battery_label','emergency_alerts.types_of_problem','emergency_alerts.person_count'
                        )
                        ->first();

                        if ($emergencyAlert) {

                            $emergencyAlertArr = isset($emergencyAlert) && $emergencyAlert != '' ? $emergencyAlert->toArray() : [];

                            $getEmergencyAlertFiles = DB::table('emergency_alert_files')->where('em_alert_id', $emergencyAlertArr['id'])->get()->toArray();

                            if ($getEmergencyAlertFiles) {

                                $emergencyAlertArr['files'] = $getEmergencyAlertFiles;

                            } else{

                                $emergencyAlertArr['files'] = [];
                            }
                        }
                
                        if ($emergencyAlert) {

                            return jsonResponse(true, 200, "Data found successfully", [], $emergencyAlertArr);
                        } else {
                            
                            return jsonResponse(false, 200, "No data found");
                        }

                    } else if (strpos($code, \Config::get('constants.POLICE_REPORT')) !== false) {
                        
                        $policeAlert = (new Police())->where('unique_code', $code)
                         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_policies.user_id')
                         ->select('user_informations.name', 'report_policies.id','user_informations.surname', 'user_informations.email','user_informations.profile_pic','report_policies.unique_code','report_policies.reason','report_policies.lga','report_policies.location','report_policies.latitude','report_policies.longitude','report_policies.duty_address','report_policies.report','report_policies.contacted_more_info','report_policies.contact_type','report_policies.audio')
                        ->first();

                        if ($policeAlert) {

                            $policeAlertArr = isset($policeAlert) && $policeAlert != '' ? $policeAlert->toArray() : [];

                            $getPoliceAlertFiles = DB::table('report_police_files')->where('report_police_id', $policeAlertArr['id'])->get()->toArray();

                            if ($getPoliceAlertFiles) {

                                $policeAlertArr['files'] = $getPoliceAlertFiles;

                            } else {

                                $policeAlertArr['files'] = [];
                            }
                        }
                
                        if ($policeAlert) {

                            return jsonResponse(true, 200, "Data found successfully", [], $policeAlertArr);
                        } else {
                            
                            return jsonResponse(false, 200, "No data found"); 
                        }

                    } else if (strpos($code, \Config::get('constants.CRIME_REPORT')) !== false) {

                        $crimeAlert = (new Crime())->where('unique_code', $code)
                        ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_crimes.user_id')
                         ->select('report_crimes.id','user_informations.name', 'user_informations.surname', 'user_informations.email','user_informations.profile_pic','report_crimes.unique_code','report_crimes.nature_of_crime','report_crimes.lga','report_crimes.location','report_crimes.latitude','report_crimes.longitude','report_crimes.neighbour_address','report_crimes.report','report_crimes.contacted_more_info','report_crimes.contact_type','report_crimes.audio')
                        ->first();

                        if ($crimeAlert) {

                            $crimeAlertArr = isset($crimeAlert) && $crimeAlert != '' ? $crimeAlert->toArray() : [];

                            $getCrimeAlertFiles = DB::table('report_crime_files')->where('report_crime_id', $crimeAlertArr['id'])->get()->toArray();

                            if ($getCrimeAlertFiles) {

                                $crimeAlertArr['files'] = $getCrimeAlertFiles;
                            } else {

                                $crimeAlertArr['files'] = [];
                            }
                        }
                
                        if ($crimeAlert) {

                            return jsonResponse(true, 200, "Data found successfully", [], $crimeAlertArr);
                        } else {
                            
                            return jsonResponse(false, 200, "No data found");
                        }

                     } else if (strpos($code, \Config::get('constants.AMBULANCE_REQUEST')) !== false) {
                                           
                        $ambulanceAlert = (new Ambulance())->where('unique_code', $code)
                        ->leftjoin('user_informations', 'user_informations.user_id', '=', 'request_ambulances.user_id')
                        ->select('request_ambulances.id','user_informations.name', 'user_informations.surname', 'user_informations.email','user_informations.profile_pic','request_ambulances.unique_code','request_ambulances.nature_of_incedent','request_ambulances.number_of_person','request_ambulances.hospital_name','request_ambulances.latitude','request_ambulances.longitude','request_ambulances.location','request_ambulances.name','request_ambulances.mobile_number as am_mobile_number','request_ambulances.medication')
                        ->first();
                        if ($ambulanceAlert) {

                            $ambulanceAlertArr = isset($ambulanceAlert) && $ambulanceAlert != '' ? $ambulanceAlert->toArray() : [];
                        }
                
                        if ($ambulanceAlert) {
                            $ambulanceAlertArr['files'] = [];

                            return jsonResponse(true, 200, "Data found successfully", [], $ambulanceAlertArr);
                        } else {
                            
                            return jsonResponse(false, 200, "No data found");
                        }

                    } else {

                        return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                    }
                  
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             
                echo $e->getMessage();
                // something went wrong
            }
        }


        
 
     public function detailEmergencyContact(Request $request){
            try {
                if ($request->isMethod('post')) {
                  $inputs = $request->all();
                  
                    $emergencyContacts = (new EmergencyContact())->where('id',$inputs['id'])->first();

                    $emergencyContactsArr = isset($emergencyContacts) && $emergencyContacts != '' ? $emergencyContacts->toArray() : [];
                    if ($emergencyContacts) {
                          
                        return jsonResponse(true, 200, "Data found successfully",[],$emergencyContactsArr);
                  
                    } else {
                       
                        return jsonResponseWithoutResult(false, 200, "No 
                            data found");
                    }
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             
                echo $e->getMessage();
                // something went wrong
            }
        }



        public function updateEmergencyContact(Request $request){
            try {
                if ($request->isMethod('post')) {
                    $inputs = $request->all();


                    $emergencyContacts = (new EmergencyContact())->where('id',$inputs['id'])->first();

                     $image = $request->file('contact_pic');

                        if (!empty($image)) {
                            $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path(\Config::get('constants.USER.IMAGE_FOLDER'));
                            $image->move($destinationPath, $input['file_name']);
                        }
                        $userImagePath = \Config::get('constants.USER.IMAGE_FOLDER');
                        $imageUrl = fileBashUrl($userImagePath);
                        $arrAppUser = array(
                        'name' => isset($inputs['name']) && $inputs['name'] != '' ? $inputs['name'] : $emergencyContacts['name'],
                        'contact_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : $emergencyContacts['contact_pic'],
                        'mobile_number' => isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : $emergencyContacts['mobile_number'],
                        'relation' => isset($inputs['relation']) && $inputs['relation'] != '' ? $inputs['relation'] : $emergencyContacts['relation'],
                        'email' =>  isset($inputs['email']) && $inputs['email'] != '' ? $inputs['email'] : $emergencyContacts['email'],
                        'address' =>  isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : $emergencyContacts['address'],
                     
                    );  
                    $updateAppUser = (new EmergencyContact())->where('id', $inputs['id'])->update($arrAppUser);

                    if ($updateAppUser) {
                          
                        return jsonResponseWithoutResult(true, 200, "Emergency contact updated successfully");
                  
                    } else {
                       
                        return jsonResponseWithoutResult(false, 200, "Could not updated emergency contact");
                    }
                }
                return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
            } catch (\Exception $e) {
             
                echo $e->getMessage();
                // something went wrong
            }
        }




          public function contactUs(Request $request)
    {
        try {
            
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();

                $insertContact = (new Contact())->create($inputs);
                if ($insertContact) {
                    DB::commit();
                  
                        return jsonResponseWithoutResult(true, 200, "Contact detail Sent successfully");
                    
                } else {
                    
                        return jsonResponseWithoutResult(false, 200, "Contact detail could not be sent successfully?");
                    
                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    } 



   public function nearbyUserList(Request $request)
    {
        try {
            
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();

                $getNearByUserList = (new UserInfo())->getNearByUser($inputs);
               
                if ($getNearByUserList) {
                    DB::commit();
                  
                        return jsonResponse(true, 200, "Data found successfully",[],$getNearByUserList);
                    
                } else {
                    
                        return jsonResponseWithoutResult(false, 200, "No data faund");
                    
                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    } 

    public function emergencyNumbers(Request $request)
    {
        $result=array(
            'helpline_numbers'=>"112,09088067146,09088067145",
          );
          return ['success'=>true,'status_code'=>200,"message"=>"Get count notifications successfully",'result'=>$result];

    }

    public function UpdateUserLocation(Request $request)
    {
        $inputs = $request->all();
        $data = ['latitude'=>$inputs['latitude'],'longitude'=>$inputs['longitude']];

        $update = (new EmergencyAlert())->where('unique_code',$inputs['alert_id'])->update($data);
        return ['success'=>true,'status_code'=>200,"message"=>"Location Updated Successfully"];

    }



   

}

