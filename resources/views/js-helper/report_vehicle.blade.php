
<div class="emergency-modal">
    <div class="modal" id="rv_modal" role="dialog">
        <div class="modal-dialog wow zoomIn animated">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" onclick=" $('#rv_modal').removeClass('in'); $('#rv_modal').hide();">x</button>
                    <h4 class="modal-title" id="rv-title">NPF-EC2556</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h1>Report Vehicle Alert</h1>

                        <div class="col-md-6">
                            <label>Name: </label>
                            <span class="getname" id="rv_user">Aman User</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Email: </label>
                            <span id="rv_email">aman.appcrunk@gmail.com</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Color: </label>
                            <span id="rv_color">Black</span>
                        </div>
                        <div class="col-md-6">
                            <label>Vehicle Type: </label>
                            <span id="rv_type">Car</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Registration Number: </label>
                            <span class='getname' id="rv_registration_number">8168518857</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Chassis Number: </label>
                            <span id="rv_chassis_number">87541236985</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Engine Number: </label>
                            <span class="getname" id="rv_engine_number">7415896325</span>
                        </div>
                        <div class='col-md-6'>
                            <label>Date & Time: </label>
                            <span class="getname" id="rv_time">2019-06-11 09:56:44</span>
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

    var channel = pusher.subscribe('rv-channel');
    channel.bind('rv-event', function(data) {
        $('#rv_modal').addClass('in');
        $("#rv_modal").show();
        $("#rv_type").text(data.data.vehicle_type);
        $("#rv-title").text(data.data.unique_id);
        $("#rv_user").text(data.data.name);
        $("#rv_email").text(data.data.email);
        $("#rv_color").text(data.data.vehicle_color);
        $("#rv_registration_number").text(data.data.registration_number);
        $("#rv_chassis_number").text(data.data.chassis_number);
        $("#rv_engine_number").text(data.data.engine_number);
        $("#rv_time").text(data.time);
    });
</script>
