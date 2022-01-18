<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChatMessage extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'chat_messages';

    protected $fillable = [
        'user_id', 'chat_group_id', 'request_id','user_type', 'message', 'type', 'image', 'thumb_image', 'status','created_at','updated_at'
    ];

    public function getAllChatMessagesList($inputs){
       /* return  $this
            ->leftJoin('app_users', 'app_users.id', '=', 'chat_messages.user_id')
            ->join('requests', function($join) {
                $join->on('requests.id', '=', 'chat_messages.request_id');
                $join->on(function($query) {
                    $query->on('requests.user_id', '=', 'chat_messages.user_id');
                    $query->orOn('requests.earner_id', '=', 'chat_messages.user_id');
                });
            })
            ->select(
                'chat_messages.user_id','chat_messages.request_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.updated_at', 'chat_messages.created_at','chat_messages.id',
                'app_users.profile_pic as user_profile_pic','chat_messages.status'
            )
            ->where(function($andOr) use ($inputs){
                $andOr->where('chat_messages.user_id', '=', $inputs['user_id'] )->orWhere('chat_messages.user_id', '=', $inputs['user_2_id']);
            })
            ->orderBy('chat_messages.created_at', 'asc');*/
        return  $this
            ->leftJoin('app_users', 'app_users.id', '=', 'chat_messages.user_id')
                ->select(
                    'chat_messages.user_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                    'chat_messages.updated_at', 'chat_messages.created_at','chat_messages.id',
                    'app_users.profile_pic as user_profile_pic','chat_messages.status'
                )
                ->where('chat_messages.chat_group_id', $inputs['chat_group_id'] )
                ->orderBy('chat_messages.created_at', 'asc');
    }


    public function getAllChatMessagesOfficerList($inputs){
       /* return  $this
            ->leftJoin('app_users', 'app_users.id', '=', 'chat_messages.user_id')
            ->join('requests', function($join) {
                $join->on('requests.id', '=', 'chat_messages.request_id');
                $join->on(function($query) {
                    $query->on('requests.user_id', '=', 'chat_messages.user_id');
                    $query->orOn('requests.earner_id', '=', 'chat_messages.user_id');
                });
            })
            ->select(
                'chat_messages.user_id','chat_messages.request_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.updated_at', 'chat_messages.created_at','chat_messages.id',
                'app_users.profile_pic as user_profile_pic','chat_messages.status'
            )
            ->where(function($andOr) use ($inputs){
                $andOr->where('chat_messages.user_id', '=', $inputs['user_id'] )->orWhere('chat_messages.user_id', '=', $inputs['user_2_id']);
            })
            ->orderBy('chat_messages.created_at', 'asc');*/
        return  $this
            ->leftJoin('police_officers', 'police_officers.user_id', '=', 'chat_messages.user_id')
                ->select(
                    'chat_messages.user_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                    'chat_messages.updated_at', 'chat_messages.created_at','chat_messages.id',
                    'police_officers.profile_pic as user_profile_pic','chat_messages.status'
                )
                ->where('chat_messages.chat_group_id', $inputs['chat_group_id'] )
                ->orderBy('chat_messages.created_at', 'asc');
    }

    public function getUpdateListChatMessagesStatus($inputs) {
          /* return  $this
               ->join('requests', function($join) {
                   $join->on('requests.id', '=', 'chat_messages.request_id');
                   $join->on(function($query) {
                       $query->on('requests.user_id', '=', 'chat_messages.user_id');
                       $query->orOn('requests.earner_id', '=', 'chat_messages.user_id');
                   });
               })
               ->select('chat_messages.id')
               ->where('chat_messages.user_id', '!=', $inputs['user_id'] )
               ->where('chat_messages.user_id', '=', $inputs['user_2_id'] )
               ->where('chat_messages.status', '=', '0');*/
        return  $this
            //->leftJoin('requests', 'requests.chat_group_id', '=', 'chat_messages.chat_group_id')
            ->select('chat_messages.id')
            ->where('chat_messages.user_id', '=', $inputs['user_2_id'] )
            ->where('chat_messages.status', '=', '0');
    }

    public function getCheckNewChatMessage($inputs){
        return  $this
            ->leftJoin('app_users', 'app_users.id', '=', 'chat_messages.user_id')
            ->select(
                'chat_messages.user_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.updated_at','chat_messages.created_at','chat_messages.id',
                'app_users.profile_pic as user_profile_pic','chat_messages.status'
            )
            ->where('chat_messages.chat_group_id', $inputs['chat_group_id'])
            ->where('chat_messages.user_id', '!=', $inputs['user_1_id'])
            ->where('chat_messages.status', '=', '0')
            ->orderBy('chat_messages.created_at', 'asc');
    }


  public function getCheckNewChatOfficerMessage($inputs){
        return  $this
            ->leftJoin('police_officers', 'police_officers.user_id', '=', 'chat_messages.user_id')
            ->select(
                'chat_messages.user_id','chat_messages.message','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.updated_at','chat_messages.created_at','chat_messages.id',
                'police_officers.profile_pic as user_profile_pic','chat_messages.status'
            )
            ->where('chat_messages.chat_group_id', $inputs['chat_group_id'])
            ->where('chat_messages.user_id', '!=', $inputs['user_1_id'])
            ->where('chat_messages.status', '=', '0')
            ->orderBy('chat_messages.created_at', 'asc');
    }
   /* public function getChatMessagesList($inputs){

        return $this->select('id','mobile_number','email')
            ->where('email', '=', $inputs['email'])
            ->where('login_type', '=', \Config::get('constants.LOGIN_TYPE.EMAIL'))
            ->first();
    }*/

    public function getAllHomeMessagesList($inputs){
       /* return  $this
            ->leftJoin('requests', 'requests.id', '=', 'chat_messages.request_id')
            ->select(
                'chat_messages.request_id as request_id', 'chat_messages.user_id', 'requests.user_id as request_user_id', 'requests.earner_id as request_earner_id'
            )
            ->where(function($andOr) use ($inputs){
                $andOr->where('requests.user_id', $inputs['user_id'])->orWhere('requests.earner_id', $inputs['user_id']);
            })
           // ->where('chat_messages.user_id', '!=', $inputs['user_id'])
            ->orderBy('chat_messages.created_at', 'desc')
            ->groupBy('chat_messages.user_id');*/
      return  $this
            ->leftJoin('chat_groups', 'chat_groups.id', '=', 'chat_messages.chat_group_id')
            ->select(
                'chat_messages.chat_group_id','chat_messages.user_id', 'chat_messages.user_id', 'chat_groups.user_1_id', 'chat_groups.user_2_id'
            )
            ->where(function($andOr) use ($inputs){
                $andOr->where('chat_groups.user_1_id', $inputs['user_id'])->orWhere('chat_groups.user_2_id', $inputs['user_id']);
            })
            ->orderBy('chat_messages.created_at', 'desc');
            //->groupBy('chat_messages.user_id');
    }

    public function getLastHomeScreenMessageDetail($inputs) {
        /*return  $this
            ->leftJoin('requests', 'requests.id', '=', 'chat_messages.request_id')
            ->select(
                'chat_messages.message','chat_messages.user_id','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.created_at','chat_messages.id'
            )
            ->where(function($andOr) use ($inputs){
                $andOr->where('chat_messages.user_id', $inputs['user_id_1'])->orWhere('chat_messages.user_id', $inputs['user_id_2']);
            })
            ->orderBy('chat_messages.created_at', 'desc');*/
        return  $this
            //->leftJoin('requests', 'requests.id', '=', 'chat_messages.request_id')
            ->select(
                'chat_messages.message','chat_messages.user_id','chat_messages.type','chat_messages.image','chat_messages.thumb_image',
                'chat_messages.created_at','chat_messages.id'
            )
            ->where('chat_messages.chat_group_id',  $inputs['chat_group_id'] )
            ->orderBy('chat_messages.created_at', 'desc');
    }

    public function getCountUnreadMessages($inputs){
      /*  return  $this
            ->leftJoin('requests', function($join) {
                $join->on('requests.id', '=', 'chat_messages.request_id');
                $join->on(function($query) {
                    $query->on('requests.user_id', '=', 'chat_messages.user_id');
                    $query->orOn('requests.earner_id', '=', 'chat_messages.user_id');
                });
            })
            ->where('chat_messages.user_id', '!=', $inputs['user_id_1'] )
            ->where('chat_messages.user_id', '=', $inputs['user_id_2'] )
            ->where('chat_messages.status', '=', '0')->count();*/
        return  $this
            ->where('chat_messages.chat_group_id', '=', $inputs['chat_group_id'] )
            ->where('chat_messages.user_id', '!=', $inputs['user_id'] )
            ->where('chat_messages.status', '=', '0')->count();
    }

}
