






<script src="https://js.pusher.com/4.
4/pusher.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
 
<div class="emergency-modal">
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            
            <?php 
            
            $count=0;

            ?>
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
                            <label>Date & Time: </label>
                            <span class="getname" id="time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="getname" id="address">Address</span>
                        </div>
                        <div class="col-md-12 modal_btn" >
                            <a  class='btn btn-default' id="tracking" target="_blank">Start Tracking</a>
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
    Pusher.logToConsole = true;

    var pusher = new Pusher('538f386d26d6c1d62c8b', {
        cluster: 'ap2',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel-production');
    channel.bind('my-event-production', function(data) {
        getEmergency(data.emergency_id,data.state,data.emergency_counts);
    });
    function getEmergency(id,state,counts) {
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
                $("#emergency_counts").text(parseInt($("#emergency_counts").text())+1);
                @if(Auth::guard('department')->check()) // if department is logged in
                var loggedindepartstate = "<?php echo Auth::guard('department')->user()->state?>";
                if (state === loggedindepartstate || state.includes(loggedindepartstate)) { // if emergency state matches with department state notification will be displayed
                    var department = '';

                    // $("#emergency_counts").text(counts);
                    var myObj = JSON.parse(data);
                    var mylocation = [];
                    //console.log(data);
                    mylocation = myObj;
                    var gender = '';

                    if (mylocation.gender == 1) {
                        gender = 'Other';
                    } else if (mylocation.gender == 2) {
                        gender = 'Male';
                    } else if (mylocation.gender == 3) {
                        gender = 'Female';
                    }
                    let name=mylocation.name?mylocation.name + ' ' + mylocation.surname:mylocation.md_name;
                    let email=mylocation.email?mylocation.email:mylocation.md_email;
                    let checkgender=gender?gender:mylocation.md_gender;
                    let mobile_number=mylocation.mobile_number?mylocation.country_code+mylocation.mobile_number:mylocation.md_number;
                    let address=mylocation.em_address;
                    //setting modal information
                    $("#user").text(name);
                    $("#email").text(email);
                    $("#gender").text(checkgender);
                    $("#mobile_number").text(mobile_number);
                    $("#type_of_problem").text(mylocation.types_of_problem);
                    $("#person_count").text(mylocation.person_count);
                    $("#time").text(mylocation.nigeria_time);
                    $("#address").text(address);
                    //setting start tracking information
                    $("#id").val(mylocation.id);
                    $("#lat").val(mylocation.latitude);
                    $("#lng").val(mylocation.longitude);
                    $("#type_of_problem").val(mylocation.types_of_problem);
                    // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                    // window.open(redirectLink);

                    $('#myModal').addClass('in');
                    $("#myModal").show();

                    $("#notification-title").text(mylocation.unique_code);

                    @if(Auth::guard('department')->check())

                    $("#assign-officer").attr("href", "{{route('alert.change_officer')}}" + "/" + mylocation.id + "");

                    @else
                    $("#assign-officer").attr("href", "{{route('alert.change_officer')}}" + "/" + mylocation.id + "");
                            @endif

                    var x = document.getElementById("myAudio");


                    x.play();
                    // setTimeout(function(){var x = document.getElementById("myAudio");


                    //     x.play(); }, 5000);
                    var audio = new Audio("{{asset('tspt_danger_alarm_loop_024.mp3')}}");
                    audio.play();

                    if (myObj.status == "nok") {
                        alert("somthing went wrong");
                    } else {
                        //location.reload();
                    }

                } else {
                    //no notification displayed
                }

                @elseif(Auth::guard('member')->check())

                @if(Auth::guard('member')->user()->type=='1') // if member is loged in from super admin
                  var department = '';
                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation = myObj;

                // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                // window.open(redirectLink);

                $('#myModal').addClass('in');
                $("#myModal").show();
                console.log(mylocation.gender);
                $("#notification-title").text(mylocation.unique_code);
                var gender = '';

                if (mylocation.gender == 1) {
                    gender = 'Other';
                } else if (mylocation.gender == 2) {
                    gender = 'Male';
                } else if (mylocation.gender == 3) {
                    gender = 'Female';
                }
                let name=mylocation.name?mylocation.name + ' ' + mylocation.surname:mylocation.md_name;
                let email=mylocation.email?mylocation.email:mylocation.md_email;
                let checkgender=gender?gender:mylocation.md_gender;
                let mobile_number=mylocation.mobile_number?mylocation.country_code+mylocation.mobile_number:mylocation.md_number;
                // let address=mylocation.landmark?mylocation.landmark:mylocation.address;
                 let address=mylocation.em_address;
                //setting modal information
                $("#user").text(name);
                $("#email").text(email);
                $("#gender").text(checkgender);
                $("#mobile_number").text(mobile_number);
                $("#type_of_problem").text(mylocation.types_of_problem);
                $("#person_count").text(mylocation.person_count);
                $("#time").text(mylocation.nigeria_time);
                $("#address").text(address);

                //setting start tracking information
                $("#id").val(mylocation.id);
                $("#lat").val(mylocation.latitude);
                $("#lng").val(mylocation.longitude);
                $("#type_of_problem").val(mylocation.types_of_problem);

               
                var x = document.getElementById("myAudio");

                x.play();
                setTimeout(function(){var x = document.getElementById("myAudio");


                    x.play(); }, 5000);
                var audio = new Audio("{{asset('tspt_danger_alarm_loop_024.mp3')}}");
                audio.play();
                if (myObj.status == "nok") {
                    alert("something went wrong");
                } else {
                    //location.reload();
                }
                @else //if member is loged in of deparment
                var loggedinmemberstate = "<?php echo Auth::guard('member')->user()->state?>";
                if (state === loggedinmemberstate)
                {
                  var department = '';

                    // $("#emergency_counts").text(counts);
                    var myObj = JSON.parse(data);
                    var mylocation = [];
                    //console.log(data);
                    mylocation = myObj;
                    var gender = '';

                    if (mylocation.gender == 1) {
                        gender = 'Other';
                    } else if (mylocation.gender == 2) {
                        gender = 'Male';
                    } else if (mylocation.gender == 3) {
                        gender = 'Female';
                    }
                    let name=mylocation.name?mylocation.name + ' ' + mylocation.surname:mylocation.md_name;
                    let email=mylocation.email?mylocation.email:mylocation.md_email;
                    let checkgender=gender?gender:mylocation.md_gender;
                    let mobile_number=mylocation.mobile_number?mylocation.country_code+mylocation.mobile_number:mylocation.md_number;
                      let address=mylocation.em_address;
                    //setting modal information
                    $("#user").text(name);
                    $("#email").text(email);
                    $("#gender").text(checkgender);
                    $("#mobile_number").text(mobile_number);
                    $("#type_of_problem").text(mylocation.types_of_problem);
                    $("#person_count").text(mylocation.person_count);
                    $("#time").text(mylocation.nigeria_time);
                    $("#address").text(address);
                    //setting start tracking information
                    $("#id").val(mylocation.id);
                    $("#lat").val(mylocation.latitude);
                    $("#lng").val(mylocation.longitude);
                    $("#type_of_problem").val(mylocation.types_of_problem);
                    // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                    // window.open(redirectLink);

                    $('#myModal').addClass('in');
                    $("#myModal").show();

                    $("#notification-title").text(mylocation.unique_code);

                    

                    var x = document.getElementById("myAudio");


                    x.play();
                    // setTimeout(function(){var x = document.getElementById("myAudio");


                    //     x.play(); }, 5000);
                    var audio = new Audio("{{asset('tspt_danger_alarm_loop_024.mp3')}}");
                    audio.play();

                    if (myObj.status == "nok") {
                        alert("somthing went wrong");
                    } else {
                        //location.reload();
                    }
                }
                else
                {
                    //no notification
                }
                @endif

                @else // super admin login
                var department = '';
                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation = myObj;

                // var redirectLink="show/emergency/location?id="+mylocation.id+"&lat="+mylocation.latitude+"&lng="+mylocation.longitude+"&type_of_problem="+mylocation.types_of_problem+"";
                // window.open(redirectLink);

                $('#myModal').addClass('in');
                $("#myModal").show();
                console.log(mylocation.gender);
                $("#notification-title").text(mylocation.unique_code);
                var gender = '';

                if (mylocation.gender == 1) {
                    gender = 'Other';
                } else if (mylocation.gender == 2) {
                    gender = 'Male';
                } else if (mylocation.gender == 3) {
                    gender = 'Female';
                }
                let name=mylocation.name?mylocation.name + ' ' + mylocation.surname:mylocation.md_name;
                let email=mylocation.email?mylocation.email:mylocation.md_email;
                let checkgender=gender?gender:mylocation.md_gender;
                let mobile_number=mylocation.mobile_number?mylocation.country_code+mylocation.mobile_number:mylocation.md_number;
                // let address=mylocation.landmark?mylocation.landmark:mylocation.address;
                 let address=mylocation.em_address;
                //setting modal information
                $("#user").text(name);
                $("#email").text(email);
                $("#gender").text(checkgender);
                $("#mobile_number").text(mobile_number);
                $("#type_of_problem").text(mylocation.types_of_problem);
                $("#person_count").text(mylocation.person_count);
                $("#time").text(mylocation.nigeria_time);
                $("#address").text(address);
                let route = `http://3.22.213.254/pssa-backend/public/index.php/start/tracking/${mylocation.id}`
                $("#tracking").attr('href',route);
                //setting start tracking information
                $("#id").val(mylocation.id);
                $("#lat").val(mylocation.latitude);
                $("#lng").val(mylocation.longitude);
                $("#type_of_problem").val(mylocation.types_of_problem);

               
                var x = document.getElementById("myAudio");

                x.play();
                setTimeout(function(){var x = document.getElementById("myAudio");


                    x.play(); }, 5000);
                var audio = new Audio("{{asset('tspt_danger_alarm_loop_024.mp3')}}");
                audio.play();
                if (myObj.status == "nok") {
                    alert("something went wrong");
                } else {
                    //location.reload();
                }

                @endif
            }
        });
    }
    $("#notification-modal-close").click(function () {
        @if(Auth::guard('department')->check())
        location.reload(true);
        @endif
        $("#myModal").removeClass('in');
        $("#myModal").hide();
    });
    //Emergency Alert Notification end
</script>

