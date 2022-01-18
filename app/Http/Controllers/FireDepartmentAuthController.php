<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUser;
use DB;
use App\FireDepartment;

class FireDepartmentAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:fire');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = (new AppUser())->where('type',0)->count();
        $fireDepartmentsCount = DB::table('fire_departments')->count();

        return view('fire_backend.home',['userCount'=>$userCount,'fireDepartmentsCount'=>$fireDepartmentsCount]);
    }
    public function viewUsers(Request $request ,$param,$id=Null){
        switch ($param):
            case 'list':
                try {
                    if ($request->isMethod('get')) {
                        $inputs = $request->all();
                        $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';

                        $getUsers = (new AppUser())->getLoginUserInfoList($searchKey)->orderBy('id','desc')->paginate(\Config::get('constant.PAGINATION'));

                        return view('fire_backend.user.index',compact('getUsers','searchKey'));
                    }
                    return jsonResponse(false, 500, "Opps! something went wrong, server error.");
                } catch (\Exception $e) {

                    echo $e->getMessage();
                    // something went wrong
                }
                break;
            case 'view':
                try {
                    if ($request->isMethod('get')) {
                        $inputs['user_id'] = $id;
                        $user = (new AppUser())->getLoginUserInfo($inputs);
                        return view('fire_backend.user.view',compact('user'));
                    }
                    return redirect()->back()->with('error', 'Opps! something went wrong, Please try again.');
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
                break;

        endswitch;

    }

    public function viewDepartment(Request $request,$param,$id=Null){

        switch ($param):
            case 'list':
                try {
                    if ($request->isMethod('get')) {
                        $inputs = $request->all();
                        $searchKey = isset($inputs['search']) && $inputs['search'] != '' ? $inputs['search'] : '';

                        $getDepartment = (new \App\FireDepartment())->getDepartmentList($searchKey)->orderBy('id','desc')->paginate(\Config::get('constants.PAGINATION'));

                        return view('fire_backend.fire.index',compact('getDepartment','searchKey'));
                    }
                    return jsonResponse(false, 500, "Opps! something went wrong, server error.");
                } catch (\Exception $e) {

                    echo $e->getMessage();
                    // something went wrong
                }
                break;

            case 'view':
                try {

                    if ($request->isMethod('get')) {
                        $user = (new \App\FireDepartment())->where('id',$id)->first();
                        return view('fire_backend.fire.view',compact('user'));
                    }
                    return jsonResponse(false, 500, "Opps! something went wrong, server error.");
                } catch (\Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                    // something went wrong
                }
                break;

        endswitch;

    }
}
