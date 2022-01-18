<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
 });



// Route::middleware('auth:api')->group( function () {
	

//     Route::get('logout', 'Api\UserController@logout');
  

	
// });



// Route::group([

//       'middleware' => ['api', 'multiauth:app_user']

//     ], function() {
           	Route::any('emergency/contact/list', 'Api\UserController@emergencyContactList');
			Route::post('emergency/contact', 'Api\UserController@emergencyContact');

        	Route::get('logout', 'Api\UserController@logout');

			Route::post('update/emergency/contact', 'Api\UserController@updateEmergencyContact');
			Route::post('detail/emergency/contact', 'Api\UserController@detailEmergencyContact');
			Route::any('emergency/contact/list', 'Api\UserController@emergencyContactList');
            Route::any('emergency/alert', 'Api\UserController@emergencyAlert');
			Route::any('delete/emergency/contact', 'Api\UserController@deleteEmergencyContact');
			Route::any('test', 'Api\UserController@test');

			Route::any('report/crime', 'Api\UserController@reportCrime');
			Route::any('report/police', 'Api\UserController@reportPolice');
			Route::any('request/ambulance', 'Api\UserController@requestAmbulance');
			Route::any('logout','Api\UserController@logout');
			Route::any('state','Api\UserController@state');


			// register

			Route::any('register', 'Api\UserController@register');
            Route::any('alert/detail','Api\PoliceController@alertDetail');

			// police officer api

			Route::any('todo','Api\PoliceController@todoList');
			Route::any('accept/request','Api\PoliceController@acceptRequest');
			Route::any('reject/request','Api\PoliceController@rejectRequest');

			Route::any('inprogress','Api\PoliceController@inprogressList');
			Route::any('incomplete','Api\PoliceController@incompleteList');
			Route::any('complete','Api\PoliceController@completeList');

			Route::any('incomplete/request','Api\PoliceController@incompleteRequest');
			Route::any('complete/request','Api\PoliceController@completeRequest');

			Route::any('search','Api\UserController@search');
			Route::any('notification','Api\PoliceController@notification');
			Route::any('count/notifications','Api\PoliceController@getCountNotifications');

			Route::any('contact', 'Api\UserController@contactUs');
			Route::any('emergency/numbers','Api\UserController@emergencyNumbers');


			/**
			@Chat Message routes
			 */
			Route::any('list/chat/messages', 'Api\ConversationController@listChatMessages');
			Route::any('send/chat/message', 'Api\ConversationController@sendChatMessage');
			Route::any('check/new/chat/message', 'Api\ConversationController@checkNewChatMessage');
			Route::any('check/chat/message/status', 'Api\ConversationController@checkChatMessageStatus');
			Route::any('list/home/messages', 'Api\ConversationController@listHomeMessages');

			Route::any('nearby/user/list', 'Api\UserController@nearbyUserList');
			Route::any('update/user/location', 'Api\UserController@UpdateUserLocation');


    // });


Route::any('login', 'Api\UserController@login');
Route::any('forget/password', 'Api\UserController@forgetPassword');
Route::any('change/password', 'Api\UserController@changePassword');
Route::any('resent/otp', 'Api\UserController@resentOtp');
Route::any('otp/verification', 'Api\UserController@otpVerification');


//Dummy routes

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {

        Route::get('user', 'AuthController@user');
    });
});

 