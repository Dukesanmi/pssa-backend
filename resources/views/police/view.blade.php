@extends('layouts.admin_layout')
@section('title', ' - View Detail Police Report')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Police Report Detail</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('police.index')}}">Police Report List</a></li>
                                <li class="breadcrumb-item active">View Police Report Detail</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{$policeReport['name']}}</td>
                                <th rowspan="3">Profile Pic</th>
                                <td rowspan="3">
                                    @if($policeReport['profile_pic'])
                                    <img src="{{$policeReport['profile_pic']}}" height="50" width="75">
                                    @else
                                    <img src="{{ asset('/image/no-image.png')}}" height="50" width="75">
                                    @endif
                                </td></td>
                            </tr>
                            <tr>
                                <th>Surname:</th>
                                <td>{{$policeReport['surname']}}</td>

                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$policeReport['email']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td>{{$policeReport['mobile_number']}}</td>
                                <th>Text:</th>
                                <td>{{$policeReport['text']}}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$policeReport['address']}}</td>
                                <th>State:</th>
                                <td>{{$policeReport['state']}}</td>
                            </tr>
                                 <tr>
                                <th>Directions:</th>
                                <td>
                                    <a href="http://maps.google.com/?q={{$policeReport['latitude']}},{{$policeReport['longitude']}}">View location in map</a>

                                
                            </td>
                    
                            </tr>
                            <tr>
                                <th>Office Address:</th>
                                <td class="center">
                                  {{$policeReport['office_address']}}
                                </td>
                                <th>Phone Verified:</th>
                                <td class="center">
                                    @if($policeReport['phone_verified'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Current address:</th>
                                <td class="center">
                                 {{$policeReport['current_address']}}
                                </td>
                                <th>Gender:</th>
                                <td class="center">

                                         @if($policeReport['gender'] == '1')
                                                {{'Male'}}
                                            @elseif($policeReport['gender'] == '2')
                                                        {{'Female'}}

                                           @else
                                                  
                                            {{'Other'}}
                                            @endif
                               
                                </td>
                            </tr>
                            <tr>
                                <th>Hospital Name:</th>
                                <td class="center">
                                   {{$policeReport['hospital_name']}}
                                </td>
                                <th>Blood Group:</th>
                                <td class="center">
                                  {{$policeReport['blood_group']}}
                                </td>
                            </tr>
                            <tr>
                                <th>NHIS number:</th>
                                <td class="center">
                                    {{$policeReport['nhis_number']}}
                                </td>
                           
                                <th>Allergy:</th>
                                <td class="center">
                                    {{$policeReport['allergy']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Medicine:</th>
                                <td class="center">
                                    {{$policeReport['medicine']}}
                                </td>
                         
                                <th>Vital Info:</th>
                                <td class="center">
                                    {{$policeReport['vital_info']}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item active">View Crime Report Detail</li>
                        </ol>
                        <div class="table-responsive">
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                    
                            <tr>
                                <th>Case Id:</th>
                                <td>{{$policeReport['unique_code']}}</td>
                                <th>Reason:</th>
                                <td>{{$policeReport['reason']}}</td>
                            </tr>
                            <tr>
                                <th>Latitude:</th>
                                <td>{{$policeReport['latitude']}}</td>
                                <th>Longitude:</th>
                                <td>{{$policeReport['longitude']}}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{$policeReport['state']}}</td>
                                <th>Recording:</th>
                                <td>

                                <audio controls>
                                <source src="{{$policeReport['audio']}}" type='audio/mp3'>
                                Your browser does not support the audio tag.
                                </audio>
                                </td>
                            </tr>
                            <tr>
                                <th>LGA:</th>
                                <td class="center">
                                  {{$policeReport['lga']}}
                                </td>
                                <th>Location:</th>
                                <td class="center">
                                 {{$policeReport['location']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Duty Address:</th>
                                <td class="center">
                                 {{$policeReport['duty_address']}}
                                </td>
                                <th>Report:</th>
                                <td class="center">
                                 {{$policeReport['report']}}
                                </td>
                            </tr>
                          <tr>
                                <th>Contacted More Info:</th>
                                <td class="center">
                                  @if($policeReport['contacted_more_info'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </td>
                                <th>Contact Type:</th>
                                <td class="center">
                                  @if($policeReport['contact_type'] == '0')
                                        {{'Call'}}
                                    @else
                                        {{'Chat'}}
                                    @endif
                                </td>
                            </tr>
                         
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Files</th>
                           
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getPoliceReportFiles))
                           
                                @foreach($getPoliceReportFiles as $policeReportFile)

                                    <tr class="odd gradeX">
                                        <td><img src="{{$policeReportFile->file}}" height="50" width="75"></td>
                                     
                                    </tr>
                                  
                                @endforeach

                            @else

                                <tr class="odd gradeX">
                                    <td colspan="7" align="center">No file found</td>

                                </tr>

                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                         <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Department Detail</li>
                        </ol>



                            <tbody>
                    
                            <tr>
                                <th>Full Name:</th>
                                <td>{{$emergencyDepartmentInfo['name']}} {{$emergencyDepartmentInfo['surname']}}</td>
                                <th>Email:</th>
                                <td>{{$emergencyDepartmentInfo['email']}}</td>

                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td>{{$emergencyDepartmentInfo['mobile_number']}}</td>
                               <!--  <th>Text:</th>
                                <td>{{$emergencyDepartmentInfo['text']}}</td> -->
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$emergencyDepartmentInfo['address']}}</td>
                                <th>State:</th>
                                <td>{{$emergencyDepartmentInfo['state']}}</td>
                            </tr>
                      
                            <tr>
                                <th>City:</th>
                                <td class="center">
                                {{$emergencyDepartmentInfo['city']}}
                                </td>
                               
                            </tr>
                          
                            </tbody>

                        </table>
                    </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
@endsection
