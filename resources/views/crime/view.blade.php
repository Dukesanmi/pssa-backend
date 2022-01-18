@extends('layouts.admin_layout')
@section('title', ' - View Detail Crime Report')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Crime Report Detail</h1>
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
                                <li class="breadcrumb-item"><a href="{{route('crime.index')}}">Crime Report List</a></li>
                                <li class="breadcrumb-item active">View Crime Report Detail</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{$crimeReport['name']}}</td>
                                <th rowspan="3">Profile Pic</th>
                                <td rowspan="3">
                                    @if($crimeReport['profile_pic'])
                                    <img src="{{$crimeReport['profile_pic']}}" height="50" width="75">
                                    @else
                                    <img src="{{ asset('/image/no-image.png')}}" height="50" width="75">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surname:</th>
                                <td>{{$crimeReport['surname']}}</td>

                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$crimeReport['email']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td>{{$crimeReport['mobile_number']}}</td>
                              <!--   <th>Text:</th>
                                <td>{{$crimeReport['text']}}</td> -->
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$crimeReport['address']}}</td>
                                <th>State:</th>
                                <td>{{$crimeReport['state']}}</td>
                            </tr> 
                             <tr>
                                <th>Directions:</th>
                                <td>
                                    <a href="http://maps.google.com/?q={{$crimeReport['latitude']}},{{$crimeReport['longitude']}}">Visit Your location!</a>

                                
                            </td>
                    
                            </tr>
                            <tr>
                                <th>Office Address:</th>
                                <td class="center">
                                  {{$crimeReport['office_address']}}
                                </td>
                                <th>Phone Verified:</th>
                                <td class="center">
                                    @if($crimeReport['phone_verified'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Current Address:</th>
                                <td class="center">
                                 {{$crimeReport['current_address']}}
                                </td>
                                  <th>Gender:</th>
                                <td class="center">
                                      @if($crimeReport['gender'] == '0')
                                        {{'Female'}}
                                    @else
                                        {{'Male'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Hospital Name:</th>
                                <td class="center">
                                   {{$crimeReport['hospital_name']}}
                                </td>
                                <th>Blood Group:</th>
                                <td class="center">
                                  {{$crimeReport['blood_group']}}
                                </td>
                            </tr>
                            <tr>
                                <th>NHIS Number:</th>
                                <td class="center">
                                    {{$crimeReport['nhis_number']}}
                                </td>
                           
                                <th>Allergy:</th>
                                <td class="center">
                                    {{$crimeReport['allergy']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Medicine:</th>
                                <td class="center">
                                    {{$crimeReport['medicine']}}
                                </td>
                         
                                <th>Vital Info:</th>
                                <td class="center">
                                    {{$crimeReport['vital_info']}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item active">View Crime Report Detail</li>
                        </ol>
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                    
                            <tr>
                                <th>Case Id:</th>
                                <td>{{$crimeReport['unique_code']}}</td>
                                <th>Nature of crime:</th>
                                <td>{{$crimeReport['nature_of_crime']}}</td>
                            </tr>
                            <tr>
                                <th>Latitude:</th>
                                <td>{{$crimeReport['latitude']}}</td>
                                <th>Longitude:</th>
                                <td>{{$crimeReport['longitude']}}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{$crimeReport['state']}}</td>
                                <th>Recording:</th>
                                <td>

                                <audio controls>
                                <source src="{{$crimeReport['audio']}}" type='audio/mp3'>
                                Your browser does not support the audio tag.
                                </audio>
                                </td>
                            </tr>
                            <tr>
                                <th>LGA:</th>
                                <td class="center">
                                  {{$crimeReport['lga']}}
                                </td>
                                <th>Location:</th>
                                <td class="center">
                                 {{$crimeReport['location']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Neighbour Address:</th>
                                <td class="center">
                                 {{$crimeReport['neighbour_address']}}
                                </td>
                                <th>Report:</th>
                                <td class="center">
                                 {{$crimeReport['report']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Contacted More Info:</th>
                                <td class="center">
                                  @if($crimeReport['contacted_more_info'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </td>
                                <th>Contact Type:</th>
                                <td class="center">
                                  @if($crimeReport['contact_type'] == '0')
                                        {{'Call'}}
                                    @else
                                        {{'Chat'}}
                                    @endif
                                </td>
                            </tr>
                         
                            </tbody>
                        </table>

                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Files</th>
                           
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getCrimeReportFiles))
                      
                                @foreach($getCrimeReportFiles as $crimeReportFile)

                                    <tr class="odd gradeX">
                                        <td><img src="{{$crimeReportFile->file}}" height="50" width="75"></td>
                                     
                                    </tr>
                                
                                @endforeach

                            @else

                                <tr class="odd gradeX">
                                    <td colspan="7" align="center">No file found</td>

                                </tr>

                            @endif

                            </tbody>
                        </table>

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
