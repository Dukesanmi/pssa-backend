<!DOCTYPE html>
<html>
<head>
    <title>Emergency Alert- PDF</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading">
                </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <ol class="breadcrumb inner_bread">
                    <li class="breadcrumb-item active">Users's Emergency Details: 
                        @if($emergencyAlert['status']==1)
                        <p style="float: right;color:#ff3737; font-weight:bold;">{{'To Do'}}</p>
                        @elseif($emergencyAlert['status']==2)
                        <p style="float: right;color: #e3aa21; font-weight:bold;">{{'In Progress'}}</p>
                        @elseif($emergencyAlert['status']==3)
                        <p style="float: right;color: #337ab7; font-weight:bold;">{{'In Complete'}}</p>
                        @elseif($emergencyAlert['status']==4)   
                        <p style="float: right;color: #0abb87; font-weight:bold;">{{'Complete'}}</p> 
                        @endif
                        
                    </li>

                </ol>
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

        <tbody>
       

        <tr>
            <th>Full Name:</th>
            <td>{{$emergencyAlert['name']}} {{$emergencyAlert['surname']}}</td>
            <th>Email:</th>
            <td><a href="mailto:{{$emergencyAlert['email']}}">{{$emergencyAlert['email']}}</a></td>

        </tr>
        <tr>
            <th>Mobile Number:</th>
            <td><a href="tel:{{$emergencyAlert['mobile_number']}}">{{$emergencyAlert['mobile_number']}}</a></td>
            <th>Directions:</th>
            <td>
                <a href="http://maps.google.com/?q={{$emergencyAlert['latitude']}},{{$emergencyAlert['longitude']}}">View location in map</a>


            </td>

        </tr>


        <tr>
            <th>Permanent Address:</th>
            <td class="center">
                {{$emergencyAlert['address']}},{{$emergencyAlert['user_state']}},{{$emergencyAlert['country']}}
            </td>
            <th>Gender:</th>
            <td class="center">
                @if($emergencyAlert['gender'] == '1')
                    {{'Other'}}
                @elseif($emergencyAlert['gender']=='2')
                    {{'Male'}}
                @else
                    {{'FeMale'}}
                @endif
            </td>
        </tr>
        <tr>
            <th>Office Address:</th>
            <td class="center">
                {{$emergencyAlert['office_address']}}
            </td>
            <th>Phone Verified:</th>
            <td class="center">
                @if($emergencyAlert['phone_verified'] == '0')
                    {{'No'}}
                @else
                    {{'Yes'}}
                @endif
            </td>
        </tr>

        <tr>
            <th>Hospital Name:</th>
            <td class="center">
                {{$emergencyAlert['hospital_name']}}
            </td>
            <th>Blood Group:</th>
            <td class="center">
                {{$emergencyAlert['blood_group']}}
            </td>
        </tr>
        <tr>
            <th>NHIS Number:</th>
            <td class="center">
                {{$emergencyAlert['nhis_number']}}
            </td>

            <th>Allergy:</th>
            <td class="center">
                {{$emergencyAlert['allergy']}}
            </td>
        </tr>
        <tr>
            <th>Medicine:</th>
            <td class="center">
                {{$emergencyAlert['medicine']}}
            </td>

            <th>Vital Info:</th>
            <td class="center">
                {{$emergencyAlert['vital_info']}}
            </td>
        </tr>
        <tr>
            @if($emergencyAlert['status'] == 3)
                <th>Status:</th>
                <td class="center">
                    {{'Incomplete'}}
                </td>

            @elseif($emergencyAlert['status'] == 4)
                <th>Status:</th>
                <td class="center">
                    {{'Complete'}}
                </td>
            @endif
        </tr>
        </tbody>
    </table>
                <ol class="breadcrumb inner_bread">
                    <li class="breadcrumb-item active">Emergency Alert Detail</li>
                </ol>
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

        <tbody>
       

        <tr>
            <th>Case Id:</th>
            <td>{{$emergencyAlert['unique_code']}}</td>
            <th>Network Provider:</th>
            <td>{{$emergencyAlert['network_provider']}}</td>
        </tr>
        <tr>
            <th>Latitude:</th>
            <td>{{$emergencyAlert['latitude']}}</td>
            <th>Longitude:</th>
            <td>{{$emergencyAlert['longitude']}}</td>
        </tr>
        <tr>
            <th>Network Strength:</th>
            <td>{{$emergencyAlert['network_strength']}}</td>
            <th>Recording:</th>
            <td>

                <audio controls>

                    <source src="{{$emergencyAlert['recording']}}" type='audio/mp3'>


                </audio>

            </td>
        </tr>

        <tr>
            <th>Current Address:</th>
            <td class="center">
                {{$emergencyAlert['current_address']}}
            </td>
            <th>Battery Level:</th>
            <td class="center">
                {{$emergencyAlert['battery_label']}}
            </td>
        </tr>
        <tr>
            @if(isset($emergencyalert['landmark']))
            <th>Landmark:</th>
            <td>
                {{$emergencyAlert['landmark']}}
            </td>
            @endif
            <th>Person Count:</th>
            <td class="center">
                {{$emergencyAlert['person_count']}}
            </td>
        </tr>
        <tr>
            <th>Evidence File:</th>

            <td class="center">
                {{$emergencyAlert['count']}}
            </td>
            <th>Type of Problem:</th>

            <td class="center">
                {{$emergencyAlert['types_of_problem']}}
            </td>
        </tr>
        <tr>
            @if(isset($emergencyAlert['reason']))
                <th>Reason:</th>
                <td>{{$emergencyAlert['reason']}}</td>
            @endif
            <th>Emergency Date and Time</th>
            <td>{{convertTimeZoneWithoutFormat('NG',$emergencyAlert['created_at'])}}</td>
        </tr>

        </tr>
        </tbody>
    </table>
    <ol class="breadcrumb inner_bread">
                                <li class="breadcrumb-item active">Media Files</li>
                            </ol>
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">


        <tbody>
                
                            <tr>
                                <td >
                                @foreach($getEmergencyAlertFiles as $files)
                                  
                                    <img src="{{$files->file}}" height="100px" width="100px" style="margin-right: 5px;">

                                @endforeach
                                </td>
                            </tr>
                       
                </tbody>
    </table>
                
    

                
    
    
 <!-- /.table-responsive -->
         
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
</div>
</body>
</html>