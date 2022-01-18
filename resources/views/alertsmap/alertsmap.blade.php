<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{asset('/vendor/alertmap.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />



    <title>Alerts on map!</title>




  </head>
  <body>
<div class="side_bar_spacer">
<div class="w3-sidebar w3-light-grey w3-bar-block">
 <div class="logo_min"><a href="{{route('home')}}"><img src="{{asset('app_logo.png')}}" alt="Car" style="width:100%"><span>PSSA Smart Alert</span></a></div>
  
<!-- ..........................................................inpunt type start.................................................................... -->
  <div class="search_custom">
          <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..."  id="searchEmergency" onkeyup="searchEmergency()">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
         </div>


    <div class="search_custom2">                                    
  <!-- <div class="dropdown2">
    <button type="button custom-style" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Dropdown button
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Link 1</a>
      <a class="dropdown-item" href="#">Link 2</a>
      <a class="dropdown-item" href="#">Link 3</a>
    </div>
  </div> -->


<!-- ..........................................................inpunt type close.................................................................... -->

  </div>
  <div class="content_list_side_bar_slide" >
  <div class="content_list_side_bar" >
     <ul id="em_list" style=" overflow: scroll;height: 100vh;width: 100%;">
      

     </ul>
   </div>
</div>
 
</div>
</div>

<!-- Page Content -->
<!-- <div style="margin-left:15%"> -->
    <div class="map_full_box">
<div class="map_box_doc" style="    height: 100vh;
">



<div id="map">
 
  </div>




       <div class="map_iner_content" style="display:none;">
        <div class="table_hadding">
          <h3>Case Details</h3> 
        
 <div class="table_scrol_bar">
    <div class="table_scrol_inner">
<table class="table table-striped">
  <!-- <tr >
    <th style="background: #ff5000; width: 50%";>User Details</th>
    <th style="background: #ff5000; width: 50%; "></th>
    <th style="background: #ff5000; width: 50%; "></th>
  
  </tr> -->
 

  <tbody>
        
  <tr>
    <td>Full Name: </td>
    <td id="name"> </td>

   
  </tr>
  <tr>
    <td>Address:</td>
    <td id="address"></td>
    
  </tr>
  <tr>
    <td>Email</td>
    <td id="email"></td>
    
  </tr>

  <!-- <tr>
    <td>State</td>
    <td id="state"></td>
    
  </tr> -->


  <tr>
    <td>Office Address: </td>
    <td id="office_address"></td>
    
  </tr>
  <tr>
    <td>Mobile Number:</td>
    <td id="mobile_number"></td>
   
  </tr>
  <tr>
    <td>Gender: </td>
    <td id="gende"></td>
    
  </tr>
    <tr>
    <td>Case Id:  </td>
    <td id="case_id"></td>
    
  </tr>
  <tr>
    <td>Network Provider: </td>
    <td id="network_provider"></td>
    
  </tr>
  <tr>
    <td>Latitude: </td>
    <td id="latitude"></td>
    
  </tr>
  <tr>
    <td>Longitude:  </td>
    <td id="longitude"></td>
   
  </tr>
  <tr>
    <td>Network Strength: </td>
    <td id="network_strength"></td>
   
  </tr>
  <tr>
    <td>Emergency Address</td>
    <td id="em_address"></td>
    
  </tr>

  <tr>
    <td>Type Of Problem</td>
    <td id="problem"></td>
    
  </tr>

  <tr>
    <td>Person Count: </td>
    <td id="person_count"></td>
    
  </tr>

  <tr>
    <td>Battery Level:   </td>
    <td id="battery"></td>
    
  </tr>


</tbody>
</table>
</div>
    </div>
       </div>
       </div>

</div>
</div>











<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    


<script>

      let map;



     let page_count = 0;

     
    $("#em_list").on('scroll',function(){
      if($(this).scrollTop() + $(this).innerHeight() > $(this)[0].scrollHeight) {
            page_count++

           emergencyList();
          }
    })









  
function emergencyList()
{
 $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

let emergencySearch = $("#searchEmergency").val();
        
let url
@if(Auth::guard('member')->check())

url = "{{route('member.alerts.map')}}"

@else
url = "{{route('alerts.map')}}"

@endif
    $.ajax({
            type: "POST",
            url: url,
            data:{page_count:page_count?page_count:0},
            success: function (data) {
              let alertData = JSON.parse(data);
              if(page_count===0)
              {
               
              intitiateMap(alertData)
            }
              let appendData=[];
             
            

              $.each(alertData,function(index,result){
                appendData=` <a onclick="getAlertInfo(${result.id})"> <li>${result.alerts_map.name} is in ${result.types_of_problem} (${result.unique_code}) @ ${result.em_address}</li> <span> ${result.created_at} </span> </a>`;
                $("#em_list").append(appendData);
              })

                }
          });
  }








  function searchEmergency()
{ page_count=0;
 $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

let emergencySearch = $("#searchEmergency").val();
        
let url
@if(Auth::guard('member')->check())

url = "{{route('member.alerts.map')}}"

@else
url = "{{route('alerts.map')}}"

@endif
    $.ajax({
            type: "POST",
            url: url,
            data:{page_count:0,search_key:emergencySearch},
            success: function (data) {
              let alertData = JSON.parse(data);
              if(page_count===0)
              {
               
              intitiateMap(alertData)
            }
              let appendData=[];
             
             $("#em_list").empty();
            

            
              $.each(alertData,function(index,result){
                appendData=` <a onclick="getAlertInfo(${result.id})"> <li>${result.alerts_map.name} is in ${result.types_of_problem} (${result.unique_code}) @ ${result.em_address}</li> <span> ${result.created_at} </span> </a>`;
                $("#em_list").append(appendData);
              })

                }
          });
  }








     

     window.onload = function() {
  emergencyList();
};





  











 function intitiateMap(alertData=null) {
if(alertData.length===0)
  {
     map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 6,
  });
  }
  else
  { 
    map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: parseFloat(alertData[0].latitude), lng: parseFloat(alertData[0].longitude)},
    zoom: 6,
  });


$.each(alertData,function(index,result){

   new google.maps.Marker({
    position:{lat:parseFloat(result.latitude), lng:parseFloat(result.longitude)},
    map,
    title:result.alerts_map.name,
  });
})
  }
  }

  function detailLatLng(latlng)
  {
    map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: parseFloat(latlng.latitude), lng: parseFloat(latlng.longitude) },
    zoom: 8,
  });

    new google.maps.Marker({
    position:{lat:parseFloat(latlng.latitude), lng:parseFloat(latlng.longitude)},
    map,
    title:latlng.alerts_map.name,
  });

  }



 


function  getAlertInfo(id)
{
  $.ajax({
            type: "POST",
            url: '{{route("get.detail.alerts.map")}}',
            data:{id:id},
            success: function (data) {
              let info=JSON.parse(data)
              $("#name").html(info.alerts_map.name)
              $("#address").html(info.alerts_map.address)
              $("#email").html(info.alerts_map.email)
              $("#office_address").html(info.alerts_map.office_address)
              $("#mobile_number").html(info.alerts_map.mobile_number)
              if(info.alerts_map.gender===2)
              {
                     $("#gender").html('male')
              }

              else if(info.alerts_map.gender===3)
              {
                $("#gender").html('female')
              }

              else
              {
                $("#gender").html('other')
              }
           
              $("#case_id").html(info.unique_code)
              $("#network_provider").html(info.network_provider)
              $("#latitude").html(info.latitude)
              $("#longitude").html(info.longitude)
              $("#network_strength").html(info.network_strength)
              $("#em_address").html(info.em_address)
              $("#problem").html(info.types_of_problem)
              $("#person_count").html(info.person_count)
              $("#battery").html(info.battery_label)

              detailLatLng(info)
               $("#map").css("height","60%");
  $(".map_iner_content").css({"height":"40%","display":"block"});
            } 

          });

}







</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCnPPUlxFHB2SfT50yFeYrPDOpw85HxIk&callback=intitiateMap&libraries=&v=weekly"></script>


  </body>
</html>