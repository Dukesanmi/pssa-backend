<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

use DB;
use App\EmergencyContact;
use App\UserInfo;
class AppUser extends Authenticatable
{

use  Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';
    protected $table = 'app_users';

    protected $fillable = [
        'country_code','device_type','device_token','profile_pic','name', 'surname', 'mobile_number','dob', 'notification_status','mobile_number_verify_status','otp','status','type','registered'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 

    public function getUser($id){
        return $this
                ->join('user_informations','app_users.id','user_informations.user_id')
                ->where('app_users.id',$id)
                ->select('app_users.country_code','app_users.id','user_informations.name','user_informations.email','user_informations.mobile_number','user_informations.dob','user_informations.home_state as state','user_informations.address');
    }

    public function checkExistUserMobileNumber($inputs){

        return
         $this
        ->where('email',  $inputs['email'])->first();
    }

   

     public function getVerifyUserInfo($inputs){

        return  $this
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'app_users.id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','user_informations.name','user_informations.surname','user_informations.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.mobile_number', 'user_informations.office_state','user_informations.home_state', 'user_informations.latitude','user_informations.longitude','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.status','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('app_users.otp',  trim($inputs['otp']))
            ->where('app_users.type',  0)
            ->first();
    }



    public function getVerifyOfficerInfo($inputs){

        return  $this
         ->leftjoin('police_officers', 'police_officers.user_id', '=', 'app_users.id')
            ->select(
                'app_users.id','police_officers.name','police_officers.surname','police_officers.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','police_officers.address','police_officers.state','police_officers.police_id','police_officers.rank','police_officers.state', 'police_officers.dept','police_officers.station','police_officers.dob','police_officers.gender','app_users.notification_status','app_users.mobile_number_verify_status','police_officers.profile_pic','app_users.status','police_officers.device_type','police_officers.device_token','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('app_users.otp',  trim($inputs['otp']))
            ->where('app_users.type',  1)
            ->first();
    }



      public function getLoginUserInfo($inputs){

      return  $this
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'app_users.id')
            ->select(
                'user_informations.home_state','app_users.id','user_informations.name','user_informations.surname','user_informations.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address','user_informations.office_address','user_informations.gender','user_informations.office_state','user_informations.latitude','user_informations.longitude','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.status','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('app_users.type',  0)
            ->first();
    }





public function getLoginUserInfoList($searchKey){

      return  $this
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'app_users.id')
            ->select(
                'app_users.id','user_informations.name','user_informations.surname','user_informations.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine','user_informations.vital_info', 'user_informations.latitude','user_informations.longitude','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.status','app_users.created_at','app_users.updated_at')
            ->where('app_users.type',  0)
             ->where(function($query) use ($searchKey)  {
                if($searchKey) {
                    $query->where('user_informations.name', 'like', '%' . $searchKey . '%');
                }
            })->orderBy('id','DESC');
    }


    public function getLoginOfficerInfoList($searchKey){

      return  $this
         ->leftjoin('police_officers', 'police_officers.user_id', '=', 'app_users.id')
          ->select(
                'app_users.id','police_officers.name','police_officers.surname','police_officers.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','police_officers.address','police_officers.police_id','police_officers.rank',  'police_officers.dept','police_officers.station','police_officers.dob','police_officers.gender','app_users.notification_status','app_users.mobile_number_verify_status','police_officers.profile_pic','police_officers.status','police_officers.device_type','police_officers.device_token','app_users.created_at','app_users.updated_at')
            ->where('app_users.type',  1)
              ->where(function($query) use ($searchKey)  {
                if($searchKey) {
                    $query->where('police_officers.name', 'like', '%' . $searchKey . '%');
                }
            });
    }


     public function getOfficerList(){

      return  $this
         ->leftjoin('police_officers', 'police_officers.user_id', '=', 'app_users.id')
          ->select(
                'app_users.id','police_officers.name','police_officers.surname','police_officers.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','police_officers.address','police_officers.police_id','police_officers.rank',  'police_officers.dept','police_officers.station','police_officers.dob','police_officers.gender','app_users.notification_status','app_users.mobile_number_verify_status','police_officers.profile_pic','app_users.status','police_officers.device_type','police_officers.device_token','app_users.created_at','app_users.updated_at')
            ->where('app_users.type',  1);
          
    }

 public function getLoginOfficerInfo($inputs){

      return  $this
         ->leftjoin('police_officers', 'police_officers.user_id', '=', 'app_users.id')
          ->select(
                'police_officers.state', 'app_users.id','police_officers.name','police_officers.surname','police_officers.email','app_users.country_code','app_users.registered' ,'app_users.mobile_number','police_officers.address','police_officers.police_id','police_officers.rank',  'police_officers.dept','police_officers.station','police_officers.dob','police_officers.gender','app_users.notification_status','app_users.mobile_number_verify_status','police_officers.profile_pic','app_users.status','police_officers.device_type','police_officers.device_token','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('app_users.type',  1)
            ->first();
    }

      public function getLoginUserInfoWithEcInfo($inputs){

        return  $this
         ->leftjoin('emergency_contacts', 'emergency_contacts.user_id', '=', 'app_users.id')
            ->select(
                DB::Raw('IFNULL( `emergency_contacts`.`id`, "") as ec_id'),
                DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','app_users.name', 'app_users.surname', 'app_users.email','app_users.country_code', 'app_users.mobile_number','app_users.dob', 'app_users.address', 'app_users.state','app_users.office_address','app_users.current_address',  'app_users.gender','app_users.blood_group','app_users.nhis_number','app_users.allergy', 'app_users.medicine', 'app_users.vital_info', 'app_users.latitude','app_users.longitude','app_users.notification_status','app_users.mobile_number_verify_status','app_users.device_type','app_users.device_token','app_users.status','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('emergency_contacts.id',  $inputs['ec_id'])
            ->first();
    }



     public function findStateOfficer($inputs){

        return  $this
         ->leftjoin('police_officers', 'police_officers.user_id', '=', 'app_users.id')

            ->select(
                'app_users.id','police_officers.email','app_users.country_code','app_users.mobile_number')
            ->where('app_users.type',  1)
            ->where('police_officers.state',  $inputs['state'])
            ->first();
    }

    

}
