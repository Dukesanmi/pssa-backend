
<script type="text/javascript">

    $(document).ready(function() {

        var a=0;


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#click').click(function(){

            //clearing list on every change
            $("#bell").empty();
            let state;

            @if(Auth::guard('department')->check()) // if department is logged in
            state= "<?php echo Auth::guard('department')->user()->state?>";

            @elseif(Auth::guard('member')->check())

            @if(Auth::guard('member')->user()->type=='1')
                state='';
            @else
             state= "<?php echo Auth::guard('member')->user()->state?>";

             @endif
            @else
                state='';
            @endif
            $.ajax({
                url: '{{route("bell.notification")}}',
                type: "POST",
                data: { state:state},
                success: function(data){
                    $("#bell").empty();
                    var myObj=JSON.parse(data);

                    var html=[];
                    var id;
                    if(myObj.length>0){
                        myObj.forEach(function(u) {

                            var id = u.request_id;
                            let department_pic;
                            if (u.department_pic != '') {
                                department_pic = u.department_pic
                            } else {
                                department_pic = '{{asset('image/no-profile-pic.png')}}';
                            }
                            let user_pic;
                            if (u.user_pic != '') {
                                user_pic = u.user_pic
                            } else {
                                user_pic = '{{asset('image/no-profile-pic.png')}}';
                            }

                            // var aestTime = new Date().toLocaleString(myvar, {myvar: " Africa/Lagos"});
                            //     aestTime = new Date(aestTime);

                            if (u.web_status == 1) {
                                if (u.message_type == "admin_password_notification") {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src=" + department_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small></div></a>";
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { // if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = department_pic;

                                }
                                else {
                                    @if(Auth::guard('member')->check())
                                         var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @else 
                                    var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @endif
                                    


                                }
                            } else {
                                if (u.message_type == "admin_password_notification") {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a  target='_blank'  class='unseen' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src=" + department_pic + "></div> <div class='col-md-9 notificat_text'><p>" + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small> </div></a>";
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a  target='_blank'  class='unseen' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p>" + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small> </div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = department_pic;


                                }
                                else {
                                     @if(Auth::guard('member')->check())
                                         var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' class='unseen' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @else 
                                    var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' class='unseen' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' class='unseen' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @endif

                                }
                            }
                        });
                    }else{
                        $("#bell").append('<span class="notification-class">No Notification Found</span>');
                    }




                }

            });

            $("#notific").scroll(function() {
                if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {



                     a++;



                     $.ajax({
               url: '{{route("bell.notification")}}',
               type: "POST",
               data: { state:state,'count':a},
              success: function(data){
                    // $("#bell").empty();
                    var myObj=JSON.parse(data);

                    var html=[];
                    var id;
                    if(myObj.length>0){
                        myObj.forEach(function(u) {

                            var id = u.request_id;
                            let department_pic;
                            if (u.department_pic != '') {
                                department_pic = u.department_pic
                            } else {
                                department_pic = '{{asset('image/no-profile-pic.png')}}';
                            }
                            let user_pic;
                            if (u.user_pic != '') {
                                user_pic = u.user_pic
                            } else {
                                user_pic = '{{asset('image/no-profile-pic.png')}}';
                            }

                            // var aestTime = new Date().toLocaleString(myvar, {myvar: " Africa/Lagos"});
                            //     aestTime = new Date(aestTime);

                            if (u.web_status == 1) {
                                if (u.message_type == "admin_password_notification") {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src=" + department_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small></div></a>";
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { // if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = department_pic;

                                }
                                else {
                                    @if(Auth::guard('member')->check())
                                         var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @else 
                                    var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank' href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @endif
                                    


                                }
                            } else {
                                if (u.message_type == "admin_password_notification") {
                                    var img = new Image();
                                    img.onload = function() { // if image is not broken
                                        html = "<a  target='_blank'  class='unseen' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src=" + department_pic + "></div> <div class='col-md-9 notificat_text'><p>" + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small> </div></a>";
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a  target='_blank'  class='unseen' href='/npf_rescue_admin/department/" + u.request_id + "'><div class='col-md-3'> <img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p>" + u.message + "</p> <small class='pull-right'>" + u.created_at + "</small> </div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = department_pic;


                                }
                                else {
                                     @if(Auth::guard('member'))
                                         var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank'  class='unseen'  href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank'  class='unseen'  href='/npf_rescue_admin/member/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @else 
                                    var img = new Image();
                                    img.onload = function() { //if image is not broken
                                        html = "<a target='_blank'  class='unseen'  href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src=" + user_pic + "></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.onerror = function() { //if image is broken
                                        html = "<a target='_blank'  class='unseen'  href='/npf_rescue_admin/department_auth/alert/" + u.request_id + "' ><div class='col-md-3'><img class='img-responsive' src={{asset('image/no-profile-pic.png')}}></div> <div class='col-md-9 notificat_text'><p> " + u.message + " </p> <small class='pull-right'>" + u.created_at + "</small></div></a>"
                                        $("#bell").append(html);
                                    };
                                    img.src = user_pic;

                                    @endif

                                }
                            }
                        });
                    }else{
                        $("#bell").append('<span class="notification-class">No Notification Found</span>');
                    }




                }

            });

                }
              });
        });

// 
        setInterval(messagenotification, 3000);

        function messagenotification(){


            $.ajax({


                type:"get",
                url:"{{route('message.notification.count')}}",
                // data:{},
                async: false,
                success:function (data) {


                    var html= '<i class="far fa-envelope"></i><span class="notification badge noti-badge" id="count">'+data+'</span>'

                    $("#click_2").html(html);
                }

            });


        }
        setInterval(emergencycount, 3000);

        function emergencycount() {
            $.ajax({
                type:"get",
                url:"{{route('emergency.count')}}",
                // data:{},
                async: false,
                success:function (data) {
                    var html= '<i class="far fa-bell fa-fw noti" aria-hidden="true"></i><span class="notification badge noti-badge" id="count">'+data+'</span>'
                    $("#click").html(html);
                }
            });
        }








    });
</script>