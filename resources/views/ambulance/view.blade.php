@extends('layouts.admin_layout')
@section('title', ' - View Detail Ambulance Request')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ambulance Request Detail</h1>
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
                                <li class="breadcrumb-item"><a href="{{route('crime.index')}}">Ambulance Request List</a></li>
                                <li class="breadcrumb-item active">View Ambulance Request Detail</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                      <!--       <tr>
                                <th>Full Name:</th>
                                <td>{{$ambulanceRequest['name']}}</td>
                                <th rowspan="3">Profile Pic</th>
                                <td rowspan="3"><img src="{{$ambulanceRequest['profile_pic']}}" height="50" width="75"></td>
                            </tr>
                            <tr>
                                <th>Surname:</th>
                                <td>{{$ambulanceRequest['surname']}}</td>

                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$ambulanceRequest['email']}}</td>
                            </tr> -->
                             <tr>
                                <th>Full Name:</th>
                                <td>{{$ambulanceRequest['name']}} {{$ambulanceRequest['surname']}}</td>
                                 <th>Email:</th>
                                <td>{{$ambulanceRequest['email']}}</td>

                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td>{{$ambulanceRequest['mobile_number']}}</td>
                              <!--   <th>Text:</th>
                                <td>{{$ambulanceRequest['text']}}</td> -->
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$ambulanceRequest['address']}}</td>
                                <th>State:</th>
                                <td>{{$ambulanceRequest['state']}}</td>
                            </tr>
                               <tr>
                                <th>Directions:</th>
                                <td>
                                    <a href="http://maps.google.com/?q={{$ambulanceRequest['latitude']}},{{$ambulanceRequest['longitude']}}">Visit Your location!</a>

                                
                            </td>
                    
                            </tr>
                            <tr>
                                <th>Office Address:</th>
                                <td class="center">
                                  {{$ambulanceRequest['office_address']}}
                                </td>
                                <th>Phone Verified:</th>
                                <td class="center">
                                    @if($ambulanceRequest['phone_verified'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Current address:</th>
                                <td class="center">
                                 {{$ambulanceRequest['current_address']}}
                                </td>
                              <th>Gender:</th>
                                <td class="center">
                                      @if($ambulanceRequest['gender'] == '0')
                                        {{'Female'}}
                                    @else
                                        {{'Male'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Hospital Name:</th>
                                <td class="center">
                                   {{$ambulanceRequest['hospital_name']}}
                                </td>
                                <th>Blood Group:</th>
                                <td class="center">
                                  {{$ambulanceRequest['blood_group']}}
                                </td>
                            </tr>
                            <tr>
                                <th>NHIS number:</th>
                                <td class="center">
                                    {{$ambulanceRequest['nhis_number']}}
                                </td>
                           
                                <th>Allergy:</th>
                                <td class="center">
                                    {{$ambulanceRequest['allergy']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Medicine:</th>
                                <td class="center">
                                    {{$ambulanceRequest['medicine']}}
                                </td>
                         
                                <th>Vital Info:</th>
                                <td class="center">
                                    {{$ambulanceRequest['vital_info']}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item active">View Ambulance Request Detail</li>
                        </ol>
                        <div class="table-responsive">
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                    
                            <tr>
                                <th>Case Id:</th>
                                <td>{{$ambulanceRequest['unique_code']}}</td>
                                <th>Nature Of Incedent:</th>
                                <td>{{$ambulanceRequest['nature_of_incedent']}}</td>
                            </tr>
                            <tr>
                                <th>Latitude:</th>
                                <td>{{$ambulanceRequest['latitude']}}</td>
                                <th>Longitude:</th>
                                <td>{{$ambulanceRequest['longitude']}}</td>
                            </tr>
                        
                            <tr>
                                <th>Hospital Name:</th>
                                <td class="center">
                                  {{$ambulanceRequest['hospital_name']}}
                                </td>
                                <th>Location:</th>
                                <td class="center">
                                 {{$ambulanceRequest['location']}}
                                </td>
                            </tr>
                            <tr>
                            <th>Number Of Pperson:</th>
                                <td>{{$ambulanceRequest['number_of_person']}}</td>
                               
                                <th>Name:</th>
                                <td class="center">
                                 {{$ambulanceRequest['name']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td class="center">
                                 {{$ambulanceRequest['am_mobile_number']}}
                                </td>
                                <th>Medication:</th>
                                <td class="center">
                                 @if($ambulanceRequest['medication'] == '0')
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
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
