<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'request_ambulances';

    protected $fillable = [
        'user_id', 'unique_code','nature_of_incedent','number_of_person', 'hospital_name','location', 'state', 'latitude','longitude','name','mobile_number','medication'
    ];


      public function getAmbulanceList(){

        return  $this
         ->leftjoin('app_users', 'request_ambulances.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'request_ambulances.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'user_informations.state','request_ambulances.id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered','app_users.mobile_number','user_informations.dob','user_informations.address', 'user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.created_at','app_users.updated_at','request_ambulances.unique_code','request_ambulances.nature_of_incedent','request_ambulances.number_of_person','request_ambulances.hospital_name','request_ambulances.latitude','request_ambulances.longitude','request_ambulances.location','request_ambulances.name','request_ambulances.mobile_number as am_mobile_number','request_ambulances.medication'
            )
            ->orderBy('request_ambulances.id','DESC');
            
    }



     public function getAmbulanceDetail($user_id){

        return  $this
       ->leftjoin('app_users', 'request_ambulances.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'request_ambulances.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'user_informations.state','app_users.id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.created_at','app_users.updated_at','request_ambulances.unique_code','request_ambulances.nature_of_incedent','request_ambulances.number_of_person','request_ambulances.hospital_name','request_ambulances.latitude','request_ambulances.longitude','user_informations.hospital_name','user_informations.office_address','request_ambulances.location','request_ambulances.name','request_ambulances.mobile_number as am_mobile_number','request_ambulances.medication'
            )
             ->where('request_ambulances.id',  $user_id);
            
    }
}
