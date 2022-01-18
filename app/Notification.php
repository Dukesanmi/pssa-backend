<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Notification extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notifications';

    protected $fillable = [
        'request_id', 'sender_id', 'receiver_id','message_type','notification_type', 'message', 'status'
    ];


    public function getNotification($inputs){

        return  $this
            ->leftJoin('app_users', 'notifications.sender_id', '=', 'app_users.id')
            ->select(
                'app_users.name','notifications.id as notification_id','notifications.receiver_id','notifications.request_id as emergency_alert_id','notifications.sender_id','notifications.status','app_users.profile_pic','notifications.message_type', 'notifications.message','notifications.status','notifications.created_at'
            )
            ->where('notifications.receiver_id', $inputs['user_id'])
             ->where(function($query) use ($inputs)  {

                if(isset($inputs['notification_type']) && $inputs['notification_type'] == 'officer') {
                    $query->where('notifications.notification_type', $inputs['notification_type']);
                }
                else{

                    $query->where('notifications.notification_type', $inputs['notification_type']);
                }
            })
            ->orderBy('notifications.id','DESC');
    }



    




    

}
