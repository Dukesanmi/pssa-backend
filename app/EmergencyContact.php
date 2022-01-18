<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
     protected $primaryKey = 'id';
    protected $table = 'emergency_contacts';

    protected $fillable = [
        'user_id', 'name', 'mobile_number','relation',  'email','email', 'address','status','contact_pic'
    ];



       public function getUserEcInfo($inputs){

        return  $this
         
            ->select(
               'id', 'name', 'mobile_number','relation',  'email','email', 'address','contact_pic')
            ->where('user_id',  $inputs['user_id'])
            ->where('id',  $inputs['ec_id'])
            ->first();
    }

}
