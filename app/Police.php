<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Police extends Model
{
   protected $primaryKey = 'id';
    protected $table = 'report_policies';

    protected $fillable = [
        'user_id','department_id', 'unique_code','reason','state', 'lga','location',  'latitude','longitude','duty_address','report','audio','contacted_more_info','contact_type',
    ];



    public function getPoliceList(){

        return  $this
         ->leftjoin('app_users', 'report_policies.user_id', '=', 'app_users.id')
            ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_policies.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','user_informations.name', 'report_policies.id as rp_id','user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.status','app_users.created_at','app_users.updated_at','report_policies.unique_code','report_policies.reason','report_policies.lga','report_policies.location','report_policies.latitude','report_policies.longitude','report_policies.duty_address','report_policies.report','report_policies.contacted_more_info','report_policies.contact_type','report_policies.audio'
            )->orderBy('report_policies.id','DESC');
            
    }



     public function getPoliceDetail($id){

        return  $this
         ->leftjoin('app_users', 'report_policies.user_id', '=', 'app_users.id')
            ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_policies.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','user_informations.name', 'report_policies.id as rp_id','report_policies.department_id','user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.hospital_name','user_informations.office_address','user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.status','app_users.created_at','app_users.updated_at','report_policies.unique_code','report_policies.reason','report_policies.lga','report_policies.location','report_policies.latitude','report_policies.longitude','report_policies.duty_address','report_policies.report','report_policies.contacted_more_info','report_policies.contact_type','report_policies.audio'
            )
             ->where('report_policies.id',  $id);
            
    }
}
