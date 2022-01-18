<style>
    #police-broadcastModal .broad_img{width: 150px; margin: 20px auto;}
    #police-broadcastModal .username{width:50%; float:left;}
    #police-broadcastModal .date_time{width:50%; float:right; text-align:right;}
    #police-broadcastModal .broad_message{width:100%;}
    #police-broadcastModal .broad_outer{padding:0;}
    #police-broadcastModal .col-md-4{height: 100px; overflow: hidden; }
</style>
<div class="modal fade" id="police-broadcastModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">C4i Emergency Broadcast System (C4i-EBS)</h4>
            </div>
            <div class="modal-body">
                <img class="img-responsive broad_img" src="{{asset('megaphone.svg')}}" alt="broadcast">
                <div class="col-md-12 broad_outer">
                    <h5 class="username"><b>Admin</b></h5>
                    <p class="date_time" id="police-broadcast_time">28-06-2019, 03:27pm</p>
                </div>
                <p class="broad_message" id="police-broadcast_message">.</p>
                <div class="img-container row"></div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal"  data-dismiss="modal">Dismiss</button>
            </div> -->
        </div>

    </div>
</div>

<script>
    // Pusher.logToConsole = true;

    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });

    var channel = pusher.subscribe('police-broadcast-channel');
    channel.bind('police-broadcast-event', function(data) {
        var state="{{Auth::guard('department')->check()?Auth::guard('department')->user()->state:Auth::guard('fire')->user()->state}}";
      if(data.mediaArray.length>0){
          $(".img-container").empty();
          data.mediaArray.forEach(function (value) {

              $(".img-container").append("<div class='col-md-4'><a target='_blank' href="+value+"><img src="+value+" height='100px' width='100px'></a></div>")
          });
      }
        if(data.notification_type=='5'){ // it means for all admin panels
            if(data.state=='all'){ // if all state is selected
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else if(data.state==state){ // if specific state to all
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else{
                return false;
            }
        }else if(data.notification_type=='3'){ // it means only for specific police departments
            if(data.state=='all'){
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else if(data.state==state){
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else{
                return false;
            }
        }else if(data.notification_type=='4'){ // it means only for specific medical departments
            if(data.state=='all'){
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else if(data.state==state){
                $('#police-broadcastModal').addClass('in');
                $("#police-broadcastModal").show();
                $("#police-broadcast_message").text(data.message);
                $("#police-broadcast_time").text(data.time);
            }else{
                console.log("no-notification");
            }
        }else{
            return false;
        }

        $(".close-modal").click(function () {
            $('#police-broadcastModal').removeClass('in');
            $("#police-broadcastModal").hide();
        });

    });
</script>
