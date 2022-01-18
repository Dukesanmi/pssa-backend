<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'report_crimes';

    protected $fillable = [
        'user_id','department_id', 'unique_code','nature_of_crime','state', 'lga','location',  'latitude','longitude','neighbour_address','report','neighbour_address','report','contacted_more_info','contact_type',
        'audio'
    ];




    public function getCrimeList(){

        return  $this
         ->leftjoin('app_users', 'report_crimes.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_crimes.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','report_crimes.id as rc_id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','app_users.created_at','app_users.updated_at','report_crimes.unique_code','report_crimes.nature_of_crime','report_crimes.lga','report_crimes.location','report_crimes.latitude','report_crimes.longitude','report_crimes.neighbour_address','report_crimes.report','report_crimes.contacted_more_info','report_crimes.contact_type','report_crimes.audio'
            )->orderBy('report_crimes.id','DESC');
            
    }



     public function getCrimeDetail($id){

       return  $this
         ->leftjoin('app_users', 'report_crimes.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'report_crimes.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'app_users.id','report_crimes.id as rc_id','report_crimes.department_id','user_informations.name', 'user_informations.surname', 'user_informations.email','app_users.country_code', 'app_users.registered' ,'app_users.mobile_number','user_informations.dob', 'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address',  'user_informations.gender','user_informations.blood_group','user_informations.nhis_number','user_informations.allergy', 'user_informations.medicine', 'user_informations.vital_info','app_users.notification_status','app_users.mobile_number_verify_status','user_informations.profile_pic','user_informations.device_type','user_informations.device_token','user_informations.hospital_name','user_informations.office_address','app_users.created_at','app_users.updated_at','report_crimes.unique_code','report_crimes.nature_of_crime','report_crimes.lga','report_crimes.location','report_crimes.latitude','report_crimes.longitude','report_crimes.neighbour_address','report_crimes.report','report_crimes.contacted_more_info','report_crimes.contact_type','report_crimes.audio'
            )
             ->where('report_crimes.id',  $id);
            
    }
}
