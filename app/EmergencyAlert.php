<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyAlert extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'emergency_alerts';

    protected $fillable = [
        'user_id','department_id','comment','police_officer_id', 'recording','unique_code','network_provider','network_strength', 'latitude','longitude',  'battery_label','types_of_problem','status','person_count','created_at','updated_at','em_address'
    ];



    public function getEmergencyAlertUsers(){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'emergency_alerts.department_id','emergency_alerts.police_officer_id','app_users.id','emergency_alerts.id as ea_id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.home_state as state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info', 'emergency_alerts.latitude','emergency_alerts.longitude','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','emergency_alerts.status','user_informations.created_at','user_informations.hospital_name','user_informations.updated_at','emergency_alerts.unique_code','emergency_alerts.network_provider','emergency_alerts.network_strength','emergency_alerts.recording','emergency_alerts.latitude','emergency_alerts.longitude','emergency_alerts.battery_label','emergency_alerts.types_of_problem','emergency_alerts.person_count'
            )
            ->where('app_users.type',  0)
           ->orderBy('emergency_alerts.id','DESC');
            
    }




     public function getEmergencyAlertUser($id){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
          ->leftjoin('police_officers', 'police_officers.id', '=', 'emergency_alerts.police_officer_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'emergency_alerts.department_id','emergency_alerts.comment','emergency_alerts.police_officer_id','app_users.id','emergency_alerts.id as ea_id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.home_state as state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.hospital_name','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info', 'emergency_alerts.latitude','emergency_alerts.longitude','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','emergency_alerts.status','user_informations.created_at','user_informations.updated_at','emergency_alerts.unique_code','emergency_alerts.network_provider','emergency_alerts.network_strength','emergency_alerts.recording','emergency_alerts.latitude','emergency_alerts.longitude','emergency_alerts.battery_label','emergency_alerts.types_of_problem','emergency_alerts.person_count','police_officers.name as officer_name','police_officers.email as officer_email','police_officers.address as officer_address','police_officers.police_id','police_officers.rank','police_officers.dept','police_officers.station'
            )
            ->where('emergency_alerts.id',  $id);
            
    }

    public function getEmergencyAlertUserApi($id){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
          ->leftjoin('police_officers', 'police_officers.id', '=', 'emergency_alerts.police_officer_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id as user_id','emergency_alerts.id as ea_id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.home_state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.hospital_name','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info', 'emergency_alerts.latitude','emergency_alerts.longitude','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','emergency_alerts.unique_code','emergency_alerts.network_provider','emergency_alerts.network_strength','emergency_alerts.recording','emergency_alerts.latitude','emergency_alerts.longitude','emergency_alerts.created_at','emergency_alerts.battery_label','emergency_alerts.types_of_problem','emergency_alerts.person_count'
            )
            ->where('emergency_alerts.id',  $id);
            
    }

    public function getInprogessData($inputs){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
            ->select(
                'emergency_alerts.id','user_informations.name', 'user_informations.surname', 'app_users.country_code',  'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address', 'user_informations.profile_pic','emergency_alerts.types_of_problem','emergency_alerts.person_count','emergency_alerts.unique_code'
            )
            ->where('emergency_alerts.status',  2)
            ->orderBy('emergency_alerts.created_at','DESC')
            ->where('emergency_alerts.police_officer_id',  $inputs['police_officer_id']);
            
    }


    public function getIncompleteData($inputs){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
            ->select(
                'emergency_alerts.comment','emergency_alerts.id','user_informations.name', 'user_informations.surname', 'app_users.country_code',  'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address', 'user_informations.profile_pic','emergency_alerts.types_of_problem','emergency_alerts.person_count','emergency_alerts.unique_code'
            )
            ->where('emergency_alerts.status',  3)
            ->orderBy('emergency_alerts.created_at','DESC')
            ->where('emergency_alerts.police_officer_id',  $inputs['police_officer_id']);
            
    }


     public function getCompleteData($inputs){

        return  $this
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
            ->select(
                'emergency_alerts.comment','emergency_alerts.id','user_informations.name', 'user_informations.surname', 'app_users.country_code',  'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address', 'user_informations.profile_pic','emergency_alerts.types_of_problem','emergency_alerts.person_count','emergency_alerts.unique_code'
            )
            ->where('emergency_alerts.status',  4)
            ->orderBy('emergency_alerts.created_at','DESC')
            ->where('emergency_alerts.police_officer_id',  $inputs['police_officer_id']);
            
    }

    public function AlertsMap()
    {
      return $this->hasOne('App\UserInfo', 'user_id', 'user_id');
    }
}
