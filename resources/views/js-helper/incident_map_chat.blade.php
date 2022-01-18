@php 

if(Auth::guard('department')->check())
{
$userid=Auth::guard('department')->user()->app_users_id;
}

elseif(Auth::guard('member')->check())
{
$userid=Auth::guard('member')->user()->app_users_id;
}

else
{ 
    $userid=Auth::guard('web')->user()->app_users_id;
}




 @endphp

<script>

var set;
    var set2;
    var set3;

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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

        $.ajax({
            type: "POST",
            url: '{{route("send.chat.message")}}',
            data:formData,
            processData: false,  // tell jQuery not to process the data
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
                $('#upload-image').hide(); //hiding image  on the success of sending image
                var newMessage ='';
                $.each(data.result, function( index, value ) {
                    console.log(value.image);
                    if(value.type=='image'){ // if image is sended by other side
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><img src="+value.image+" class='img-responsive'><small>"+value.created_at+"</small></div></div></li>";
                    }else if(value.type=='video'){
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_left_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><video src='"+value.image+"'width='280' height='280' controls></video><small>"+value.created_at+"</small></div></div></li>";
                    }
                    else{ //if text is sended by other end
                        newMessage="<li class='left-li li-message-chat-common'>" +
                            "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-12 col-sm-12 col-xs-12'>" +
                            "<div class='msg_box'><small>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                    }
                });
                $('ul.do-chat-list').append(newMessage);
                $("#chatting_bar_form .msg-box").val("");
                $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 0);
                document.getElementById('chatting_bar_form').reset();
            }
        });
    });



    $("#start_chatting").click(function () {

        // clearInterval(set);
        $.ajax({
            type: "POST",
            url: '{{route('list.chat.message')}}',
            data:{'user_2_id':$("#user_id").val(),'country_code':'IN'},
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
                    $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 0);
                });

            }
        });
    });

    $('#start_chatting').click(function(){
        set2=setInterval(checkNewChatMessage, 5000);
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
                        $("#msg-contents").animate({ scrollTop: $(".do-chat-list").height() }, 0);
                    });
                },
            });
        }
    });

    $(".chat_close").on('click',function(){

 clearInterval(set2);

    });
</script>