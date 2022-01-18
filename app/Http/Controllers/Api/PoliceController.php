<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserRequest;
use App\EmergencyAlert;
use App\Notification;
use DB;
class PoliceController extends Controller
{
     public function todoList(Request $request)
     {
        
        try {
            if ($request->isMethod('post')) {
                $inputs = $request->all();
                $officerToDoList = (new UserRequest())->getEmergencyAlertUsersForOfficer($inputs)->get();
                $officerToDoListArr = isset($officerToDoList) && $officerToDoList != '' ? $officerToDoList->toArray() : [];
                if ($officerToDoListArr) {
                      
                    return jsonResponse(true, 200, "Data found successfully",[],$officerToDoListArr);
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }




     public function acceptRequest(Request $request)
     {
        
        try {
            if ($request->isMethod('post')) {
              	DB::beginTransaction();
                $inputs = $request->all();
                $checkAcceptRequest = (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->first()->toArray();
              	
                $getUserInfo = DB::table('user_informations')->where('user_id', $checkAcceptRequest['user_id'])->first();
               
                $getOfficerInfo = DB::table('police_officers')->where('user_id', $checkAcceptRequest['police_officer_id'])->first();

                if($checkAcceptRequest['status'] > 1){

              		return jsonResponseWithoutResult(false, 200, "This request is already accepted",[],[]);

              	}
                else {

                  $notificationMessage = ucfirst($getOfficerInfo['name']).' is accepted your request';

                  sendNotification($getUserInfo->id, $getUserInfo->device_token, $getUserInfo->device_type, $notificationMessage, 'request_accepted');

               		$updateEmergencyAlert	=   (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->update(['police_officer_id' => $inputs['police_officer_id'],'status' => 2,'created_at' => date('y-m-d h:i:s')]);
               		(new UserRequest())->where('emergency_alert_id',$inputs['emergency_alert_id'])->delete();
            			DB::commit();
                }
              
                if ($updateEmergencyAlert) {
                      
                    return jsonResponseWithoutResult(true, 200, "Request accepted successfully");
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "Could not accepted request");
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
             DB::rollback();
             echo $e->getMessage();
        }
    }



      public function rejectRequest(Request $request)
      {
        
        try {
            if ($request->isMethod('post')) {
              	DB::beginTransaction();
                $inputs = $request->all();
                $checkAcceptRequest = (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->where('status', '>', 1)->first();
                $getUserInfo = DB::table('user_informations')->where('user_id', $checkAcceptRequest['user_id'])->first();
              	$getOfficerInfo = DB::table('police_officers')->where('user_id', $checkAcceptRequest['police_officer_id'])->first();

                if($checkAcceptRequest){
                  
                  $notificationMessage = ucfirst($getOfficerInfo['name']).' is rejected your request';

                  sendNotification($getUserInfo['id'], $getUserInfo['device_token'], $getUserInfo['device_type'], $notificationMessage, 'request_rejected');

					        (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->update(['police_officer_id' => $inputs['police_officer_id'],'status' => 1]);
            		  DB::commit();
                  return jsonResponseWithoutResult(true, 200, "Request rejected successfully");
              	}
               	else {
                   
                  return jsonResponseWithoutResult(false, 200, "Could not rejected request");
                }
                
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
             DB::rollback();
             echo $e->getMessage();
        }
    }


    public function alertDetail(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
                $inputs = $request->all();
                $emergencyAlertDetail = (new EmergencyAlert())->getEmergencyAlertUserApi($inputs)->first();
   				      $myEmergencyAlertDetail = isset($emergencyAlertDetail) && $emergencyAlertDetail != '' ? $emergencyAlertDetail->toArray() : [];

               if($myEmergencyAlertDetail){


   					        $getEmergencyAlertFiles = DB::table('emergency_alert_files')->where('em_alert_id', $emergencyAlertDetail['ea_id'])->get();            	

                      if($getEmergencyAlertFiles){

                        $myEmergencyAlertDetail['files'] = $getEmergencyAlertFiles;

                      } else {

                        $myEmergencyAlertDetail['files'] = [];
                      }
                  }

                if ($myEmergencyAlertDetail) {
                      
                    return jsonResponse(true, 200, "Data found successfully",[],$myEmergencyAlertDetail);
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }



      public function inprogressList(Request $request)
      {
        
        try {
            if ($request->isMethod('post')) {
              
                $inputs = $request->all();
                $officerInprogressList = (new EmergencyAlert())->getInprogessData($inputs)->get();
                $officerInprogressListArr = isset($officerInprogressList) && $officerInprogressList != '' ? $officerInprogressList->toArray() : [];
                if ($officerInprogressListArr) {
                      
                  return jsonResponse(true, 200, "Data found successfully",[],$officerInprogressListArr);
              
                } else {
                   
                  return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }




      public function incompleteList(Request $request)
     {
        
        try {
            if ($request->isMethod('post')) {
              
                $inputs = $request->all();
                $officerIncompleteList = (new EmergencyAlert())->getIncompleteData($inputs)->get();
                $officerIncompleteListArr = isset($officerIncompleteList) && $officerIncompleteList != '' ? $officerIncompleteList->toArray() : [];
                if ($officerIncompleteListArr) {
                      
                    return jsonResponse(true, 200, "Data found successfully",[],$officerIncompleteListArr);
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }





      public function completeList(Request $request)
     {
        
        try {
            if ($request->isMethod('post')) {
              
                $inputs = $request->all();
                $officerCompleteList = (new EmergencyAlert())->getCompleteData($inputs)->get();
                $officerCompleteListArr = isset($officerCompleteList) && $officerCompleteList != '' ? $officerCompleteList->toArray() : [];
                if ($officerCompleteListArr) {
                      
                    return jsonResponse(true, 200, "Data found successfully",[],$officerCompleteListArr);
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
         
            echo $e->getMessage();
            // something went wrong
        }
    }




      public function incompleteRequest(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
              	DB::beginTransaction();
                $inputs = $request->all();


                
                $comment = isset($inputs['comment']) && $inputs['comment'] != '' ? $inputs['comment'] : '';

                $checkIncompleteRequest = (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->where('status',  2)->first();
              	if(!$checkIncompleteRequest){

              		return jsonResponseWithoutResult(false, 200, "No data found",[],[]);

              	}
                else {

               		$updateEmergencyAlert	=   (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->update(['comment' => $comment,'status' => 3,'created_at' => date('y-m-d h:i:s')]);
            		  DB::commit();
                }
              
                if ($updateEmergencyAlert) {
                      
                    return jsonResponseWithoutResult(true, 200, "Your request incompleted successfully");
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "Could not complete your request");
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
             DB::rollback();
             echo $e->getMessage();
        }
    }



     public function completeRequest(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
              	DB::beginTransaction();
                $inputs = $request->all();
                $comment = isset($inputs['comment']) && $inputs['comment'] != '' ? $inputs['comment'] : '';

                $checkIncompleteRequest = (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->where('status',  2)->first();
              	if(!$checkIncompleteRequest){

              		return jsonResponseWithoutResult(false, 200, "No data found",[],[]);
              	}
                else {

               	  $updateEmergencyAlert	=  (new EmergencyAlert())->where('id',$inputs['emergency_alert_id'])->update(['comment' => $comment,'status' => 4,'created_at' => date('y-m-d h:i:s')]);
            		  DB::commit();
                }
              
                if ($updateEmergencyAlert) {
                      
                    return jsonResponseWithoutResult(true, 200, "Your request completed successfully");
              
                } else {
                   
                    return jsonResponseWithoutResult(false, 200, "Could not complete your request");
                }
            }
            return jsonResponseWithoutResult(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
             DB::rollback();
             echo $e->getMessage();
        }
    }



      public function notification(Request $request)
      {
        try {
            if ($request->isMethod('post')) {
                $inputs = $request->all();
                $notification = (new Notification())->getNotification($inputs)->get();
                $notificationArr = isset($notification) && $notification != '' ? $notification->toArray() : [];
                if ($notificationArr) {
                  return jsonResponse(true, 200, "Data found successfully", [], $notificationArr);
                
                } else {

                  return jsonResponseWithoutResult(false, 200, "No data found");
                }
            }
            return jsonResponse(false, 500, "Oops! something went wrong, server error.");
        } catch (\Exception $e) {
            echo $e->getMessage();
            // something went wrong
        }
    }



     public function getCountNotifications(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                $inputs = $request->all();
            if(isset($inputs['notification_id'])) {
                 (new Notification())->where('id', '=', $inputs['notification_id'])->where('receiver_id', '=', $inputs['user_id'])->update([ 'status' => '1' ]);
            }
                $newNotificationsCount = (new Notification())->where('receiver_id',$inputs['user_id'])->where('status',0)->get()->count();
                
                if (!empty($newNotificationsCount)) {

                    return ['success'=>true,'status_code'=>200,"message"=>"Get count notifications successfully",'result'=>$newNotificationsCount];

                       //return jsonResponse(true, 200, "Get count notifications successfully.", [], ['count_new_notifications' => $newNotificationsCount]);
                    
                } else {
             
                        return jsonResponseWithoutResult(false, 200, "Could not be get count notifications successfully.", [], []);
                   
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
