<style>
    #medical-broadcastModal .broad_img{width: 150px; margin: 20px auto;}
    #medical-broadcastModal .username{width:50%; float:left;}
    #medical-broadcastModal .date_time{width:50%; float:right; text-align:right;}
    #medical-broadcastModal .broad_message{width:100%;}
    #medical-broadcastModal .broad_outer{padding:0;}
     #medical-broadcastModal .col-md-4{height: 100px; overflow: hidden; }

</style>
<div class="modal fade" id="medical-broadcastModal" role="dialog">
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
                    <p class="date_time" id="medical-broadcast_time">28-06-2019, 03:27pm</p>
                </div>
                <p class="broad_message" id="medical-broadcast_message">.</p>
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

    var channel = pusher.subscribe('medical-broadcast-channel');
    channel.bind('medical-broadcast-channel', function(data) {
        console.log(data);
        var state="{{Auth::guard('department')->check()?Auth::guard('department')->user()->state:Auth::guard('fire')->user()->state}}";

        if(data.notification_type=='5'){ // it means for all admin panels
            if(data.state=='all'){ // if all state is selected
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else if(data.state==state){ // if specific state to all
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else{
                return false;
            }
        }else if(data.notification_type=='3'){ // it means only for specific police departments
            if(data.state=='all'){
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else if(data.state==state){
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else{
                return false;
            }
        }else if(data.notification_type=='4'){ // it means only for specific medical departments
            if(data.state=='all'){
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else if(data.state==state){
                $('#medical-broadcastModal').addClass('in');
                $("#medical-broadcastModal").show();
                $("#medical-broadcast_message").text(data.message);
                $("#medical-broadcast_time").text(data.time);
            }else{
                console.log("no-notification");
            }
        }else{
            return false;
        }

        $(".close-modal").click(function () {
            $('#medical-broadcastModal').removeClass('in');
            $("#medical-broadcastModal").hide();
        });

    });
</script>
