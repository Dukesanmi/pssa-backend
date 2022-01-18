<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use DB;
class UserInfo extends Model
{

use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';
    protected $table = 'user_informations';

    protected $fillable = [
        'name', 'surname','user_id', 'mobile_number','email','contacts_id','dob', 'address', 'state_id','office_address','current_address', 'gender','blood_group','nhis_number','allergy', 'medicine', 'vital_info', 'latitude','longitude','notification_status','device_type','device_token','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  

 

    public function checkExistUserMobileNumber($inputs){

        return $this->select('id','mobile_number','registered')->where('mobile_number', '=', $inputs['mobile_number'])->first();
    }

   

     public function getVerifyUserInfo($inputs){

        return  $this
         ->leftjoin('emergency_contacts', 'emergency_contacts.user_id', '=', 'app_users.id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','app_users.name', 'app_users.surname', 'app_users.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','app_users.dob', 'app_users.address', 'app_users.state','app_users.office_address','app_users.current_address',  'app_users.gender','app_users.blood_group','app_users.nhis_number','app_users.allergy', 'app_users.medicine', 'app_users.vital_info', 'app_users.latitude','app_users.longitude','app_users.notification_status','app_users.mobile_number_verify_status','app_users.profile_pic','app_users.device_type','app_users.device_token','app_users.status','app_users.password','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
            ->where('app_users.otp',  trim($inputs['otp']))
            ->first();
    }

      public function getLoginUserInfo($inputs){

        return  $this
         ->leftjoin('emergency_contacts', 'emergency_contacts.user_id', '=', 'app_users.id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','app_users.name','app_users.profile_pic', 'app_users.surname', 'app_users.email','app_users.country_code', 'app_users.mobile_number','app_users.dob', 'app_users.address', 'app_users.state','app_users.office_address','app_users.current_address',  'app_users.gender','app_users.blood_group','app_users.nhis_number','app_users.allergy', 'app_users.medicine', 'app_users.vital_info', 'app_users.latitude','app_users.longitude','app_users.notification_status','app_users.mobile_number_verify_status','app_users.device_type','app_users.device_token','app_users.status','app_users.created_at','app_users.updated_at')
            ->where('app_users.id',  $inputs['user_id'])
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



        public function getNearByUser($inputs){
        $circle_radius = 3959;
        $distance = 50;
        $latitude = $inputs['latitude'];
        $longitude = $inputs['longitude'];
        $user_id = $inputs['user_id'];
       
        return $candidates = \DB::select(
            'SELECT * FROM
                    (SELECT name, profile_pic, mobile_number, user_id, latitude,longitude, (' . $circle_radius . ' * acos(cos(radians(' . $latitude . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $longitude . ')) +
                    sin(radians(' . $latitude . ')) * sin(radians(latitude))))
                    AS distance
                    FROM user_informations) AS distances
                WHERE distance < ' . $distance . '
               AND user_id != ' . $user_id . '
                ORDER BY distance
                LIMIT 5;
            ');
    }


}
