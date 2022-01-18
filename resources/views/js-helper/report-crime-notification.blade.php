{{--Notification Modal for Crime Report --}}

<div class="crime-modal">
    <div class="modal" id="crime-report-modal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="crime-notification-modal-close">&times;</button>
                    <h4 class="modal-title" id="crime-notification-title">NPF-EC2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Report Crime Alert</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="crime-user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="crime-email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Gender: </label>
                            <span id="crime-gender">Male</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Mobile Number: </label>
                            <span class='getname' id="crime-mobile_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Nature Of Crime: </label>
                            <span id="crime-type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>State: </label>
                            <span class="getname" id="crime-state">2-5 Persons</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Time & Date: </label>
                            <span class="getname" id="crime-time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="getname" id="crime-address">Address</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    //Notification Modal for Crime Report
    // Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('crime-report-channel');
    channel.bind('crime-event-event', function(data) {


        @if(Auth::guard('department')->check()) // if department is logged in
        var loggedindepartstate="<?php echo Auth::guard('department')->user()->state?>";
        if(data.state===loggedindepartstate){ // if emergency state matches with department state notification will be displayed
            $("#crime_report_counts").text(parseInt($("#crime_report_counts").text())+1);

            $('#crime-report-modal').addClass('in');
            $("#crime-report-modal").show();

            $("#crime-notification-title").text(data.unique_code);
            var gender='';
            console.log(data.gender);
            if(data.gender==1){
                gender='Other';
            }else if(data.gender==2){
                gender='Male';
            }else if(data.gender==3){
                gender='Female';
            }
            //setting modal information
            $("#crime-user").text(data.name);
            $("#crime-email").text(data.email);
            $("#crime-gender").text(gender);
            $("#crime-mobile_number").text("+234"+data.mobile_number);
            $("#crime-type_of_problem").text(data.nature_of_crime);
            $("#crime-state").text(data.state);
            $("#crime-time").text(data.time);
            $("#crime-address").text(data.emergency_location);
            //setting start tracking information
            // $("#id").val(mylocation.id);
            // $("#lat").val(mylocation.latitude);
            // $("#lng").val(mylocation.longitude);
            // $("#type_of_problem").val(mylocation.types_of_problem);

        }else{
            //no notification displayed
        }
        @else // super admin login
        $("#crime_report_counts").text(parseInt($("#crime_report_counts").text())+1);
        $('#crime-report-modal').addClass('in');
        $("#crime-report-modal").show();

        $("#crime-notification-title").text(data.unique_code);
        var gender='';
        console.log(data.gender);
        if(data.gender==1){
            gender='Other';
        }else if(data.gender==2){
            gender='Male';
        }else if(data.gender==3){
            gender='Female';
        }
        //setting modal information
        $("#crime-user").text(data.name);
        $("#crime-email").text(data.email);
        $("#crime-gender").text(gender);
        $("#crime-mobile_number").text("+234"+data.mobile_number);
        $("#crime-type_of_problem").text(data.nature_of_crime);
        $("#crime-state").text(data.state);
        $("#crime-time").text(data.time);
        $("#crime-address").text(data.emergency_location);

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
    $("#crime-notification-modal-close").click(function () {
        $("#crime-report-modal").removeClass('in');
        $("#crime-report-modal").hide();
    });
    //Emergency Alert Notification end
</script>