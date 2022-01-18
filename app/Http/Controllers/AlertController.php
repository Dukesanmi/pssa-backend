<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyAlert;
use App\Department;
use App\PoliceOfficer;
use App\AppUser;
use DB;
use App\Responder;

class AlertController extends Controller
{
     /**
     * @Get all user function
     * @param Request $request
     *
     */

      public function __construct()
    {
        //$this->middleware('auth:department');
        //$this->middleware('auth');
    }

    public  function index(Request $request){
        try {
            if ($request->isMethod('get')) {
                $inputs = $request->all();
                $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';
                $statusKey = isset($inputs['status']) && $inputs['status'] != '' ? $inputs['status'] : '';
            
                $getAlert = (new EmergencyAlert())->getEmergencyAlertUsers()
                 ->where(function($query) use ($searchKey, $statusKey)  {
                if($searchKey) {
                    $query->where('unique_code', 'like', '%' . $searchKey . '%');
                }
                if ($statusKey){

                    $query->where('emergency_alerts.status', $statusKey);
 
                }
                })->paginate(\Config::get('constant.PAGINATION'));
              
                return view('alert.index',compact('getAlert','searchKey','statusKey'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {

            echo $e->getMessage();
            // something went wrong
        }
    }


    /**
     * @Edit Rider post Method
     * @param Request $request
     *
     */


    public  function edit(Request $request, $id){
        try {

            if ($request->isMethod('get')) {

                $getUsers = (new AppUser())->where('id',$id)->first();

                return view('user.edit',compact('getUsers'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            //echo $e->getMessage();
            // something went wrong
        }
    }

      public  function changeOfficer(Request $request, $id){
        try {


            if ($request->isMethod('get')) {

                $getOfficer = (new AppUser())->getOfficerList()->get();
               // pr($getOfficer);
                //die;
                return view('alert.edit',compact('getOfficer','id'));
            }
            return jsonResponse(false, 500, "Opps! something went wrong, server error.");
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }

     public  function updateOfficer(Request $request, $id){
        try {

            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $inputs = $request->all();
            
                $updateProfile = (new EmergencyAlert())->where('id',$id)->update(['police_officer_id' => $inputs['officer']]);

                DB::commit();
                if ($updateProfile) {
                    return redirect(route('alert.index'))->with('success', 'Officer assign successfully');
                }
                else {
                    return redirect()->back()->with('success', 'Officer could not be assigned');
                }
            }
            return view('rider.edit', compact('riderData'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }



    public  function update(UserRequest $request, $id){
        try {

            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $inputs = $request->all();

                $image = $request->file('image');
                if (!empty($image)) {
                    $input['file_name'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path(\Config::get('constant.USER_IMAGE'));
                    $image->move($destinationPath, $input['file_name']);
                }
                $userImagePath = \Config::get('constant.USER_IMAGE');
                $imageUrl = fileBashUrl($userImagePath);

                $updateProfile = array(
                    'profile_pic' => isset($input['file_name']) && $input['file_name'] != '' ? $imageUrl . '/' . $input['file_name'] : '',
                    'country_code' => isset($inputs['country_code']) && $inputs['country_code'] != '' ? $inputs['country_code'] : '',
                    'mobile_number' => isset($inputs['mobile_number']) && $inputs['mobile_number'] != '' ? $inputs['mobile_number'] : '',
                    'latitude' => isset($inputs['latitude']) && $inputs['latitude'] != '' ? $inputs['latitude'] : 0,
                    'longitude' => isset($inputs['longitude']) && $inputs['longitude'] != '' ? $inputs['longitude'] : 0,
                    'country' => isset($inputs['country']) && $inputs['country'] != '' ? $inputs['country'] : '',
                    'state' => isset($inputs['state']) && $inputs['state'] != '' ? $inputs['state'] : '',
                    'city' => isset($inputs['city']) && $inputs['city'] != '' ? $inputs['city'] : '',
                    'address' => isset($inputs['address']) && $inputs['address'] != '' ? $inputs['address'] : '',
                    'device_token' => isset($inputs['device_token']) && $inputs['device_token'] != '' ? $inputs['device_token'] : '',
                    'device_type' => isset($inputs['device_type']) && $inputs['device_type'] != '' ? $inputs['device_type'] : '',
                    'profile_status' => isset($inputs['profile_status']) && $inputs['profile_status'] == 0 ? 0 : 1,
                    'email_verify_status' => isset($inputs['email_verify_status']) && $inputs['email_verify_status'] != '' ? $inputs['email_verify_status'] : 0,
                );
                $updateProfile = (new AppUser())->where('id',$id)->update($updateProfile);
                DB::commit();
                if ($updateProfile) {
                    return redirect(route('user.index'))->with('success', 'User updated successfully');
                }
                else {
                    return redirect()->back()->with('success', 'User could not be updated');
                }
            }
            return view('rider.edit', compact('riderData'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            // something went wrong
        }
    }




    public function destroy(Request $request,$userId){
        try{
            if($request->isMethod('delete')){
                $user = (new AppUser())->where('id', $userId)->first();
                if (file_exists(public_path(\Config::get('constant.USER_IMAGE') . '/' . $user->profile_pic))) {
                    unlink(public_path(\Config::get('constant.USER_IMAGE') . '/' . $user->profile_pic));
                }
                (new AppUser())->where('id', $userId)->delete();
                return redirect()->back()->with('success', 'User deleted successfully');
            }
            return redirect()->back()->with('error','Whoops,looks like something went wrong');
        } catch (\Exception $e){
            echo $e->getMessage();
            // something went wrong
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        try {
            if ($request->isMethod('get')) {
                $responders = (new Responder())->select('id','first_name','last_name','phone_number')->get();
                $emergencyAlert = (new EmergencyAlert())->getEmergencyAlertUser($id)->first();
                
                $emergencyOfficerInfo = (new PoliceOfficer())->where('user_id',$emergencyAlert->police_officer_id)->first();
               
                $emergencyDepartmentInfo = (new Department())->where('id',$emergencyAlert->department_id)->first();
              
               
                $getEmergencyAlertFiles = DB::table('emergency_alert_files')->where('em_alert_id', $emergencyAlert->ea_id)->get();
                return view('alert.view',compact('emergencyAlert','getEmergencyAlertFiles','emergencyDepartmentInfo','emergencyOfficerInfo','responders'));
            }
            return redirect()->back()->with('error', 'Opps! something went wrong, Please try again.');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function alertsMap(Request $request)
    {  
        if($request->ajax())
        {
           $inputs=$request->all();
           $page_count=$inputs['page_count'];
           $limit = 15;
           $skip =$page_count*$limit;
           $data=(new EmergencyAlert())
           ->skip($skip)
           ->take($limit)
           ->orderBy('id','DESC')
           ->with('AlertsMap')
           ->when(isset($inputs['search_key'])&&$inputs['search_key']!='',function($query) use($inputs){
				$query->whereHas('AlertsMap',function($q) use($inputs){
           	$q->where('user_informations.name','LIKE','%'.$inputs['search_key'].'%');
           	$q->orWhere('user_informations.email','LIKE','%'.$inputs['search_key'].'%');
           	$q->orWhere('user_informations.mobile_number','LIKE','%'.$inputs['search_key'].'%');
           	$q->orWhere('emergency_alerts.unique_code','LIKE','%'.$inputs['search_key'].'%');
           	 });
           })
            ->get();
           return json_encode($data);
        }
         return view('alertsmap.alertsmap');
    }

    public function alertMapDetail(Request $request)
    {
        $inputs=$request->all();
        $data=(new EmergencyAlert())->where('id',$inputs['id'])->with('AlertsMap')->first();
        return json_encode($data);
    }

    public function Broadcast(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('broadcast.index');
        }

        else
        {   
            $inputs = $request->all();
            $message = $inputs['message'];
            $message_type = "broadcast_message";
            $deviceTokens = (new AppUser())->where('device_token','!=','')->get();
            // dd($deviceTokens);
            foreach ($deviceTokens as  $value) {
                sendNotification($value->id,$value->device_token,$value->device_type,$message,$message_type);
            }
            return redirect()->back()->with('success','BroadCast Message Sent Successfully');
        }
    }

    public function getNotificationData(Request $request){
        
        $data=(new EmergencyAlert())
            ->leftjoin('app_users','emergency_alerts.user_id','app_users.id')
            ->leftjoin('user_informations','app_users.id','user_informations.user_id')
            ->where('emergency_alerts.id',$request->id)
            ->select('emergency_alerts.em_Address','emergency_alerts.*','app_users.id as officer_id','user_informations.email','user_informations.name','user_informations.surname','user_informations.gender','user_informations.mobile_number','app_users.country_code')
            ->first();

        $time=convertTimeZoneWithoutFormat('NG',$data->created_at);

        // $data['address']=getAddressFromLatLong($data->latitude,$data->longitude);
        $data['nigeria_time']=$time;
          
        return json_encode($data);

    }

    public function StartTracking(Request $request,$id)
    {
        $data = (new EmergencyAlert())->where('id',$id)->first();
        return view('starttracking.index',compact('data'));
    }

    public function GetChartDetails(Request $request)
    {
            $inputs=$request->all();
            $month=[];
                if(isset($inputs['month']) && $inputs['month']!='' )
                {
                    $month=explode('-',$inputs['month']);
                 
                }
            $emergencyName=(new EmergencyAlert())
                            ->when(isset($inputs['date']) && $inputs['date']!='',function($query) use($inputs){
                                $query->whereDate('created_at', '=',$inputs['date']);
                            })
                            ->when(isset($inputs['year']) && $inputs['year']!='',function($query) use($inputs){
                                $query->whereYear('created_at','=',$inputs['year']);
                            })
                            ->when(isset($inputs['month']) && $inputs['month']!='',function($query) use($inputs,$month){
                                $query->whereYear('created_at','=',$month[0]);
                                $query->whereMonth('created_at','=',$month[1]);
                            })
                            
                            ->select('emergency_alerts.types_of_problem',DB::raw('count(*) as count'))
                            ->groupBy('emergency_alerts.types_of_problem')
                            ->get();
                           
           return jsonResponse(true,200,'Record Fetched',[],$emergencyName);
    }

}
