<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class PoliceOfficer extends Model
{
     use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';
    protected $table = 'police_officers';

    protected $fillable = [
        'name', 'department_id','surname','mobile_number', 'email', 'dob', 'gender', 'user_id','address', 'state_id','profile_pic','police_id','rank', 'dept', 'station','status','password','device_type','device_token','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 




     public function getNearByPoliceOfficer($inputs){
        $circle_radius = 3959;
        $distance = 50;
        $latitude = $inputs['latitude'];
        $longitude = $inputs['longitude'];


        return $candidates = \DB::select(
            'SELECT * FROM
                    (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $latitude . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $longitude . ')) +
                    sin(radians(' . $latitude . ')) * sin(radians(latitude))))
                    AS distance
                    FROM police_officers) AS distances
                WHERE distance < ' . $distance . '
                ORDER BY distance
                LIMIT 5;
            ');
    }



  



}
