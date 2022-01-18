<!DOCTYPE html>
<html>
  <head>
    <title>Tracking</title>
    <style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
        </style>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  </head>
  <body>
      <input type = 'hidden' id ='lat' value = "{{$data->latitude}}" />
      <input type = 'hidden' id ='lng' value = "{{$data->longitude}}" />
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->


    <script>
        let lat = $("#lat").val();
        let lng = $("#lng").val();
         
        
const citymap = {
  chicago: {
    center: { lat: parseFloat(lat), lng: parseFloat(lng) },
    population: 2714856,
  },
 
};

function initMap() {
  // Create the map.
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: { lat: parseFloat(lat), lng: parseFloat(lng) },
    mapTypeId: "terrain",
  });
  new google.maps.Marker({
    position: { lat: parseFloat(lat), lng: parseFloat(lng) },
    map,
    title: "Emergency Location",
  });

  // Construct the circle for each value in citymap.
  // Note: We scale the area of the circle based on the population.
  for (const city in citymap) {
    // Add the circle for this city to the map.
    const cityCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: citymap[city].center,
      radius: Math.sqrt(citymap[city].population) * 100,
    });
  }
}
        </script>
        
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCnPPUlxFHB2SfT50yFeYrPDOpw85HxIk&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>