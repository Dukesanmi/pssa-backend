<script>
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
        $.ajax({
            type: "POST",
            url: 'send/chat/message',
            data:{'type':'text','message':$("#message").val(),'user_2_id':parseInt($("#user_id").val())},
            success: function(data) {
                var newMessage = '<li class="right-li pull-right li-message-chat-common  focusable-chat-message">' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="message_right_content col-md-9">' +
                    '<div class="msg_box">' +
                    '<small>' +
                    $("#message").val() +
                    '</small>' +
                    '<small>Just Now</small>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
                $('ul.do-chat-list').append(newMessage);

            }
        });
    }
});
//list chat message
   $("#chting_btn").click(function () {
       $.ajax({
           type: "POST",
           url: 'list/chat/message',
           data:{'user_2_id':$("#user_id").val(),'country_code':'IN'},
           success: function(data) {
               console.log(data.result);
               $.each(data.result, function( index, value ) {
                 var appendhtml="<li class='right-li pull-right li-message-chat-common'>" +
                 "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-9 col-sm-9 col-xs-9'>" +
                 "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                   $("ul.do-chat-list").append(appendhtml);
               });

           }
       });
   });

//check new chat message
setInterval(checkNewChatMessage, 5000);
function checkNewChatMessage(){
    var feedback = $.ajax({
        type: "POST",
        url: "check/my/messages",
        data:{'user_2_id':$("#user_id").val()},
        async: false,
        success:function (data) {
            $.each(data.result, function( index, value ) {
                var appendhtml="<li class='right-li pull-right li-message-chat-common'>" +
                    "<div class='row'></div><div class='col-md-12'></div><div class='message_right_content col-md-9 col-sm-9 col-xs-9'>" +
                    "<div class='msg_box'><smal>"+value.message+"</small><small>"+value.created_at+"</small></div></div></li>";
                $("ul.do-chat-list").append(appendhtml);
            });
        },
    }).always(function(){
        setTimeout(function(){checkNewChatMessage();}, 5000);
    }).responseText;
}
</script>