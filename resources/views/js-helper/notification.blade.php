<html>
<head>
    <link rel="manifest" href="{{asset('manifest.json')}}">
    {{--<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>--}}
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    {{ csrf_field() }}
    <style>


    </style>
</head>
<body>
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
                            <label>Type Of Problem: </label>
                            <span id="type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Person Count: </label>
                            <span class="getname" id="person_count">2-5 Persons</span>

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
    <audio controls id="myAudio" style="display: none">
        <source src="{{asset('tspt_danger_alarm_loop_024.mp3')}}">
    </audio>
<input type="button" id="play" style="display: none;">
</body>
<script>
    // Initialize Firebase
    // var config = {
    //     apiKey: "AIzaSyCsVMTiu8OIYtMegT4j5nGJSVeQtnpIaig",
    //     authDomain: "laravel-56729.firebaseapp.com",
    //     databaseURL: "https://laravel-56729.firebaseio.com",
    //     projectId: "laravel-56729",
    //     storageBucket: "laravel-56729.appspot.com",
    //     messagingSenderId: "498513874987"
    // };
    var firebaseConfig = {
        apiKey: "AIzaSyD56C_y2Hu4PPTyhS-xAOSAe6Q9Sca3i5k",
        authDomain: "npf-web.firebaseapp.com",
        databaseURL: "https://npf-web.firebaseio.com",
        projectId: "npf-web",
        storageBucket: "npf-web.appspot.com",
        messagingSenderId: "733987914214",
        appId: "1:733987914214:web:df129825fd397759"
    };
    var defaultApp= firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();
    // messaging.usePublicVapidKey("BBgq23YjVz-5C7Z2hrfDQ2v0LE7gJOxF7jfPhKNCDKmtTdexBnyMsPQ52CbhY2Phe1sUwkGabr6FmHKcljn6bA0");
         messaging.usePublicVapidKey("BLUq9252ohPY-4rvGCX_1gxv6FD_oP5BGwV9uAYchsVaNyygYUdEaoSVgXAIhmvM2_edcaZBQ8QIDli1ff3lDKY");

    messaging.requestPermission().then(function(){
        if(setTokenSentToServer) {
            messaging.getToken().then(function (currentToken) {
                if (currentToken) {
                    sendTokenToServer(currentToken);
                    setTokenSentToServer(true);
                } else {
                    console.log('No Instance ID token available. Request permission to generate one.');
                    updateUIForPushPermissionRequired();
                    setTokenSentToServer(false);
                }
            });
        }
        else{
            getRegToken();
        }
    }).catch(function(err){
        console.log("Error Occured");
    })

    function getRegToken(){
        messaging.getToken().then(function(currentToken){
            if (currentToken) {
                sendTokenToServer(currentToken);
                // console.log(currentToken);

                setTokenSentToServer(true);
            }else{
                console.log('No Instance ID token available. Request permission to generate one.');
                updateUIForPushPermissionRequired();
                setTokenSentToServer(false);
            }
        });
        messaging.onTokenRefresh(function() {
            messaging.getToken().then(function(refreshedToken) {
                console.log('Token refreshed.');});
            console.log(refreshedToken);
        });
    }

    messaging.onMessage(function(payload){
        console.log("onMessage",payload);
        getEmergency(payload.data.emergency_id);

        notificationTitle=payload.data.title;
        notificationOptions={body: payload.data.body,
            icon:payload.data.icon};
        var notification= new Notification(notificationTitle,notificationOptions);
    });

    function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    }

    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') === '1';
    }

    function sendTokenToServer(currentToken){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });
        jQuery.ajax({
            url:"{{route('action.notification')}}",
            method:"post",
            data: {"token":currentToken},
            success:function(result,data){
                // console.log(result+data);
            }
        });
    }
    function getEmergency(id) {
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

                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation = myObj;
                $('#myModal').addClass('in');
                $("#myModal").show();

                $("#notification-title").text(mylocation.unique_code);
                var gender='';
                if(mylocation.gender==0){
                    gender='Other';
                }else if(mylocation.gender==1){
                    gender='Male';
                }else if(mylocation.gender==2){
                    gender='Female';
                }
                //setting modal information
                $("#user").text(mylocation.name);
                $("#email").text(mylocation.email);
                $("#gender").text(gender);
                $("#mobile_number").text(mylocation.mobile_number);
                $("#type_of_problem").text(mylocation.types_of_problem);
                $("#person_count").text(mylocation.person_count);

                //setting start tracking information
                $("#id").val(mylocation.id);
                $("#lat").val(mylocation.latitude);
                $("#lng").val(mylocation.longitude);
                $("#type_of_problem").val(mylocation.types_of_problem);
                @if(Auth::guard('department')->check())
                $("#assign-officer").attr("href","change/officer/edit/"+mylocation.id+"");
                @else
                $("#assign-officer").attr("href","department_auth/change/officer/edit/"+mylocation.id+"");
                @endif

                var x = document.getElementById("myAudio");


                    x.play();

                if (myObj.status == "nok") {
                    alert("somthing went wrong");
                } else {
                    //location.reload();
                }
            }
        });
    }
    $("#notification-modal-close").click(function () {
       $("#myModal").removeClass('in');
        $("#myModal").hide();
    });
</script>
</html>

