<script>

    // bearing lat lng ends

    let map_styles=[
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#d6e2e6"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#cddbe0"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#7492a8"
                }
            ]
        },
        {
            "featureType": "administrative.neighborhood",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "lightness": 25
                }
            ]
        },
        {
            "featureType": "administrative.land_parcel",
            "elementType": "labels",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#d6e2e6"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#cddbe0"
                }
            ]
        },
        {
            "featureType": "landscape.natural",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#dae6eb"
                }
            ]
        },
        {
            "featureType": "landscape.natural",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#7492a8"
                }
            ]
        },
        {
            "featureType": "landscape.natural.terrain",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#d6e2e6"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#588ca4"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "saturation": -100
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#cae7a8"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#bae6a1"
                }
            ]
        },
        {
            "featureType": "poi.sports_complex",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#c6e8b3"
                }
            ]
        },
        {
            "featureType": "poi.sports_complex",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#bae6a1"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#41626b"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "saturation": -45
                },
                {
                    "lightness": 10
                },
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#f7fdff"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#beced4"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#eef3f5"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#cddbe0"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#edf3f5"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#cddbe0"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "labels",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "saturation": -70
                }
            ]
        },
        {
            "featureType": "transit.line",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#588ca4"
                }
            ]
        },
        {
            "featureType": "transit.station",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#008cb5"
                }
            ]
        },
        {
            "featureType": "transit.station.airport",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": -5
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#a6cbe3"
                }
            ]
        }
    ];
    $().ready(function () {
        $("#chting_btn").click(function () {
            $("#chat_header").html("<h4>"+$(".getName").text()+"</h4>");
            $("#open_hide").hide();
            $("#map").css('height','957px');
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var map;
    var markers = [];
    var marker=[];
    function initMap() {
        var lat = '<?php echo $lat?>';
        var lng = '<?php echo $lng?>';
        var type_of_problem = '<?php echo $types_of_problem ?>';
        var id = '<?php echo $id ?>';
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var polylineOptionsActual = new google.maps.Polyline({
            strokeColor: '#000',
            strokeOpacity: 1.0,
            strokeWeight: 5
        });
        directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions: polylineOptionsActual});
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI:true,
            labels:true,
            // styles:map_styles
        });
        var marker, i, bearing;
        directionsDisplay.setMap(map);
        var icons = {
            start:{
                url: "../../../../../emergency_icon/nearby.gif",
                anchor: new google.maps.Point(50,60),
                scaledSize: new google.maps.Size(100,100),
                scale: 4
                // origin: new google.maps.Point(0, 0),
            },
            end: {
                // path:'M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z',
                path:'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                // url: "../../../../../image/Police car.svg",
                anchor: new google.maps.Point(30,60),
                scaledSize: new google.maps.Size(20,60),
                fillColor: '#008751',
                fillOpacity: 0.5,
                strokeColor: '#000',
                strokeWeight: 1,
                scale: 1,
                rotation:0
            }
        };
        if($("#end").val()!=','){


            // setInterval(function () {
                var alert_id='<?php echo (app('request')->input('id')) ?>';
                var police_id='<?php echo (app('request')->input('police_id'))?>';
                getUpdatedLatLong(alert_id);
            // },9000);
            function getUpdatedLatLong(id) {

                $.ajax({
                    type: 'post',
                    url: '../../get_lat_long',
                    data: {id: id},
                    success: function (data) {
                        var coordinates = JSON.parse(data);

                        $.each(coordinates.nearby,function (index,value) {
                           let marker3 = new google.maps.Marker({
                                position: new google.maps.LatLng(parseFloat(value.latitude), parseFloat(value.longitude)),
                                map: map,
                                optimized:false,
                               icon: {
                                   // path:'M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z',
                                   path:'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                                   // url: "../../../../../image/Police car.svg",
                                   anchor: new google.maps.Point(30,60),
                                   scaledSize: new google.maps.Size(20,60),
                                   fillColor: '#008751',
                                   fillOpacity: 0.5,
                                   strokeColor: '#000',
                                   strokeWeight: 1,
                                   scale: 1,
                                   rotation:parseFloat(coordinates.police_bearing)
                               }
                            });
                        });

                        var geocoder = new google.maps.Geocoder;

                        //user lat long
                        var input = coordinates.latitude + ',' + coordinates.longitude;
                        $("#appendlat").html(coordinates.latitude);
                        $("#appendlng").html(coordinates.longitude);
                        var start = $("#start").val(coordinates.latitude + ',' + coordinates.longitude);
                        //police lat long
                        var pInput = coordinates.police_lat + ',' + coordinates.police_lng;

                        $("#appendpolicelat").html(coordinates.police_lat);
                        $("#appendpolicelng").html(coordinates.police_lng);
                        var end = $("#end").val(coordinates.police_lat + ',' + coordinates.police_lng);
                        var startpoint = new google.maps.LatLng(start);
                        var endpoint = new google.maps.LatLng(end);

                        let marker1;
                        let marker2;
                        //user marker
                        marker1 = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(coordinates.latitude), parseFloat(coordinates.longitude)),
                            map: map,
                            optimized:false,
                            icon:icons.start,
                        });
                        var position = [parseFloat(coordinates.police_lat), parseFloat(coordinates.police_lng)];
                        //police marker
                        marker2 = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(coordinates.police_lat), parseFloat(coordinates.police_lng)),
                            map: map,
                            // icon:{
                            //     path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                            //     scale: 4,
                            //     strokeColor: '#00F',
                            //     rotation: 0,
                            // }
                            icon: {
                                // path:'M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z',
                                path:'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                                // url: "../../../../../image/Police car.svg",
                                anchor: new google.maps.Point(30,60),
                                scaledSize: new google.maps.Size(20,60),
                                fillColor: '#008751',
                                fillOpacity: 0.5,
                                strokeColor: '#000',
                                strokeWeight: 1,
                                scale: 1,
                                rotation:parseFloat(coordinates.police_bearing)
                            }
                        });
                        // var rotationAngle = 85.5;
                        // google.maps.event.addListenerOnce(map, 'idle', function() {
                        //     setInterval(function() {
                        //         console.log("transform: rotate(" + rotationAngle + 'deg)');  $('img[src="../../../../../image/Police car.svg"]').css({
                        //             'transform': 'rotate(' + rotationAngle + 'deg)',
                        //             'transform-origin': '39px 60px'
                        //         });
                        //         rotationAngle += 10;
                        //         rotationAngle %= 360;
                        //     }, 1000);
                        // });
                        google.maps.event.addListener(map, 'zoom_changed', function() {
                            marker1.setIcon(icons.start);
                            marker2.setIcon(icons.end);

                        });
                        // // animating car to given location
                        var numDeltas = 100;
                        var delay = 10; //milliseconds
                        var i = 0;
                        var deltaLat;
                        var deltaLng;
                        function transition(result){
                            i = 0;
                            deltaLat = (result[0] - position[0])/numDeltas;
                            deltaLng = (result[1] - position[1])/numDeltas;
                            moveMarker();
                        }

                        function moveMarker(){
                            position[0] += deltaLat;
                            position[1] += deltaLng;
                            var latlng = new google.maps.LatLng(position[0], position[1]);
                            marker2.setPosition(latlng);

                            if(i!=numDeltas){
                                i++;
                                setTimeout(moveMarker, delay);
                            }
                        }
                        //updating location in realtime for police and user
                            //police Event Starts
                        Pusher.logToConsole = true;
                        var pusher = new Pusher('794acf82292b0bd4dd28', {
                            cluster: 'us2',
                            forceTLS: true
                        });
                        var channel = pusher.subscribe('police-channel'+police_id);
                        channel.bind('police-event'+police_id, function(data) {
                            $("#duration").text(data.distance);
                            $("#time").text(data.time);
                            //updated position
                            var result = [data.lat, data.lng];
                            transition(result);
                            bearing = parseFloat(data.bearing);
                            // // console.log(marker);
                            // // //updating car angle
                            // // var icon = marker2.getIcon();
                            // // icon.rotation=bearing(parseFloat(coordinates.police_lat), parseFloat(coordinates.police_lng),data.lat,data.lng);
                            // // marker2.setIcon(icon);

                             if(marker2){
                                marker2.setMap(null);
                             }

                            // icon.setIcon(icon);
                            marker2 = new google.maps.Marker({
                                position: new google.maps.LatLng(parseFloat(data.lat), parseFloat(data.lng)),
                                map: map,
                                icon:{
                                    // path:'M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z',
                                    path:'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                                    // url: "../../../../../image/Police car.svg",
                                    anchor: new google.maps.Point(30,60),
                                    scaledSize: new google.maps.Size(20,60),
                                    fillColor: '#008751',
                                    fillOpacity: 0.5,
                                    strokeColor: '#000',
                                    strokeWeight: 1,
                                    scale: 1,
                                    rotation:bearing
                                }
                            });

                            google.maps.event.addListener(map, 'zoom_changed', function() {
                                marker2.setIcon({
                                    // path:'M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z',
                                    path:'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                                    // url: "../../../../../image/Police car.svg",
                                    anchor: new google.maps.Point(30,60),
                                    scaledSize: new google.maps.Size(20,60),
                                    fillColor: '#008751',
                                    fillOpacity: 0.5,
                                    strokeColor: '#000',
                                    strokeWeight: 1,
                                    scale: 1,
                                    rotation:parseFloat(coordinates.police_bearing)
                                });
                            });

                            $("#end").val(data.lat + ',' + data.lng);
                            calculateAndDisplayRoute(directionsService, directionsDisplay); // resetting route
                        });

                        var channel = pusher.subscribe('private-user-channel');
                        channel.bind('private-user-event', function(data) {
                            if(marker1){
                                marker1.setMap(null);
                            }
                            // alert(JSON.stringify(data));
                            marker1 = new google.maps.Marker({
                                position: new google.maps.LatLng(parseFloat(data.lat), parseFloat(data.lng)),
                                map: map,
                                optimized:false,
                                icon:icons.start,
                            });
                            $("#start").val(data.lat + ',' + data.lng);
                            calculateAndDisplayRoute(directionsService, directionsDisplay); // resetting route
                        });
                        //user Event Ends

                        markers['i']=marker1;
                        markers['e']=marker2;
                        calculateAndDisplayRoute(directionsService, directionsDisplay);
                    }
                });
            }
        }else{
            setTimeout(function () {
                smoothZoom(map, 16, map.getZoom(), true);
            },9000);
            var problem='<?php echo (app('request')->input('type_of_problem')) ?>';
            var cityCircle = new google.maps.Circle({
                strokeColor: '#ffb3b3',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: ' #ffb3b3',
                fillOpacity: 0.35,
                map: map,
                center: {lat: parseFloat(lat), lng: parseFloat(lng)},
                radius: Math.sqrt('50') * 100
            });
            //user marker
           let marker1 = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
                map: map,
                icon:icons.start,
            });
            var infowindow = new google.maps.InfoWindow({});
            //trigerring event on the click of marker
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                $("#chatting_bar").hide();
                return function () {
                    $.ajax({
                        type: "POST",
                        url: '../../get_emergency_alert',
                        data:{'id':$("#emergency_id").val()},
                        success: function(data) {
                            var myObj = JSON.parse(data);
                            var mylocation = [];
                            //console.log(data);
                            mylocation=myObj;

                            document.getElementById("open_hide").style.display='block';
                            showEmergencyDetails(mylocation);
                            if(myObj.status=="nok"){
                                alert("somthing went wrong");
                            }else{
                                //location.reload();
                            }
                        }
                    });
                    infowindow.open(map, marker);
                }
            })(marker, i));

        }

    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {

        directionsService.route({
            origin: document.getElementById('start').value,
            destination: document.getElementById('end').value,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                var leg = response.routes[0].legs[0];

                 directionsDisplay.setDirections(response);
                directionsDisplay.setOptions( { suppressMarkers: true } );


            } else {
                // window.alert('Directions request failed due to ' + status);
            }
        });
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
    function showEmergencyDetails(parameters) {
        // document.getElementById("map").style.height='620px';
        $("#map").animate({height: "670px"});
        $("#map").addClass('responsive-class');
        var status='';
        if(parameters.status=='1'){
            status="Todo";
        }else if(parameters.status=="2"){
            status="InProgress";
        }else if(parameters.status=="3"){
            status="InComplete";
        }else if(parameters.status=="4"){
            status="Complete";
        }else{
            status="empty";
        }

        //collapsing  mobile menu bar
        $(".sidebar-nav").removeClass("in");
        //end
        if(parameters.location_array['4']&&parameters.location_array['5'] && parameters.location_array['6']){
            var append_location_html="<tr><td>Address:</td><td>"+parameters.location_array['0']['long_name']+','+parameters.location_array['1']['long_name']+','+parameters.location_array['2']['long_name']+','+parameters.location_array['3']['long_name']+"</td></tr>" + "" +
                "<tr><td>City,State:</td><td>"+parameters.location_array['4']['long_name']+','+parameters.location_array['5']['long_name']+"</td></tr>"
                +"<tr><td>Country:</td><td>"+parameters.location_array['6']['long_name']+','+parameters.location_array['6']['short_name']+"</td></tr>"
            ;
        }else{
            var append_location_html="<tr><td>Address:</td><td>"+parameters.location_array['0']['long_name']+','+parameters.location_array['1']['long_name']+','+parameters.location_array['2']['long_name'];
        }


        var device_details="<tr><td>Carrier:</td><td>"+parameters.network_provider+"</td></tr>"
            +"<tr><td>Network Strength:</td><td>"+parameters.network_strength+"</td></tr>";


        var emergency_details="<tr><td>Type of Emergency:</td><td>"+parameters.types_of_problem+"</td></tr>"
            +"<tr><td>Unique Code</td><td>"+parameters.unique_code+"</td></tr>"
            +"<tr><td>Person Count:</td><td>"+parameters.person_count+"</td></tr>"+
            "<tr><td>Status:</td><td>"+status+"</td></tr>"+
            "<tr><td>Assigned to:</td><td>"+parameters.officer_name+"</td></tr>";

        var user_details="<tr><td>Name:</td><td>"+parameters.name+"</td></tr>"+"<tr><td>Surname:</td><td>"+parameters.surname+"</td></tr>"+"<tr><td>Email:</td><td>"+parameters.email+"</td></tr>"+"<tr><td>Dob:</td><td>"+parameters.dob+"</td></tr>"+
            +"<tr><td>Address</td><td>"+parameters.address+"</td></tr>"
            +"<tr><td>Current Address:</td><td>"+parameters.current_address+"</td></tr>"+
            "<tr><td>Office Address:</td><td>"+parameters.office_address+"</td></tr>"+
            "<tr><td>State:</td><td>"+parameters.state+"</td></tr>"+
            "<tr><td>Hopital Name:</td><td>"+parameters.hospital_name+"</td></tr>"+
            "<tr><td>Nhis Number:</td><td>"+parameters.nhis_number+"</td></tr>"+"<tr><td>Vital Info:</td><td>"+parameters.vital_info+"</td></tr>"+"<tr><td>Time & Date:</td><td>"+parameters.created_at+"</td></tr>";
        //start tracking form setting values
        $("#id").val(parameters.id);
        $("#lat").val(parameters.latitude);
        $("#lng").val(parameters.longitude);
        $("#type_of_problem").val(parameters.types_of_problem);
        //end
        //setting chat header name
        $(".chat_header h4").html("<h4>"+parameters.name+"</h4>");

        //setting mobile number in call
        $("#call_btn").attr('href','tel:'+parameters.mobile_number);

        //setting image in chatting bar
        var profile_pic='';
        if(parameters.profile_pic!=''){
            profile_pic=parameters.profile_pic;
        }else{
            profile_pic='/image/no-profile-pic.png';
        }
        $("#sender_image").attr('src',profile_pic);
        $("#sender_link").attr('href',profile_pic);
        // document.getElementById("imageThumb").setAttribute('data-src', parameters.profile_pic);
        $("#user_id").val(parameters.user_id);
        $("#user_details").html(user_details);
        $(" #emergency_details").html(emergency_details);
        $(" #append_device_details").html(device_details);
        $(" #append_locations").html(append_location_html);

    }
    // put image in chatting bar
    var image=$('#get_image_src').attr('src');
    $("#sender_image").attr('src',image); // putting image in img src
    $("#sender_link").attr('href',image); // putting link in anchor

    $("#sender_name").text($(".getname235").text()); //putting text in chatting bar haader
</script>