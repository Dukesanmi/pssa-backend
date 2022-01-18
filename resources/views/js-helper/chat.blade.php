<?php
if(Auth::guard('department')->check())
{ 
$userid=Auth::guard('department')->user()->app_users_id;
}
elseif(Auth::guard('member')->check())
{   
     $userid=Auth::guard('member')->user()->id;

    
}

else
{ 
   $userid=Auth::user()->app_users_id;
}

?>



<script>
    $('#btn-send-image').click(function(){
        $('#message-image').trigger('click'); //file uploading
    });
    function readURL(input) { // to append src of image on frontend

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).next('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#message-image").change(function () {
        $("#upload-image").show();
        readURL(this);
    });
    $('#message').keypress(function(event){
        //send chat message
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            var formData = new FormData();
            if($('#message-image').get(0).files.length === 0){ // if image is not coming
                formData.append('type','text');
                formData.append('message', $("#message").val());
                formData.append('user_2_id',$("#user_id").val());
            }else{ //if image is coming

                if($("#message-image").val().split('.').pop().toLowerCase()!='jpeg' && $("#message-image").val().split('.').pop().toLowerCase()!='jpg' && $("#message-image").val().split('.').pop().toLowerCase()!='png') {

                    formData.append('type','video');
                    formData.append('message',$("#message").val());
                    formData.append('user_2_id',$("#user_id").val());
                    formData.append('message',$('#message-image')[0].files[0]);


                }else{

                    formData.append('type','image');
                    formData.append('message',$("#message").val());
                    formData.append('user_2_id',$("#user_id").val());
                    formData.append('message',$('#message-image')[0].files[0]);
                }

            }
            $.ajax({
                type: "POST",
                url: '{{route('send.chat.message')}}',
                data:formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Show image container
                    $(".chat-loader").show();
                },
                complete:function(data){
                    // Hide image container
                    $(".chat-loader").hide();
                },
                success: function(data) {
                    $(".chat-loader").hide();
                    $('#upload-image').hide(); //clearing input type file on the success of sending image
                    var newMessage ='';
                    $.each(data.result, function( index, value ) {
                        if(value.type=='image'){ // if image is sended by other side
                            newMessage="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small></div></div></li>";
                        }else if(value.type=='video'){
                            newMessage="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><video src="+value.image+" height='100px' width='100px'></video><small>"+value.created_at+"</small></div></div></li>";
                        }
                        else{ //if text is sended by other end
                            newMessage="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                        }
                    });

                    $('ul.do-chat-list').append(newMessage);
                    $("#chatting_bar_form .msg-box").val("");
                    $('#message-image').val('');
                    $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 1);
                }
            });
            $('#message').removeAttr('value');
        }
    });
    $(".message_btn").click(function () {


        var formData = new FormData();
        if($('#message-image').get(0).files.length === 0){ // if image is not coming

            formData.append('type','text');
            formData.append('message', $("#message").val());
            formData.append('user_2_id',$("#user_id").val());
        }else{ //if image is coming
            if($("#message-image").val().split('.').pop().toLowerCase()!='jpeg' && $("#message-image").val().split('.').pop().toLowerCase()!='jpg' && $("#message-image").val().split('.').pop().toLowerCase()!='png') {

                formData.append('type','video');
                formData.append('message',$("#message").val());
                formData.append('user_2_id',$("#user_id").val());
                formData.append('message',$('#message-image')[0].files[0]);


            }else{

                formData.append('type','image');
                formData.append('message',$("#message").val());
                formData.append('user_2_id',$("#user_id").val());
                formData.append('message',$('#message-image')[0].files[0]);
            }
        }
        $.ajax({
            type: "POST",
            url: '{{route('send.chat.message')}}',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            beforeSend: function(){
                // Show image container
                $(".chat-loader").show();
            },
            complete:function(data){
                // Hide image container
                $(".chat-loade").hide();
            },
            success: function(data) {
                $(".chat-loader").hide();
                $('#upload-image').hide(); //hiding image  on the success of sending image
                var newMessage ='';
                $.each(data.result, function( index, value ) {
                    if(value.type=='image'){ // if image is sended by other side
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small></div></div></li>";
                    }else if(value.type=='video'){
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><video src="+value.image+" height='100px' width='100px'></video><small>"+value.created_at+"</small></div></div></li>";
                    }
                    else{ //if text is sended by other end
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                    }
                });
                $('ul.do-chat-list').append(newMessage);
                $("#chatting_bar_form .msg-box").val("");
                $('#message-image').val('');
                $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 1);
            }
        });
    });
    //list chat message
    $("#chting_btn").click(function () {
        $("#police_chatting_bar").hide();
        $.ajax({
            type: "POST",
            url: '{{route('list.chat.message')}}',
            data:{'user_2_id':$("#user_id").val(),'country_code':'IN'},
            beforeSend: function(){
                // Show image container
                $(".chat-loader").show();
            },
            complete:function(data){
                // Hide image container
                $(".chat-loader").hide();
            },
            success: function(data) {

                $('#upload-image').hide(); //hiding image  on the success of sending image
                var userId='<?php echo $userid ?>';
                var appendhtml='';
                $("ul.do-chat-list").empty();

                $.each(data.result, function( index, value ) {

                    if(parseInt(userId)==value.user_id){ // if sender
                        if(value.type=='image'){ // if image is sended by other side
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small>" +
                                "</div></div></li>";
                        }else if(value.type=='video'){
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
                        }
                        else{ //if text is sended by other end
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small>"+
                                "</div></div></li>";

                        }
                    }else{ // if receiver
                        if(value.type=='image'){ // if image is sended by other side
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><a target='_blank' href="+value.image+"><img src="+value.image+" height='280px' width='280px'></a><small>"+value.created_at+"</small></div></div></li>";
                        }else if(value.type=='video'){
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
                        }
                        else{ //if text is sended by other end
                            appendhtml="<li class='left-li li-message-chat-common'>" +
                                "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                                "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                        }
                    }
                    $("ul.do-chat-list").append(appendhtml);
                    $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() },0);
                });

            }
        });
    });
    // // see convo ajax

    //  $("#conv_btn").click(function () {
    //     $.ajax({
    //         type: "POST",
    //         url: '{{route('list.conversation.message')}}',
    //         data:{'user_2_id':$("#user_id").val(),'country_code':'IN','police_id':$("#police_id").val()},
    //         success: function(data) {
    //             $('#upload-image').hide(); //hiding image  on the success of sending image
    // var userId='<?php  $userid ?>';
    //             var appendhtml='';
    //             $("ul.do-chat-list").empty();

    //             $.each(data.result, function( index, value ) {

    //                 if(value.user_type==0){ // if sender
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small>" +
    //                             "</div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small>"+
    //                             "</div></div></li>";

    //                     }
    //                 }else{ // if receiver
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a target='_blank' href="+value.image+"><img src="+value.image+" height='280px' width='280px'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 }
    //                 $("ul.do-chat-list").append(appendhtml);
    //                 $("#msg-contents ").animate({ scrollTop: $("#msg-contents").height() }, 1);
    //             });

    //         }
    //     });
    // });



    //  // list chat between admin and deprtment

    //   $("#chting_btn2").click(function () {
    //     $.ajax({
    //         type: "POST",
    //         url: '{{route('list.department.chat')}}',
    //         data:{'user_2_id':20,'country_code':'IN','department_id':$("#department_id").val()},
    //         success: function(data) {
    //             $('#upload-image').hide(); //hiding image  on the success of sending image
    //             var userId='<?php  $userid ?>';
    //             var appendhtml='';
    //             $("ul.do-chat-list").empty();

    //              @if(Auth::guard('department')->check())

    //             $.each(data.result, function( index, value ) {

    //                 if(value.user_type==3){ // if sender
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small>" +
    //                             "</div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small>"+
    //                             "</div></div></li>";

    //                     }
    //                 }else{ // if receiver
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a target='_blank' href="+value.image+"><img src="+value.image+" height='280px' width='280px'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 }
    //                 $("ul.do-chat-list").append(appendhtml);
    //                 $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 1);
    //             });


    //             @else

    //                   $.each(data.result, function( index, value ) {

    //                 if(value.user_type==3){ // if sender
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small>" +
    //                             "</div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small>"+
    //                             "</div></div></li>";

    //                     }
    //                 }else{ // if receiver
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a target='_blank' href="+value.image+"><img src="+value.image+" height='280px' width='280px'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if text is sended by other end
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 }
    //                 $("ul.do-chat-list").append(appendhtml);
    //                 $("#msg-contents_department").animate({ scrollTop: $(".do-chat-list").height() }, 1);
    //             });

    //                   @endif



    //         }
    //     });
    // });



    // list ends here

    // see convo ajax ends here

    // check new chat message
    setInterval(checkNewChatMessage, 5000);
    function checkNewChatMessage(){
        var feedback =$.ajax({
            type: "POST",
            url: "{{route('check.chat.message')}}",
            data:{'user_2_id':$("#user_id").val()},
            async: false,
            success:function (data) {

                $.each(data.result, function( index, value ) {
                    var appendhtml='';
                    if(value.type=='image'){ // if message is image
                        appendhtml="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><a href="+value.image+"><img src="+value.image+" height='280' width='280'></a><small>"+value.created_at+"</small></div></div></li>";
                    }else if(value.type=='video'){
                        appendhtml="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><video width='280' height='280' controls src="+value.image+"></video><small>"+value.created_at+"</small></div></div></li>";
                    }
                    else{ //if message is text
                        appendhtml="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                    }

                    $("ul.do-chat-list").append(appendhtml);
                    $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 1);
                });
            },
        });
    }
    // check new convo message

    // send message to department


    //      $(".message_btn2").click(function () {
    //              var formData = new FormData();
    //               @if(Auth::guard('department')->check())
    //         if($('#message-image').get(0).files.length === 0){ // if image is not coming

    //             formData.append('type','text');
    //             formData.append('message', $("#message2").val());
    //             formData.append('user_2_id',20);
    //              formData.append('E-id',$("#e_id").val());
    //         }else{ //if image is coming
    //             formData.append('type','image');
    //             formData.append('message',$("#message2").val());
    //             formData.append('user_2_id',20);
    //            formData.append('E-id',$("#e_id").val());
    //             formData.append('message',$('#message-image')[0].files[0]);
    //         }

    //         @else
    //          if($('#message-image').get(0).files.length === 0){ // if image is not coming

    //             formData.append('type','text');
    //             formData.append('message', $("#message2").val());
    //             formData.append('user_2_id',$("#department_id").val());
    //              formData.append('E-id',$("#e_id").val());
    //         }else{ //if image is coming
    //             formData.append('type','image');
    //             formData.append('message',$("#message2").val());
    //             formData.append('user_2_id',$("#department_id").val());
    //             formData.append('message',$('#message-image')[0].files[0]);
    //             formData.append('E-id',$("#e_id").val());
    //         }

    //         @endif


    //         $.ajax({
    //             type: "POST",
    //             url: '{{route('send.chat.message2')}}',
    //             data:formData,
    //             processData: false,  // tell jQuery not to process the data
    //             contentType: false,
    //             success: function(data) {
    //                 $('#upload-image').hide(); //hiding image  on the success of sending image
    //                 var newMessage ='';
    //                 $.each(data.result, function( index, value ) {
    //                     if(value.type=='image'){ // if image is sended by other side
    //                         newMessage="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><img src="+value.image+" height='100px' width='100px'><small>"+value.created_at+"</small></div></div></li>";
    //                     }else{ //if text is sended by other end
    //                         newMessage="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 });
    //                 $('ul.do-chat-list').append(newMessage);
    //                 $("#chatting_bar_form1 .msg-box1").val("");
    //             }
    //         });
    //     });


    //     // send message to department ends here
    //      setInterval(checkNewChatMessage2, 5000);
    //        function checkNewChatMessage2(){


    //      $.ajax({
    //             type: "POST",
    //             url: "{{route('check.new.department.message')}}",
    //             data:{'user_2_id':$("#department_id").val()},
    //             async: false,
    //             success:function (data) {

    //                 $.each(data.result, function( index, value ) {
    //                     var appendhtml='';
    //                     if(value.type=='image'){ // if message is image
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a href="+value.image+"><img src="+value.image+" height='280' width='280'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video width='280' height='280' controls src="+value.image+"></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if message is text
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }

    //                     $(".do-chat-list").append(appendhtml);
    //                     $("#msg-contents_department").animate({ scrollTop: $(".do-chat-list").height() }, 1);
    //                 });
    //             },
    //         });
    //     }


    //      setInterval(checkNewConvoMessage, 1000);

    // function checkNewConvoMessage(){



    //   $.ajax({
    //             type:"POST",
    //             url:"{{route('check.new.message')}}",
    //             data:{'user_1_id':$("#user_id").val(),'police_id':$("#police_id").val()},
    //             async: false,
    //             success:function (data) {

    //                 $.each(data.result, function( index, value ) {
    //                     var appendhtml='';
    //                     console.log(value);
    //                     if(value.user_type==1)
    //                     {
    //                     if(value.type=='image'){ // if message is image
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a href="+value.image+"><img src="+value.image+" height='280' width='280'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video width='280' height='280' controls src="+value.image+"></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if message is text
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 }
    //                 else{
    //                     if(value.type=='image'){ // if message is image
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><a href="+value.image+"><img src="+value.image+" height='280' width='280'></a><small>"+value.created_at+"</small></div></div></li>";
    //                     }else if(value.type=='video'){
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><video width='280' height='280' controls src="+value.image+"></video><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                     else{ //if message is text
    //                         appendhtml="<li class='left-li li-message-chat-common'>" +
    //                             "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
    //                             "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
    //                     }
    //                 }

    //                   $("ul.do-chat-list").append(appendhtml);
    //                     $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 1);
    //                 });
    //             },
    //         });
    //    }



    // check new convo message ends here
</script>