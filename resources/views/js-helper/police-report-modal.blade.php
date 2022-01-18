{{--Notification Modal for Police Report --}}

<div class="report-modal">
    <div class="modal" id="police-report-modal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="police-notification-modal-close">&times;</button>
                    <h4 class="modal-title" id="police-notification-title">NPF-PR2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Police Report Alert</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="police-user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="police-email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Gender: </label>
                            <span id="police-gender">Male</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Mobile Number: </label>
                            <span class='getname' id="police-mobile_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Reason: </label>
                            <span id="police-type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>State: </label>
                            <span class="getname" id="police-state">2-5 Persons</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Date & Time: </label>
                            <span class="getname" id="police-time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="getname" id="police-address">Address</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    //Notification Modal for Crime Report
    Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('police-report-channel');
    channel.bind('police-event-event', function(data) {
        // console.log(data);

        @if(Auth::guard('department')->check()) // if department is logged in
        var loggedindepartstate="<?php echo Auth::guard('department')->user()->state?>";
        if(data.state===loggedindepartstate){ // if emergency state matches with department state notification will be displayed
            $("#police_report_counts").text(parseInt($("#police_report_counts").text())+1);
            // $("#police_report_counts").text(data.counts);
            $('#police-report-modal').addClass('in');
            $("#police-report-modal").show();

            $("#police-notification-title").text(data.unique_code);
            var gender='';
            if (data.gender == 1) {
                gender = 'Other';
            } else if (data.gender == 2) {
                gender = 'Male';
            } else if (data.gender == 3) {
                gender = 'Female';
            }
            //setting modal informatio
            $("#police-user").text(data.name);
            $("#police-email").text(data.email);
            $("#police-gender").text(gender);
            $("#police-mobile_number").text("+234"+data.mobile_number);
            $("#police-type_of_problem").text(data.nature_of_crime);
            $("#police-state").text(data.state);
            $("#police-time").text(data.time);
            $("#police-address").text(data.emergency_location);
            //setting start tracking information
            // $("#id").val(mylocation.id);
            // $("#lat").val(mylocation.latitude);
            // $("#lng").val(mylocation.longitude);
            // $("#type_of_problem").val(mylocation.types_of_problem);
            // setTimeout(function () {
            //     $('#police-report-modal').removeClass('in');
            //     $("#police-report-modal").hide();
            // },5000);
        }else{
            //no notification displayed
        }
        @else // super admin login

        $('#police-report-modal').addClass('in');
        $("#police-report-modal").show();

        $("#police-notification-title").text(data.unique_code);
        var gender='';
        console.log(data.gender);
        if(data.gender==1){
            gender='Other';
        }else if(data.gender==2){
            gender='Male';
        }else if(data.gender==3){
            gender='Female';
        }
        $("#police_report_counts").text(parseInt($("#police_report_counts").text())+1);
        //setting modal information
        //setting modal informatio
        $("#police-user").text(data.name);
        $("#police-email").text(data.email);
        $("#police-gender").text(gender);
        $("#police-mobile_number").text("+234"+data.mobile_number);
        $("#police-type_of_problem").text(data.nature_of_crime);
        $("#police-state").text(data.state);
        $("#police-time").text(data.time);
        $("#police-address").text(data.emergency_location);


        {{--@if(Auth::guard('department')->check())--}}

        {{--$("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");--}}
        {{--@else--}}
        {{--$("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");--}}
        {{--@endif--}}

        // var x = document.getElementById("myAudio");
        //
        //
        // x.play();
        //
        // if (myObj.status == "nok") {
        //     alert("somthing went wrong");
        // } else {
        //     //location.reload();
        // }
        @endif
    });
    $("#police-notification-modal-close").click(function () {
        $("#police-report-modal").removeClass('in');
        $("#police-report-modal").hide();
    });
    //Emergency Alert Notification end
</script>