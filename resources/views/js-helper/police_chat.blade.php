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
    $('#police-btn-send-image').click(function(){
        $('#police-message-image').trigger('click'); //file uploading
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
    $("#police-message-image").change(function () {
        $("#police-upload-image").show();
        readURL(this);
    });
    $('#police_message').keypress(function(event){
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
            if($('#police-message-image').get(0).files.length === 0){ // if image is not coming
                formData.append('type','text');
                formData.append('message', $("#police_message").val());
                formData.append('user_2_id',$("#police_user_id").val());
            }else{ //if image is coming

                if($("#police-message-image").val().split('.').pop().toLowerCase()!='jpeg' && $("#police-message-image").val().split('.').pop().toLowerCase()!='jpg' && $("#police-message-image").val().split('.').pop().toLowerCase()!='png') {

                    formData.append('type','video');
                    formData.append('message',$("#police_message").val());
                    formData.append('user_2_id',$("#police_user_id").val());
                    formData.append('message',$('#police-message-image')[0].files[0]);


                }else{

                    formData.append('type','image');
                    formData.append('message',$("#message").val());
                    formData.append('user_2_id',$("#police_user_id").val());
                    formData.append('message',$('#police-message-image')[0].files[0]);
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
                    $('#police-upload-image').hide(); //clearing input type file on the success of sending image
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

                    $('ul.police-do-chat-list').append(newMessage);
                    $("#police_chatting_bar_form .msg-box").val("");
                    $('#police-message-image').val('');
                    $(".policer_inner").animate({ scrollTop: $(".police-do-chat-list").height() },1);
                }
            });
            $('#police_message').removeAttr('value');
        }
    });
    $(".police_message_btn").click(function () {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

        var formData = new FormData();
        if($('#police-message-image').get(0).files.length === 0){ // if image is not coming
            formData.append('type','text');
            formData.append('message', $("#police_message").val());
            formData.append('user_2_id',$("#police_user_id").val());
        }else{ //if image is coming

            if($("#police-message-image").val().split('.').pop().toLowerCase()!='jpeg' && $("#police-message-image").val().split('.').pop().toLowerCase()!='jpg' && $("#police-message-image").val().split('.').pop().toLowerCase()!='png') {

                formData.append('type','video');
                formData.append('message',$("#police_message").val());
                formData.append('user_2_id',$("#police_user_id").val());
                formData.append('message',$('#police-message-image')[0].files[0]);


            }else{

                formData.append('type','image');
                formData.append('message',$("#message").val());
                formData.append('user_2_id',$("#police_user_id").val());
                formData.append('message',$('#police-message-image')[0].files[0]);
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
                $('#police-upload-image').hide(); //clearing input type file on the success of sending image
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

                $('ul.police-do-chat-list').append(newMessage);
                $("#police_chatting_bar_form .msg-box").val("");
                $('#police-message-image').val('');
                $(".policer_inner").animate({ scrollTop: $(".police-do-chat-list").height() },1);
            }
        });
        $('#police_message').removeAttr('value');
    });
    //list chat message
    $("#police_chting_btn").click(function () { 
        $("#chatting_bar").hide();
        $.ajax({
            type: "POST",
            url: '{{route('list.chat.message')}}',
            data:{'user_2_id':$("#police_user_id").val(),'country_code':'IN'},
            beforeSend: function(){
                // Show image container
                $(".chat-loader").show();
            },
            complete:function(data){
                // Hide image container
                $(".chat-loader").hide();
            },
            success: function(data) {

                $('#police-upload-image').hide(); //hiding image  on the success of sending image
                var userId='<?php echo $userid ?>';
                
                var appendhtml='';
                $("#police_chatting_bar").show();
                $("ul.police-do-chat-list").empty();

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
                    $("ul.police-do-chat-list").append(appendhtml);
                    $(".policer_inner").animate({ scrollTop: $(".police-do-chat-list").height() },0);
                });

            }
        });
    });

    // check new chat message
    setInterval(checkNewChatMessage, 5000);
    function checkNewChatMessage(){
        var feedback =$.ajax({
            type: "POST",
            url: "{{route('check.chat.message')}}",
            data:{'user_2_id':$("#police_user_id").val()},
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

                    $("ul.police-do-chat-list").append(appendhtml);
                    $(".policer_inner").animate({ scrollTop: $(".police-do-chat-list").height() },1);
                });
            },
        });
    }
    // check new convo message ends here
    $(".police_chat_close").click(function () {
       $("#police_chatting_bar").hide();
    });
</script>