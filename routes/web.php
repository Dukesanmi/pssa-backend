<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::any('get/alertmap/detail','AlertController@alertMapDetail')->name('get.detail.alerts.map');


Route::any('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();
Route::any('member/login','MemberController@loginForm')->name('member.login.form');
Route::any('/member/login/submit','MemberController@login')->name("member.login");


Route::group(['middleware' => 'member'], function() {

Route::get('/member/home', 'MemberController@memberHome')->name('member.home');
Route::resource('/member_alert', 'AlertController');
Route::resource('/member_user', 'UserController');
Route::any('/member/alerts/map', 'AlertController@alertsMap')->name('member.alerts.map');
Route::any('member/broadcast','AlertController@Broadcast')->name('member.broadcast');

});

Route::resource('user', 'UserController');


Route::group(['middleware' => 'auth'], function() {

Route::get('/home', 'HomeController@index')->name('home');
Route::any('user/delete/{user_id}','UserController@destroy')->name('user.delete');
Route::any('/roles/','MemberController@memberIndex')->name('member.index');
Route::any('/roles/create','MemberController@createRole')->name('member.create.role');
Route::any('/roles/edit/{id}','MemberController@EditRole')->name('edit.member.role');
Route::any('start/tracking/{id}','AlertController@StartTracking')->name('start.tracking');
Route::resource('alert', 'AlertController');
Route::resource('crime', 'CrimeReportController');
Route::resource('police', 'PoliceReportController');
//Route::resource('ambulance', 'AmbulanceRequestController');
Route::resource('medical','FireDepartment');

Route::resource('officer', 'PoliceOfficerController');
Route::resource('department', 'DepartmentController');
Route::any('change/officer/edit/{id?}', 'AlertController@changeOfficer')->name('alert.change_officer');
Route::any('change/officer/update/{id?}', 'AlertController@updateOfficer')->name('alert.change_officer_update');
Route::any('alerts/map', 'AlertController@alertsMap')->name('alerts.map');
   
 Route::get('/change/password','HomeController@showChangePasswordForm')->name('change.password');
 Route::post('/user/credentials','HomeController@postCredentials');
 Route::any('broadcast','AlertController@Broadcast')->name('broadcast');
 Route::post("getNotificationAlerts","AlertController@getNotificationData")->name('get.notification.data');
 Route::post('get/chart/details','AlertController@GetChartDetails')->name('get.chart.details');

//responder routes

Route::any('responders','ResponderController@index')->name('responder');
Route::any('create/responder','ResponderController@Create')->name('responder.create');
Route::any('share/location','ResponderController@ShareLocation')->name('share.location');
Route::any('change/emergency/status','ResponderController@ChangeEmergencyStatus')->name('change.emergency.status');
Route::any('edit/responder/{id}','ResponderController@EditResponder')->name('edit.responder');

});

Route::prefix('department_auth')->group(function() {

    Route::get('/change/password','HomeController@showChangePasswordForm')->name('change.password');
    Route::post('/user/credentials','HomeController@postCredentials')->name('post.change.password');

    Route::post('/login', 'DepartmentAuth\DepartmentLoginController@login')->name('department.login.submit');
    Route::get('/login', 'DepartmentAuth\DepartmentLoginController@showLoginForm')->name('department.login');
    
    Route::group(['middleware' => ['police_department']], function() {

        Route::any('change/officer/edit/{id?}', 'AlertController@changeOfficer')->name('alert.change_officer');
Route::any('change/officer/update/{id?}', 'AlertController@updateOfficer')->name('alert.change_officer_update');
  
      Route::resource('alert', 'AlertController');
    Route::resource('crime', 'CrimeReportController');
    Route::resource('police', 'PoliceReportController');
    Route::resource('officer', 'PoliceOfficerController');
   

    Route::get('/home', 'DepartmentAuthController@index')->name('department.home');
    Route::any('/logout','DepartmentAuth\DepartmentLoginController@logout')->name('department.logout');
    Route::any('/users/{param?}/{id?}','DepartmentAuthController@viewUsers')->name('department.users');
    Route::any('/department/{param?}/{id?}','DepartmentAuthController@viewDepartment')->name('department.department.users');
    Route::resource('officer', 'PoliceOfficerController');
});
});

//fire_department login routes

Route::prefix('medical_auth')->group(function() {

    Route::get('/login', 'FireDepartmentAuth\FireDepartmentLoginController@showLoginForm')->name('fire.login');
    Route::post('/login', 'FireDepartmentAuth\FireDepartmentLoginController@login')->name('fire.login.submit');
        Route::group(['middleware' => ['medical']], function() {

    Route::resource('ambulance', 'AmbulanceRequestController');
    Route::get('/home', 'FireDepartmentAuthController@index')->name('fire.home');
    Route::any('/logout','FireDepartmentAuth\FireDepartmentLoginController@logout')->name('fire.logout');
    Route::any('/users/{param?}/{id?}','FireDepartmentAuthController@viewUsers')->name('fire.users');
    Route::any('/medical_depart/{param?}/{id?}','FireDepartmentAuthController@viewDepartment')->name('fire.department.users');

});
});

Route::any('download-emergency/{id}',function (Request $request,$id){

    ini_set('max_execution_time', '800');
    $emergencyAlert = (new App\EmergencyAlert())->getEmergencyAlertUser($id)->first();
    $getEmergencyAlertFiles = DB::table('emergency_alert_files')->where(['em_alert_id'=>$emergencyAlert->ea_id])->get();
    view()->share(compact('emergencyAlert','getEmergencyAlertFiles'));
    PDF::setOptions(['dpi' => 150, 'isRemoteEnabled'=>true]);
    // pass view file
    $pdf = PDF::loadView('alertpdf');
    $filename=$emergencyAlert->unique_code . '.' . 'pdf';
    
    return $pdf->download($filename);

})->name('download-emergency-pdf');


