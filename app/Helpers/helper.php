<?php

function pr($data, $exit = false) {
    echo "<pre>";
    print_r($data);
    if ($exit) {
        die;
    }
}


function plain_url_to_link($string) {
  return preg_replace(
  '%(https?|ftp)://([-A-Z0-9./_*?&;=#]+)%i', 
  '<a target="blank" rel="nofollow" href="$0" target="_blank">$0</a>', $string);
}

function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp)
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

function userDefineSort($hospital, $doctor){
    $hospitals = strtotime($hospital['updated_at']);
    $doctors = strtotime($doctor['updated_at']);
    return ($hospitals-$doctors);
}





function fileBashUrl($folderName){

    $url = url()->current();

    $newUrl = substr($url, 0, strpos($url, "index.php"));

    $fileUrl = $newUrl.$folderName;

    return $fileUrl;
}



function createThumb($name, $filename, $new_w, $new_h) {

    $found = 0;
    $system = explode('.', $name);

    $echeck = strtolower(end($system));

    if (preg_match('/jpg|jpeg/', $echeck)) {
        $src_img = imagecreatefromjpeg($name);
        $found = 1;
    }

    if (preg_match('/png/', $echeck)) {

        $src_img = imagecreatefrompng($name);

        $found = 1;
    }

    if (preg_match('/gif/', $echeck)) {
        $src_img = imagecreatefromgif($name);
        $found = 1;
    }

    if ($found) {

        $old_x = imagesx($src_img);
        $old_y = imagesy($src_img);

        $ar = $old_x / $old_y;

        if ($old_x > 200) {

            if ($new_w == $new_h) {
                $thumb_w = $new_w;
                $thumb_h = $new_h;
            } else {
                $thumb_w = $new_w;
                $thumb_h = (int)(($old_y / $old_x) * $new_w);
            }
        } else {
            $thumb_w = $old_x;
            $thumb_h = $old_y;
        }

        $dst_img = imagecreatetruecolor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        if (preg_match("/png/", $echeck)) {
            imagepng($dst_img, $filename);
        } else if (preg_match('/jpg|jpeg/', $echeck)) {
            imagejpeg($dst_img, $filename, 100);
        } else if (preg_match("/gif/", $echeck)) {
            imagegif($dst_img, $filename);
        }
        imagedestroy($dst_img);
    }

    imagedestroy($src_img);

}




function sendNotification2($id, $deviceToken, $deviceType, $message, $messageType, $postRequestId = '') {

    $ch = curl_init("https://fcm.googleapis.com/fcm/send");
    $groupChatId = isset($postRequestId['group_chat_id']) && $postRequestId['group_chat_id'] != '' ? $postRequestId['group_chat_id'] : '';
    $request_user_id = isset($postRequestId['user_id']) && $postRequestId['user_id'] != '' ? $postRequestId['user_id'] : '';
    $user_2_id = isset($postRequestId['user_2_id']) && $postRequestId['user_2_id'] != '' ? $postRequestId['user_2_id'] : '';
    $sender_full_name = isset($postRequestId['sender_full_name']) && $postRequestId['sender_full_name'] != '' ? $postRequestId['sender_full_name'] : '';
    $sender_profile_pic = isset($postRequestId['sender_profile_pic']) && $postRequestId['sender_profile_pic'] != '' ? $postRequestId['sender_profile_pic'] : '';

    if($deviceType == 'ios') {
        $data = $groupChatId. ',' .$messageType. ','  .$user_2_id. ','  .$request_user_id. ',' .$sender_full_name. ',' .$sender_profile_pic;

        $notification = array(
            'title'     => 'NPFRecueMe' ,
            'data'      => $data,
            'text'      => $message,
            'sound'     => 'default',
            'content-available'=> 1
        );
        $arrayToSend = array(
            'to' => $deviceToken,
            'notification' => $notification,
            'sound' => 'default',
            'content-available'=> 1,
            'badge' => 2,
            'priority'=>'high'
        );
    }
    else {
        $data = array (
            'group_chat_id'        => $groupChatId,
            'user_id'           => $request_user_id,
            'sender_profile_pic'  => $sender_profile_pic,
            'sender_full_name'  => $sender_full_name,
            'user_2_id'     => $user_2_id,
            'title'        => 'NPFRecueMe',
            'id'           => $id,
            'message'      => $message,
            'device_type'  => $deviceType,
            'click_action' => 'OPEN_ACTIVITY_1',
            'type'         => $messageType,
            'smallIcon'    => 'notification_icon',
            'largeIcon'    => 'large_notification_icon',
            'sound'        => 'sound_type_notification',
        );
        $arrayToSend = array(
            'registration_ids' => array($deviceToken),
            'data'=> $data,
        );

    }
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    //$headers[] = 'Authorization: key= AAAALp9R5cU:APA91bHTuiVV0bGpVBHvX5qXiK8LgLgl0LpK9GPJ_22bw_5Do1WbvBd-NU3UFwl5BvTtD_cM-sAoLgTVzF5cr2ONEUiSg_-VBkTPlzvqoR_Yad0IAjtRDGAjFKmzQSVF7JdSygM_jXjmiHpcn9Izp6v8A0jL6PXuQQ'; // key here
   $headers[] = 'Authorization: key= AAAApXScrk4:APA91bEIafU63dzv4TV4GTq1z1AdU0zRLgJb3egpUePuriGUs9-UGGPzCDqgyCmHV0nj-uTWVPsU5ouqHj5G1sNF8UOWvlj4Dgk9W0ia0QJlx4t4kCbu56kQQxyJAaqy81ZPX7sXWEfA'; // key here



    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);

    return true;
}


function convertTimeZone($country_code,$dateTime){
    $timezone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country_code);
    $dt = new \DateTime($dateTime);
    $tz = new \DateTimeZone($timezone[0]); // or whatever zone you're after
    $dt->setTimezone($tz);
    $newDateTime = date('h:i A', strtotime($dt->format('Y-m-d H:i:s')));
    return $newDateTime;
}

function convertTimeZoneWithoutFormat($country_code,$dateTime){
    $timezone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country_code);
    $dt = new \DateTime($dateTime);
    $tz = new \DateTimeZone($timezone[0]); // or whatever zone you're after
    $dt->setTimezone($tz);
    $newDateTime = date('Y-m-d H:i:s', strtotime($dt->format('Y-m-d H:i:s')));
    return $newDateTime;
}



function jsonResponse($status, $statusCode, $message = null, $errors = [], $result = []) {

    $response = ['success' => $status, 'status_code' => $statusCode];

    if ($message != "") {
        $response['message'] = $message;
    }

    if (count($errors) > 0) {
        $response['errors'] = $errors;
    }

    if (count($result) > 0) {

        $response['result'] = $result;
       
    }
    if (!$result) {
        
        $response['result'] = [];
       
    }

    return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
    
}
function jsonResponseWithoutResult($status, $statusCode, $message = null, $errors = [], $result = []) {

    $response = ['success' => $status, 'status_code' => $statusCode];

    if ($message != "") {
        $response['message'] = $message;
    }

    if (count($errors) > 0) {
        $response['errors'] = $errors;
    }

    if (count($result) > 0) {

        $response['result'] = $result;
       
    }
   

    return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
    
}



function commentCountJsonResponse($status, $statusCode, $message = null, $errors = [], $result = [], $commentCount) {

    $response = ['success' => $status, 'status_code' => $statusCode];

    if ($message != "") {
        $response['message'] = $message;
    }

    if (count($errors) > 0) {
        $response['errors'] = $errors;
    }

    if (count($result) > 0) {

        $response['result'] = $result;


    }
    if($commentCount > 0){
        $response['comment_count'] = $commentCount;
    }

    //pr($response);
    //die;
    //return \Response::json($response, $statusCode, [], JSON_FORCE_OBJECT);
    return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
    //return response()->json($response, $statusCode, [JSON_NUMERIC_CHECK]);
}


/*function earningJsonResponse($status, $statusCode, $message = null, $errors = [], $result = [], $totalEarning = '', $spendTime = '', $completeTrip = '') {

    $response = ['success' => $status, 'status_code' => $statusCode];

    if ($message != "") {
        $response['message'] = $message;
    }

    if (count($errors) > 0) {
        $response['errors'] = $errors;
    }

    if (count($result) > 0) {
        $response['result'] = $result;
    }
    if($totalEarning != ''){
        $response['total_earning'] = $totalEarning;
    }
    if($spendTime != ''){
        $response['spend_time'] = $spendTime;
    }
    if($completeTrip != ''){
        $response['complete_trip'] = $completeTrip;
    }

    //pr($response);
    //die;
    //return \Response::json($response, $statusCode, [], JSON_FORCE_OBJECT);
    return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
    //return response()->json($response, $statusCode, [JSON_NUMERIC_CHECK]);
}*/

function generateOtpToken() {

    $otp = substr(uniqid(rand(), True), 0, 4); //verification token
    return $otp;

}


function sendTextMessage($phone,$message) {
    $phone_no = substr($phone, 1);
    $username = "mlf878";
    $password = "wekendy2016";
    $mobile = $phone_no; // format should be 966xxxxxxxxx please note we only provide GCC countries
    $message = $message;
    $sender = "Solo Taxi";
    $language = "1";
    return true;
    $http = "http://api-server3.com/api/send.aspx?username=".$username."&password=".$password."&mobile=".$mobile."&message=".urlencode($message)."&sender=".$sender."&language=".$language;
    //$strfile = file_get_contents($http);

    return $http;

}


function convertToHoursMins($time) {

    $time = date('H:i:s',strtotime($time, strtotime('midnight'))); // 01:01:01
    return $time;
}


function sendNotification($id,$deviceToken,$deviceType,$message,$messageType) {
  
    $ch = curl_init("https://fcm.googleapis.com/fcm/send");

    if($deviceType == 'ios') {
        $data = $id . ',' .$messageType;

        $notification = array(
            'title'     => 'PSSA' ,
            'data'      => $data,
            'text'      => $message,
            'sound'     => 'default',
            'content-available'=> 1
        );
        $arrayToSend = array(
            'to' => $deviceToken,
            'notification' => $notification,
            'sound' => 'default',
            'content-available'=> 1,
            'badge' => 2,
            'priority'=>'high'
        );
    }
    else {
        $data = array (
            'title'        => 'PSSA',
            'id'           => $id,
            'message'      => $message,
            'device_type'  => $deviceType,
            'click_action' => 'OPEN_ACTIVITY_1',
            'type'         => $messageType,
            'smallIcon'    => 'notification_icon',
            'largeIcon'    => 'large_notification_icon',
            'sound'        => 'sound_type_notification',
        );
        $arrayToSend = array(
            'registration_ids' => array($deviceToken),
            'data'=> $data,
        );

    }
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key= AAAApXScrk4:APA91bEIafU63dzv4TV4GTq1z1AdU0zRLgJb3egpUePuriGUs9-UGGPzCDqgyCmHV0nj-uTWVPsU5ouqHj5G1sNF8UOWvlj4Dgk9W0ia0QJlx4t4kCbu56kQQxyJAaqy81ZPX7sXWEfA'; // key here

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);
	//pr($ch);
//pr($headers);
//pr($json);
//die;
    return true;
}


function differentTwoDateTime($moveDateTime){



$datetime1 = new DateTime();
$datetime2 = $moveDateTime;


$addOneHoureMoveDateTime = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($datetime2)));

$addThirtyMinutesMoveDateTime = new DateTime(date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($datetime2))));


//$diff = date_diff($datetime1,$addThirtyMinutesMoveDateTime);

$interval = $datetime1->diff($addThirtyMinutesMoveDateTime);


//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
//$elapsed = $interval->format('%H:%i:%s');

//echo $interval->i.' minutes<br>';
//die;
// pr($datetime1);
// pr($addThirtyMinutesCurrentDateTime);
// pr($datetime2);
// pr($addThirtyMinutesMoveDateTime);
// die;
//$diff=date_diff($datetime1,$addThirtyMinutes);

if ($datetime1 > $addThirtyMinutesMoveDateTime) {

   return  date('Y-m-d H:i:s',strtotime('+'.$interval->i.'minutes',strtotime($addOneHoureMoveDateTime)));
}
else {
   return $addOneHoureMoveDateTime;
}

}

    //sending otp function

 function otpSendMessage($otp,$mobile_number){
    try{
        $authKey = "263523AibH6wuuI5c6a8513";

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "123456";

        $curl = curl_init();
        curl_setopt_array($curl, array(
//            CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?template=&otp_length=&authkey='".$authKey."'&message='".$message."'&sender='".$senderId."'&mobile='".$mobileNumber."'&otp=2589&otp_expiry=&email=",
            CURLOPT_URL=>"http://control.msg91.com/api/sendotp.php?authkey=$authKey&message=Your Verification code is: $otp&sender=123456&mobile=$mobile_number&otp=$otp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
//            echo "cURL Error #:" . $err;
        } else {
//            echo $response;
        }
    }catch (Exception $e){
        $e->getMessage();
    }

}


function sendMessage($otp,$mobile_number){
    try{
        $authKey = "263523AibH6wuuI5c6a8513";

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "123456";

        $curl = curl_init();
        curl_setopt_array($curl, array(
//            CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?template=&otp_length=&authkey='".$authKey."'&message='".$message."'&sender='".$senderId."'&mobile='".$mobileNumber."'&otp=2589&otp_expiry=&email=",
            CURLOPT_URL=>"http://api.msg91.com/api/sendhttp.php?country=91&sender=TESTIN&route=4&mobiles=$mobile_number&authkey=263523AibH6wuuI5c6a8513&message=$otp",

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
       
        $err = curl_error($curl);

        curl_close($curl);
       
 //pr($curl);
      //  die;
        if ($err) {
//            echo "cURL Error #:" . $err;
            return false;
        } else {
             return true;
        }
    }catch (Exception $e){
        $e->getMessage();
    }

}

function sendPushNotification($userdata){
    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
    );

    $pusher = new \Pusher\Pusher(
        '538f386d26d6c1d62c8b',
        'c5c431927e23ebbdc9b2',
        '1191283',
        $options
    );

    $msg=[
        'emergency_id'=>$userdata->id,
        'state'=>"$userdata->state",
        'emergency_counts'=>$userdata->emergency_counts
    ];
    $pusher->trigger('my-channel-production', 'my-event-production', $msg);
}
