<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'requests';

    protected $fillable = [
        'emergency_alert_id','police_officer_id', 'status'
    ];




    public function getEmergencyAlertUsersForOfficer($inputs){

        return  $this
         ->leftjoin('emergency_alerts', 'emergency_alerts.id', '=', 'requests.emergency_alert_id')
         ->leftjoin('app_users', 'emergency_alerts.user_id', '=', 'app_users.id')
         ->leftjoin('user_informations', 'user_informations.user_id', '=', 'emergency_alerts.user_id')
            ->select(
                // DB::Raw('IFNULL( `emergency_contacts`.`name`, "") as ec_name'),
                // DB::Raw('IFNULL( `emergency_contacts`.`mobile_number`, "") as ec_mobile_number'),
                // DB::Raw('IFNULL( `emergency_contacts`.`relation`, "") as ec_relation'),
                // DB::Raw('IFNULL( `emergency_contacts`.`email`, "") as ec_email'),
                // DB::Raw('IFNULL( `emergency_contacts`.`address`, "") as ec_address'),
                'emergency_alerts.id','user_informations.name', 'user_informations.surname', 'app_users.country_code',  'user_informations.address', 'user_informations.state','user_informations.office_address','user_informations.current_address', 'user_informations.profile_pic','emergency_alerts.types_of_problem','emergency_alerts.person_count','emergency_alerts.unique_code'
            )
            ->where('app_users.type',  0)
            ->where('requests.police_officer_id',  $inputs['police_officer_id'])
->distinct('emergency_alerts.id')
		//->groupBy('emergency_alerts.id')
            ->orderBy('emergency_alerts.id', 'DESC');
    }

}
