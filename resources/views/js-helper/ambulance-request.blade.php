{{--Notification Modal for Ammbulance request --}}

<div class="report-modal">
    <div class="modal" id="ambulance-request-modal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="ambulance-notification-modal-close">&times;</button>
                    <h4 class="modal-title" id="ambulance-notification-title">NPF-EC2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Ambulance Request</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="ambulance-user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="ambulance-email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Gender: </label>
                            <span id="ambulance-gender">Male</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Mobile Number: </label>
                            <span class='getname' id="ambulance-mobile_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Nature Of Incident: </label>
                            <span id="ambulance-type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>State: </label>
                            <span class="getname" id="ambulance-state">2-5 Persons</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Date & Time: </label>
                            <span class="getname" id="ambulance-time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="getname" id="ambulance-address">Address</span>
                        </div>
                        <div class="col-md-12 modal_btn" >
                            
                         
                            <!-- <form id="notification-form" target="_blank" action="{{url('npf_rescue_admin/member/show/emergency/location')}}"> -->

                                @if(Auth::guard('department')->check())
                                    <form id="notification-form" target="_blank" action="{{route('show.ambulance.location.department')}}">

                                     @elseif(Auth::guard('member')->check())   

                                     <form id="notification-form" target="_blank" action="{{route('show.ambulance.location.member')}}">
                                @else
                        <form id="notification-form" target="_blank" action="{{route('show.ambulance.location')}}">

                            @endif
                             
                        
                           
                                <input type="hidden" name="id" id="user_id" value="">
                                <input type="hidden" name="lat" id="user_lat" value="">
                                <input type="hidden" name="lng" id="user_lng" value="">
                                <!-- <input type="hidden" name="type_of_problem" id="type_of_problem" value=""> -->
                                <button type='submit' class="btn btn-default">Start Tracking</button>
                            </form>


                             <a id="ambulance_id" class="btn btn-default">View</a>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<audio controls calss="audio" style="display:none">
    <source src="{{asset('ambulance_siren.mp3')}}">
</audio>
<script>
    //Notification Modal for Crime Report
    // Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('ambulance-request-channel');
    channel.bind('ambulance-request-event', function(data) {

        @if(Auth::guard('department')->check()) 
        // if department is logged in

        // alert(data.state);

        var loggedindepartstate="<?php echo Auth::guard('department')->user()->state?>";

        // alert(loggedindepartstate);
        if(data.state===loggedindepartstate){ // if emergency state matches with department state notification will be displayed
            $("#ambulance_request_count").text(data.count);

            $('#ambulance-request-modal').addClass('in');
            $("#ambulance-request-modal").show();

            $("#ambulance-notification-title").text(data.unique_code);
            //setting modal information
            $("#ambulance-user").text(data.name);
            $("#ambulance-email").text(data.email);
            $("#ambulance-gender").text(data.gender);
            $("#ambulance-mobile_number").text('+234'+data.mobile_number);
            $("#ambulance-type_of_problem").text(data.nature_of_crime);
            $("#ambulance-state").text(data.state);
             $("#user_id").val(data.id);
             $("#user_lat").val(data.latitude);
             $("#user_lng").val(data.longitude);
            $("#ambulance-time").text(data.time);
            $("#ambulance-address").text(data.emergency_location);
            $("#ambulance_id").attr('href','https://www.npfc4i.com/npf_rescue_admin/department_auth/ambulance/show/'+data.id+'');
            //setting start tracking information
            // $("#id").val(mylocation.id);
            // $("#lat").val(mylocation.latitude);
            // $("#lng").val(mylocation.longitude);
            // $("#type_of_problem").val(mylocation.types_of_problem);

        }else{
            //no notification displayed
        }
        @elseif(Auth::guard('fire')->check())
        $("#ambulance_request_count").text(data.count);
        $('#ambulance-request-modal').addClass('in');
        $("#ambulance-request-modal").show();

        $("#ambulance-notification-title").text(data.unique_code);
        //setting modal informatio
        $("#ambulance-user").text(data.name);
        $("#ambulance-email").text(data.email);
        $("#ambulance-gender").text(data.gender);
        $("#user_id").val(data.id);
        $("#user_lat").val(data.latitude);
        $("#user_lng").val(data.longitude);
        $("#ambulance-mobile_number").text('+234'+data.mobile_number);
        $("#ambulance-type_of_problem").text(data.nature_of_crime);
        $("#ambulance-state").text(data.state);
        $("#ambulance-time").text(data.time);
        $("#ambulance-address").text(data.emergency_location);
        $("#ambulance_id").attr('href','https://www.npfc4i.com/npf_rescue_admin/medical_auth/ambulance/'+data.id+'');
        @else // super admin login
console.log(data.latitude);

        $("#ambulance_request_count").text(data.count);
        $('#ambulance-request-modal').addClass('in');
        $("#ambulance-request-modal").show();

        $("#ambulance-notification-title").text(data.unique_code);
        //setting modal informatio
        $("#ambulance-user").text(data.name);
        $("#ambulance-email").text(data.email);
        $("#ambulance-gender").text(data.gender);
        $("#user_id").val(data.id);
        $("#user_lat").val(data.latitude);
        $("#user_lng").val(data.longitude);
        $("#ambulance-mobile_number").text('+234'+data.mobile_number);
        $("#ambulance-type_of_problem").text(data.nature_of_crime);
        $("#ambulance-state").text(data.state);
        $("#ambulance-time").text(data.time);
        $("#ambulance-address").text(data.emergency_location);
        @if(Auth::guard('member')->check())
$("#ambulance_id").attr('href','https://www.npfc4i.com/npf_rescue_admin/member/ambulance/'+data.id+'');
        @else

$("#ambulance_id").attr('href','https://www.npfc4i.com/npf_rescue_admin/medical_auth/ambulance/'+data.id+'');
        @endif
        
        //setting start tracking information
        // $("#id").val(mylocation.id);
        // $("#lat").val(mylocation.latitude);
        // $("#lng").val(mylocation.longitude);
        // $("#type_of_problem").val(mylocation.types_of_problem);



                {{--@if(Auth::guard('department')->check())--}}

                {{--$("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");--}}
                {{--@else--}}
                {{--$("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");--}}
                {{--@endif--}}

        var a = getElementsByClassName("audio");
        a.play();
        setTimeout(function(){var a = getElementsByClassName("audio");


            a.play(); }, 5000);

        if (myObj.status == "nok") {
            alert("somthing went wrong");
        } else {
            //location.reload();
        }
        @endif
    });
    $("#ambulance-notification-modal-close").click(function () {
        $("#ambulance-request-modal").removeClass('in');
        $("#ambulance-request-modal").hide();
    });
    //Ambulance Alert Notification end
</script>