<style>
    #department-modal .broad_img{width: 150px; margin: 20px auto;}
    #department-modal .username{width:50%; float:left;}
    #department-modal .date_time{width:50%; float:right; text-align:right;}
    #department-modal .broad_message{width:100%;}
    #department-modal .broad_outer{padding:0;}
    #department-modal .modal_btn {
        float: right;
    }
    #department-modal .btn {
        margin: 20px 5px 20px 0px;
        border-radius: 5px;
        float: right;
        background-color: #008751;
        border-color: #008751;
        color: #fff;
    }
</style>
<div class="emergency-modal">
    <div class="modal" id="department-modal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" onclick=" $('#department-modal').removeClass('in'); $('#department-modal').hide();">x</button>
                    <h4 class="modal-title" id="department-title">NPF-EC2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Emergency Alert</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="department-user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="department-email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Gender: </label>
                            <span id="department-gender">Male</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Mobile Number: </label>
                            <span class='getname' id="department-mobile_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Type of Problem: </label>
                            <span id="department-type_of_problem">Assault Robbery</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Person Count: </label>
                            <span class="getname" id="department-person_count">2-5 Persons</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Date & Time: </label>
                            <span class="getname" id="department-time">2019-06-11 09:56:44</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Address: </label>
                            <span class="" id="department-address">Address</span>
                        </div>
                        <div class="col-md-12">
                            <label>Message: </label>
                            <span id="department-message">This Emergency Has Been Assigned To Your Department.</span>
                        </div>
                        <div class="col-md-12 modal_btn" >
                            <a href="" class='btn btn-default' id="department-assign-officer" target="_blank">Assign Officer</a>
                            <form id="department-notification-form" target="_blank" action="{{route('show.emergency.location')}}">
                                <input type="hidden" name="id" id="department_id" value="">
                                <input type="hidden" name="lat" id="department_lat" value="">
                                <input type="hidden" name="lng" id="department_lng" value="">
                                <input type="hidden" name="type_of_problem" id="department_type_of_problem" value="">
                                <button type='submit' class="btn btn-default">Start Tracking</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('department-channel');
    channel.bind('department-event', function(data) {
        $("#emergency_counts").text(parseInt($("#emergency_counts").text())+1);
        var state="{{Auth::guard('department')->check()?Auth::guard('department')->user()->state:''}}";
        var id="{{Auth::guard('department')->user()->id}}";
        if(data.state.localeCompare(state)==0 && data.id==id){
            $('#department-modal').addClass('in');
            $("#department-modal").show();
            let name=data.detail.name?data.detail.name:data.detail.md_name;
            let email=data.detail.email?data.detail.email:data.detail.md_email;
            let mobile_number=data.detail.mobile_number?data.detail.mobile_number:data.detail.md_number;
            $("#department-user").text(name);
            $("#department-email").text(email);
            let gender;
            if(data.detail.gender=='1'){
                gender ='Other';
            }else if(data.detail.gender=='2'){
                gender='Male';
            }else if(data.detail.gender=='3'){
                gender='Female';
            }else{
                gender=data.detail.md_gender;
            }
            $("#department-assign-officer").attr('href','Check');
            $("#department-assign-officer").attr("href", "{{route('alert.change_officer')}}"+ "/" + data.detail.id + "");
            $("#department_id").val(data.detail.id);
            $("#department-title").text(data.detail.unique_code);
            $("#department_lat").val(data.detail.latitude);
            $("#department_lng").val(data.detail.longitude);
            $("#department_type_of_problem").val(data.detail.types_of_problem);
            $("#department-message").text('This emergency has been assigned to your department.');
            $("#department-gender").text(gender);
            $("#department-mobile_number").text(mobile_number);
            $("#department-type_of_problem").text(data.detail.types_of_problem);
            $("#department-person_count").text(data.detail.person_count);
            // $("#time").text();
            // $("#department_message").text('Emergency Assigned To Your Department');
            $("#department-time").text(data.detail.time);
            $("#department-address").text(data.detail.emergency_address);
            $(".close-modal").click(function () {
                $('#department-modal').removeClass('in');
                $("#department-modal").hide();
            });
        }
    });
</script>
