<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChatMessage;
use App\ChatGroup;
use App\UserRequest;
use App\User;
use App\Contact;
use App\Notification;
use App\UserInfo;
use App\AppUser;
use App\PoliceOfficer;
use DB;

class ConversationController extends Controller
{

    /**
     * @Get Chat list of messages for user and earner Post Method
     * @param Request $request
     * @return mixed
     */
    public function listChatMessages(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();




                $chatIdsArray = (new ChatMessage())->getUpdateListChatMessagesStatus($inputs)->get();
                if(!empty($chatIdsArray)){
                    $chatIdsArray = array_column($chatIdsArray->toArray(), 'id');
                    (new ChatMessage())->whereIn('id', $chatIdsArray)->update(['status' => '1' ]);
                }
                DB::commit();
                // $chatMessagesList = (new ChatMessage())->where('request_id', '=', $inputs['request_id'])->get()->toArray();
                $findChatGroup = (new ChatGroup())->findChatGroupId(['user_1_id' => $inputs['user_1_id'], 'user_2_id' => $inputs['user_2_id'] ] )->first();
                $inputs['chat_group_id'] = $findChatGroup['id'];
                
               // $userId = (new ChatMessage())->select('user_type')->groupBy('user_type')->where('chat_group_id',$findChatGroup['id'])->get()->toArray();


                   // $chatMessagesList = (new ChatMessage())->getAllChatMessagesList($inputs)->get()->toArray();
                    
            
                    $chatMessagesList = (new ChatMessage())->getAllChatMessagesList($inputs)->get()->toArray();

             

                if (!empty($chatMessagesList)) {
                    $new_chat_messages = array();
                    foreach($chatMessagesList as $chat_message){


                        $dataDateTime = date('Y-m-d', strtotime($chat_message['created_at']));
                        if (!isset($compDateTime) || ( isset($compDateTime) && $compDateTime != $dataDateTime ) ){
                            $chat_message['date_new'] = convertTimeZoneWithoutFormat($inputs['country_code'],$chat_message['created_at']);
                            $compDateTime = $dataDateTime;
                        } else {
                            $chat_message['date_new'] = '';
                        }
                        $chat_message['created_at'] = convertTimeZone($inputs['country_code'],$chat_message['created_at']);
                        $new_chat_messages[] = $chat_message;
                    }
                    /*
                     foreach($chatMessagesList as $chat_message){
                        $dataDateTime = date('Y-m-d', strtotime($chat_message['created_at']));
                        if ( !isset($compDateTime) || ( isset($compDateTime) && $compDateTime != $dataDateTime ) ){
                            $chat_message['date_new'] = convertTimeZoneWithoutFormat($inputs['country_code'],$chat_message['created_at']);
                            $compDateTime = $dataDateTime;
                            $chat_message['created_at'] = convertTimeZone($inputs['country_code'],$chat_message['created_at']);
                            $new_chat_messages[$compDateTime][] = $chat_message;
                        }else{
                            $chat_message['date_new'] = $compDateTime;
                            $new_chat_messages[$compDateTime][] = $chat_message;
                        }

                    }
                    */
                 
                        return jsonResponse(true, 200, "Get chat messages list successfully.", [], $new_chat_messages);
                   

                } else {
                   
                        return jsonResponse(false, 200, "Could not be get chat messages list successfully.", [], []);
                  
                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * @send Chat Message Post Method
     * @param Request $request
     * @return mixed
     */
       public function sendChatMessage(Request $request){
        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();

                $image = $request->file('message');
                $country_code = $inputs['country_code'];
                $userTypeOne = (new AppUser())->select('type')->where('id',$inputs['user_1_id'])->first();

                $userTypeTwo = (new AppUser())->select('type')->where('id',$inputs['user_2_id'])->first();
                $findChatGroup = (new ChatGroup())->findChatGroupId(['user_1_id' => $inputs['user_1_id'], 'user_2_id' => $inputs['user_2_id'] ] )->first();
                if(isset($findChatGroup) && !empty($findChatGroup->id) && $findChatGroup->id != 0 ) {
                    $chatGroupId = $findChatGroup->id;
                } else{
                    $chatGroup = (new ChatGroup())->create(['user_1_id' => $inputs['user_1_id'], 'user_2_id' => $inputs['user_2_id'] ] );
                    $chatGroupId = $chatGroup->id;
                }
                // DB::commit();

                if (!empty($image)) {
                    $input['image_name'] = time() . rand(0, 9) . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constants.CHATS.IMAGE_FOLDER')) . '/group_' . $chatGroupId;
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $image->move($destinationPath, $input['image_name']);
                    $filePath = $destinationPath . '/' . 'thumb_' . $input['image_name'];
                    $newPath = $destinationPath . '/' . $input['image_name'];
                    createThumb($newPath, $filePath, 150, 150);

                    $chatImageFolder = \Config::get('constants.FILE_BASE_URL') . \Config::get('constants.CHATS.IMAGE_FOLDER');
                    $inputs['message'] = '';
                    $inputs['type'] = 'image';
                    $inputs['image'] = $chatImageFolder . '/group_' . $chatGroupId . '/' . $input['image_name'];
                    $inputs['thumb_image'] = $chatImageFolder . '/group_' . $chatGroupId . '/' . 'thumb_' . $input['image_name'];
                } else {
                    $inputs['type'] = $inputs['type'];
                    $inputs['image'] = isset($inputs['type']) && $inputs['type'] == 'location' ? $inputs['latlng']  : '';
                    $inputs['thumb_image'] = '';
                }

                $inputs['user_id'] = $inputs['user_1_id'];
                $inputs['user_type'] = $userTypeOne['type'];
                unset($inputs['country_code']);

                //   $request_detail = (new UserRequest())->select('user_id', 'earner_id', 'chat_group_id')->where('id', $inputs['request_id'])->first();
                $inputs['chat_group_id'] = $chatGroupId;
                $chatData = (new ChatMessage())->create($inputs);

                    if ($chatData) {

                          $userOne = (new AppUser())->select('id', 'name', 'device_token', 'profile_pic', 'device_type', 'status', 'notification_status')->where('id', $inputs['user_1_id'])->first();
                            $userTwo = (new AppUser())->select('id', 'name', 'device_token', 'profile_pic', 'device_type', 'status', 'notification_status')->where('id', $inputs['user_2_id'])->first();

                    
                        if (!empty($userOne) && !empty($userTwo)) {
                            DB::commit();

                            $userOne = $userOne->toArray();
                            $userTwo = $userTwo->toArray();

                            if ($userOne['id'] == $chatData->user_id) {
                                $sender = $userOne;
                                $reciever = $userTwo;
                            } else {
                                $sender = $userTwo;
                                $reciever = $userOne;
                            }
                            $notification_data = array('user_1_id' => $inputs['user_1_id'], 'user_2_id' => $sender['id'],'group_chat_id' => $chatGroupId, 'sender_profile_pic' => $sender['profile_pic'], 'sender_full_name' => $sender['name']);
                            $notificationMessage = $sender['name'] . ' sent you a message';
                            if ($reciever['status'] == '1')
                                sendNotification2($sender['id'], $reciever['device_token'], $reciever['device_type'], $notificationMessage, 'chat_message', $notification_data);

                            $chatData = $chatData->toArray();
                            $chatData['created_at'] = convertTimeZone($country_code, $chatData['created_at']);
                            $chatData['sender_profile_pic'] = $sender['profile_pic'];
                            $chatData['sender_full_name'] = $sender['name'];
                            $chatData['status'] = '0';
                            $chatData['date_new'] = '';
                            $chatData['user_id'] = (int)$chatData['user_id'];
                                return jsonResponseWithoutResult(true, 200, "message sent successfully.", [], ['0' => $chatData]);
                            
                        }
                    }
                
               
                    return jsonResponseWithoutResult(false, 200, "Could not be sent message successfully.", [], []);
               
            }
            return jsonResponseWithoutResult(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo 'Message: ' . $e->getMessage();
            //die;
        }
    }


    /**
     * @Get Check New Chat Message Post Method
     * @param Request $request
     * @return mixed
     */
    public function checkNewChatMessage(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();
                $findChatGroup = (new ChatGroup())->findChatGroupId(['user_1_id' => $inputs['user_1_id'], 'user_2_id' => $inputs['user_2_id'] ] )->first();
                $inputs['chat_group_id'] = $findChatGroup['id'];
                $userType = (new ChatMessage())->select('user_type')->where('chat_group_id', $findChatGroup['id'])->first();
          
                  $chatMessagesList = (new ChatMessage())->getCheckNewChatMessage($inputs)->get();
                  
               
        
    
                if (count(($chatMessagesList)) > 0) {
                    $chatMessagesList = $chatMessagesList->toArray();

                    (new ChatMessage())
                        ->where('chat_group_id', '=', $inputs['chat_group_id'])->where('user_id', '!=', $inputs['user_1_id'])->where('status', '=', '0')
                        ->update(['status' => '1']);
                    DB::commit();

                    $new_chat_messages = array();
                    foreach($chatMessagesList as $chat_message){
                        $chat_message['created_at'] = convertTimeZone($inputs['country_code'],$chat_message['created_at']);
                        $chat_message['date_new'] = '';
                        $new_chat_messages[] = $chat_message;
                    }

                        return jsonResponse(true, 200, "Get chat messages list successfully.", [], $new_chat_messages);

                } else {
                        return jsonResponseWithoutResult(false, 200, "Not found chat messages list successfully.", [], []);
                    
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * @Get Check Chat Message Status Post Method
     * @param Request $request
     * @return mixed
     */
    public function checkChatMessageStatus(Request $request)
    {

        try {
            $inputs = $request->all();
            if ($request->isMethod('post')) {
                $chatMessageData = (new ChatMessage())->where('id', '=', $inputs['message_id'])->first()->toArray();

                if ($chatMessageData['status'] == '1') {
                  return jsonResponse(true, 200, "Message seen.");
                  
                } else {
                  return jsonResponse(false, 200, "Message not seen.");
                   
                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            echo $e->getMessage();
            // something went wrong
        }
    }

    /**
     * @Get list message for home screen Post Method
     * @param Request $request
     * @return mixed
     */
    public function listHomeMessages(Request $request)
    {

        try {
            $inputs = $request->all();
            if ($request->isMethod('post')) {
                $page = isset($inputs['page_count']) && $inputs['page_count'] != '' ? $inputs['page_count'] : 0;
                $limit = \Config::get('constants.REQUEST_LIMIT');
                $homeMessagesList = (new ChatMessage())->getAllHomeMessagesList($inputs)->skip($limit*$page)->take($limit)->get()->toArray();
                
                if (!empty($homeMessagesList)) {
                    $home_messages_2 = array();
                    foreach($homeMessagesList as $homeMessage){
                        $homeMessage['user_id'] = ( $inputs['user_id'] == $homeMessage['user_1_id'] ) ? $homeMessage['user_2_id'] : $homeMessage['user_1_id'];
                        unset($homeMessage['user_1_id']);
                        unset($homeMessage['user_2_id']);
                        $home_messages_2[] = $homeMessage;
                    }
                    $homeMessagesList2 = array_unique($home_messages_2,SORT_REGULAR);

                }
                if (isset($homeMessagesList2) && !empty($homeMessagesList2)) {
                    $new_home_messages = array();
                    foreach($homeMessagesList2 as $homeMessage){


                        $getLastMessageDetail = (new ChatMessage())->getLastHomeScreenMessageDetail([ 'chat_group_id' => $homeMessage['chat_group_id'] ])->first();

    
                        $lastMessage = 'has sent an image.';
                        $homeMessage['message'] = ($getLastMessageDetail->type == 'image') ? $lastMessage :$getLastMessageDetail->message;
                        $homeMessage['type'] = $getLastMessageDetail->type;
                        $homeMessage['image'] = $getLastMessageDetail->image;
                        $homeMessage['thumb_image'] = $getLastMessageDetail->thumb_image;
                        $homeMessage['created_at'] = $getLastMessageDetail->created_at;
                        $homeMessage['id'] = $getLastMessageDetail->id;
                        $userType = (new AppUser())->select('type')->where('id', $homeMessage['user_id'])->first();
                    if($userType['type'] == 0) {

                          $appUser2Info = (new UserInfo())->Select('name', 'profile_pic','mobile_number')->Where('user_id',$homeMessage['user_id'])->first();
                                  
                        }
                        else {

                          $appUser2Info = (new PoliceOfficer())->Select('name', 'profile_pic','mobile_number')->Where('user_id',$homeMessage['user_id'])->first();
                        }

                        $homeMessage['user_full_name'] = $appUser2Info['name'];
                        $homeMessage['mobile_number'] = $appUser2Info['mobile_number'];
                        $homeMessage['user_profile_pic'] = $appUser2Info['profile_pic'];
                        $homeMessage['created_at'] = convertTimeZone($inputs['country_code'],$homeMessage['created_at']);
                        $homeMessage['count_unread_messages'] = (new ChatMessage())->getCountUnreadMessages([ 'user_id' => $inputs['user_id'], 'chat_group_id' => $homeMessage['chat_group_id']  ]);
                        $new_home_messages[] = $homeMessage;
                    }
                        return jsonResponse(true, 200, "Get home messages list successfully.", [], $new_home_messages);
                   

                } else {
                        return jsonResponse(false, 200, "Could not be get home messages list successfully.", [], []);
                    

                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            echo $e->getMessage();
            // something went wrong
        }
    }





    /**
     * @Get user notification list post method
     * @param Request $request
     * @return mixed
     */


    public function getUserNotificatinList(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                DB::beginTransaction();
                $inputs = $request->all();
                $userInfo = (new AppUser())->getUser($inputs['user_id']);
                $userNotification = (new Notification())->getNotification($inputs)->get();
                if($userInfo) {

                    if (!$userNotification->isEmpty()) {

                      return jsonResponse(true, 200, "Data found successfully", [], $userNotification);
                        
                    } else {
                       
                      return jsonResponse(false, 200, "No data found");
                        
                    }
                }
                else {
                    
                  return jsonResponse(false, 200, "Invalid move or user id");
                    
                }

            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }





}
