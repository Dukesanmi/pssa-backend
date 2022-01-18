<script type="text/javascript">

    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#click_2').click(function(){
            //clearing list on every change
            $("#bell_2").empty();
            let state;

            @if(Auth::guard('department')->check()) // if department is logged in
            state= "<?php echo Auth::guard('department')->user()->state?>";

            @elseif(Auth::guard('member')->check())
            @if(Auth::guard('member')->user()->type=='0')
             state= "<?php echo Auth::guard('member')->user()->state?>";
             @else
             state='';
             @endif
            @else
                state='';
            @endif
            $.ajax({
                url: '{{route("message.notification")}}',
                type: "POST",
                data: { state:state},
                success: function(data){
                    $("#bell_2").empty();
                    var myObj=JSON.parse(data);
                    var html=[];
                    var id;
                    if(myObj.length>0){ // checking if array is empty or not
                        myObj.forEach(function(u) {
                            let department_pic;
                            if (u.department_pic != '' && u.department_pic!=null) {
                                department_pic = u.department_pic
                            } else {
                                department_pic = '{{asset('image/no-profile-pic.png')}}';
                            }
                            let user_pic;
                            if (u.user_pic != '' && u.user_pic!=null) {
                                user_pic = u.user_pic
                            } else {
                                user_pic = '{{asset('image/no-profile-pic.png')}}';
                            }
                            let no_profile_pic ='{{asset('image/no-profile-pic.png')}}';
                            if(u.web_status==0) {

                                if(u.message_type=='User_Message_D')
                                { 
                                    @if(Auth::guard('member')->check())

                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;

                                    @else
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;

                                    @endif
                                    

                                }

                                else if(u.message_type=='User_Message_A_M')
                                {
                                     var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;
                                }

                                else if(u.message_type=='User_Message_D_M')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;
                                }


                                else if(u.message_type=='User_Message_A')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;
                                }



                                else if(u.message_type=='Message-A')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" +department_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {// if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" +no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = department_pic;

                                }



                                else if(u.message_type=='Message-D')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" +department_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {// if image is broken
                                        html = "<a target='_blank' class='unseen'  href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" +no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = department_pic;
                                }
                            }


                            else{

                                if(u.message_type=='User_Message_D')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;

                                }


                                else if(u.message_type=='User_Message_A')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    }
                                    img.src = user_pic;
                                }

                                 else if(u.message_type=='User_Message_A_M')
                                {
                                     var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank'  href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank'   href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;
                                }

                                else if(u.message_type=='User_Message_D_M')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank'   href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + user_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };

                                    img.onerror = function () {  // if image is broken
                                        html = "<a target='_blank'   href='/npf_rescue_admin/member/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = user_pic;
                                }



                                else if(u.message_type=='Message-A')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + department_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.src = department_pic;
                                }



                                else if(u.message_type=='Message-D')
                                {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + department_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    };
                                    img.onerror = function() {
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/"+ u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src='" + no_profile_pic + "'></div> <div class='col-md-9 message_text'>"+ u.message + "</div> </a>"
                                        $("#bell_2").append(html);
                                    }
                                    img.src = department_pic;
                                }
                            }

                        });
                    }else{
                        html='No Notification Found';
                        $("#bell_2").append(html);
                    }

                }

            });
        });
    });

</script>