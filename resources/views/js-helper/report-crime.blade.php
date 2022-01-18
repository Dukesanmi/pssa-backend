
<div class="emergency-modal">
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="notification-modal-close">&times;</button>
                    <h4 class="modal-title" id="notification-title">NPF-EC2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Emergency Alert</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Gender: </label>
                            <span id="gender">Male</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Mobile Number: </label>
                            <span class='getname' id="mobile_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Type of Problem: </label>
                            <span id="type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Person Count: </label>
                            <span class="getname" id="person_count">2-5 Persons</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Time & Date: </label>
                            <span class="getname" id="time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="getname" id="address">Address</span>
                        </div>
                        <div class="col-md-12 modal_btn" >
                            <a href="" class='btn btn-default' id="assign-officer">Assign Officer</a>
                            <form id="notification-form" target="_blank" action="{{route('show.emergency.location')}}">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="lat" id="lat" value="">
                                <input type="hidden" name="lng" id="lng" value="">
                                <input type="hidden" name="type_of_problem" id="type_of_problem" value="">
                                <button type='submit' class="btn btn-default">Start Tracking</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<audio controls id="myAudio" style="display: none">
    <source src="{{asset('tspt_danger_alarm_loop_024.mp3')}}">
</audio>
<script>
    //Emergency Alert Notification start
    // Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        getEmergency(data.emergency_id,data.state);
    });
    function getEmergency(id,state) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });
        $.ajax({
            type: "POST",
            url: '{{route("get.notification.data")}}',
            data: {'id': id},
            success: function (data) {
                @if(Auth::guard('department')->check()) // if department is logged in
                var loggedindepartstate="<?php echo Auth::guard('department')->user()->state?>";
                if(state===loggedindepartstate){ // if emergency state matches with department state notification will be displayed
                    var department='';

                    var myObj = JSON.parse(data);
                    var mylocation = [];
                    //console.log(data);
                    mylocation = myObj;
                    // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                    // window.open(redirectLink);

                    $('#myModal').addClass('in');
                    $("#myModal").show();

                    $("#notification-title").text(mylocation.unique_code);
                    var gender='';
                    if(mylocation.gender==0){
                        gender='Other';
                    }else if(mylocation.gender==1){
                        gender='Female';
                    }else if(mylocation.gender==2){
                        gender='Male';
                    }
                    //setting modal information
                    $("#user").text(mylocation.name+' '+ mylocation.surname);
                    $("#email").text(mylocation.email);
                    $("#gender").text(gender);
                    $("#mobile_number").text(mylocation.mobile_number);
                    $("#type_of_problem").text(mylocation.types_of_problem);
                    $("#person_count").text(mylocation.person_count);
                    $("#time").text(mylocation.created_at);
                    $("#address").text(mylocation.address);
                    //setting start tracking information
                    $("#id").val(mylocation.id);
                    $("#lat").val(mylocation.latitude);
                    $("#lng").val(mylocation.longitude);
                    $("#type_of_problem").val(mylocation.types_of_problem);

                    @if(Auth::guard('department')->check())

                    $("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");
                    @else
                    $("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");
                            @endif

                    var x = document.getElementById("myAudio");


                    x.play();

                    if (myObj.status == "nok") {
                        alert("somthing went wrong");
                    } else {
                        //location.reload();
                    }
                }else{
                    //no notification displayed
                }
                @else // super admin login
                var department='';

                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation = myObj;
                // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                // window.open(redirectLink);

                $('#myModal').addClass('in');
                $("#myModal").show();

                $("#notification-title").text(mylocation.unique_code);
                var gender='';
                if(mylocation.gender==0){
                    gender='Other';
                }else if(mylocation.gender==1){
                    gender='Female';
                }else if(mylocation.gender==2){
                    gender='Male';
                }
                //setting modal information
                $("#user").text(mylocation.name+' '+ mylocation.surname);
                $("#email").text(mylocation.email);
                $("#gender").text(gender);
                $("#mobile_number").text(mylocation.mobile_number);
                $("#type_of_problem").text(mylocation.types_of_problem);
                $("#person_count").text(mylocation.person_count);
                $("#time").text(mylocation.created_at);
                $("#address").text(mylocation.address);

                //setting start tracking information
                $("#id").val(mylocation.id);
                $("#lat").val(mylocation.latitude);
                $("#lng").val(mylocation.longitude);
                $("#type_of_problem").val(mylocation.types_of_problem);

                @if(Auth::guard('department')->check())

                $("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");
                @else
                $("#assign-officer").attr("href","{{route('alert.change_officer')}}"+"/"+mylocation.id+"");
                        @endif

                var x = document.getElementById("myAudio");


                x.play();

                if (myObj.status == "nok") {
                    alert("somthing went wrong");
                } else {
                    //location.reload();
                }
                setTimeout(function () {
                    $('#myModal').removeClass('in');
                    $("#myModal").hide();
                },5000);
                @endif
            }
        });
    }
    $("#notification-modal-close").click(function () {
        $("#myModal").removeClass('in');
        $("#myModal").hide();
    });
    //Emergency Alert Notification end
</script>