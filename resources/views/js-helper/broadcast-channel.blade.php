<style>
    #broadcast-modal .broad_img{width: 150px; margin: 20px auto;}
    #broadcast-modal .username{width:50%; float:left;}
    #broadcast-modal .date_time{width:50%; float:right; text-align:right;}
    #broadcast-modal .broad_message{width:100%;}
    #broadcast-modal .broad_outer{padding:0;}
    #broadcast-modal .col-md-4{height: 100px; overflow: hidden; }
</style>
<div class="modal fade" id="broadcast-modal" role="dialog">
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
                    <p class="date_time" id="broadcast_time">28-06-2019, 03:27pm</p>
                </div>
                <p class="broad_message" id="broadcast_message">.</p>
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

    var channel = pusher.subscribe('broadcast-channel');
    channel.bind('broadcast-event', function(data) {
        var state="{{Auth::guard('department')->check()?Auth::guard('department')->user()->state:Auth::guard('fire')->user()->state}}";
        if(data.mediaArray.length>0){
            $(".img-container").empty();
            data.mediaArray.forEach(function (value) {

                $(".img-container").append("<div class='col-md-4'><a target='_blank' href="+value+"><img src="+value+" width='100%'></a></div>")
            });
        }
        $('#broadcast-modal').addClass('in');
        $("#broadcast-modal").show();
        $("#broadcast_message").text(data.message);
        $("#broadcast_time").text(data.time);

        $(".close-modal").click(function () {
            $('#broadcast-modal').removeClass('in');
            $("#broadcast-modal").hide();
        });

    });
</script>
