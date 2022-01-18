<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var map;

    function initMap() {
        setInterval(function(){getUpdatedLatLong({{(app('request')->input('id'))}});},9000);
        var lat='<?php echo $lat?>';
        var lng='<?php echo $lng?>';
        var type_of_problem='<?php echo $types_of_problem ?>';
        var id='<?php echo $id ?>';
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId:'satellite',
            disableDefaultUI:true
        });
        //
        var geocoder = new google.maps.Geocoder;
        var input=lat+','+lng;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
            setTimeout(function () {
                smoothZoom(map, 13, map.getZoom(), true);
            },2000);
        function getUpdatedLatLong(id){
            $.ajax({
                type:'post',
                url:"{{route('emergency.alert.lat_long')}}",
                data:{id:id},
                success:function (data) {
                    var coordinates=JSON.parse(data);
                    var geocoder = new google.maps.Geocoder;

                    //user lat long
                    var input=coordinates.latitude+','+coordinates.longitude;
                    $("#appendlat").html(coordinates.latitude);
                    $("#appendlng").html(coordinates.longitude);
                    //police lat long
                    var pInput=coordinates.police_lat+','+coordinates.police_lng;

                    $("#appendpolicelat").html(coordinates.police_lat);
                    $("#appendpolicelng").html(coordinates.police_lng);
                    var startpoint=new google.maps.LatLng(coordinates.police_lat,coordinates.police_lng);
                    var endpoint=new google.maps.LatLng(coordinates.latitude,coordinates.longitude);

                    calculateAndDisplayRoute(directionsService, directionsDisplay,startpoint,endpoint,map);
                }
            });
        }

    }


    function smoothZoom (map, level, cnt, mode) {
        //alert('Count: ' + cnt + 'and Max: ' + level);

        // If mode is zoom in
        if(mode == true) {

            if (cnt >= level) {
                return;
            }
            else {
                var z = google.maps.event.addListener(map, 'zoom_changed', function(event){
                    google.maps.event.removeListener(z);
                    smoothZoom(map, level, cnt + 1, true);
                });
                setTimeout(function(){map.setZoom(cnt)}, 80);
            }
        } else {
            if (cnt <= level) {
                return;
            }
            else {
                var z = google.maps.event.addListener(map, 'zoom_changed', function(event) {
                    google.maps.event.removeListener(z);
                    smoothZoom(map, level, cnt - 1, false);
                });
                setTimeout(function(){map.setZoom(cnt)}, 80);
            }
        }
    }
    $().ready(function () {
        $("#chting_btn").click(function () {
            $("#chat_header").html("<h4>"+$(".getName").text()+"</h4>");
            $("#chatting_bar").show();
            $('#msg-contents').animate({
                    scrollTop: $(document).height('0')
                },
                1500);
            return false;
        });

        $(".chat_close").click(function () {
            $("#chatting_bar").hide();
        });

    });
    $(".custom_close").click(function () {
        $("#open_hide").hide();
        $("#chatting_bar").hide();
        $("#map").css('height','957px');
        $("#map").removeClass('responsive-class');
    });
    var markers=[];
    function makeMarker(position, icon, title, map) {
        markers= new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
            title: title
        });
    }
    function calculateAndDisplayRoute(directionsService, directionsDisplay,startpoint,endpoint,map) {
        directionsDisplay.setMap(null);
        // $( "#page-wrapper" ).load( "" );
        var geocoder = new google.maps.Geocoder;
        var icons = {
            start:{
                url: "{{asset('emergency_icon/police-pointer.svg')}}",
                scaledSize: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
            },
            end: {
                url: "{{asset('emergency_icon/Burglary.svg')}}",
                scaledSize: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
            }
        };


        directionsService.route({
            origin: startpoint,
            destination: endpoint,
            travelMode: 'DRIVING'
        }, function(response, status) {
            var directionRenderer=new google.maps.DirectionsRenderer({
                map: map,
                directions: response,
                suppressMarkers: true

            });
            if (status === 'OK') {
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons.start, "Police", map);
                makeMarker(leg.end_location, icons.end, 'User', map);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });


    }



</script>
