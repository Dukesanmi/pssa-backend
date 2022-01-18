<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FireDepartment extends Authenticatable
{
    use Notifiable;
    protected $guard = 'fire';
    protected $primaryKey = 'id';
    protected $table = 'fire_departments';

    protected $fillable = [
        'name', 'surname','profile_pic','mobile_number', 'email','password',  'state','city','address'

    ];
    public function  getDepartmentList($searchKey) {

        return  $this
            ->select(
                'id','name','profile_pic','mobile_number','email','password','state','city','address','status','created_at','updated_at')
            ->where(function($query) use ($searchKey)  {
                if($searchKey) {
                    $query->where('name', 'like', '%' . $searchKey . '%');
                }
            });

    }

    public function findStateDepartment($inputs){

        return  $this
            ->select(
                'id', 'name','profile_pic','mobile_number', 'email','password',  'state','city','address')
            ->where('state',  $inputs['state'])
            ->first();
    }
}
