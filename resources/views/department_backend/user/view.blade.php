@extends('department_backend.layouts.admin_layout')
@section('title', ' - View Detail User')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User Detail</h1>
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
                                <li class="breadcrumb-item"><a href="{{route('department.home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('department.users','list')}}">User List</a></li>
                                <li class="breadcrumb-item active">View User Detail</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{$user['name']}}</td>
                                <th rowspan="3">Profile Pic:</th>
                                <td rowspan="3">
                                    @if($user['profile_pic'])
                                    <img src="{{$user['profile_pic'] }}" height="150" width="200"></td>
                                    @else
                                    <img src="{{ asset('/image/no-image.png')}}" height="150" width="200"></td>
                                @endif
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$user['email']}}</td>

                            </tr>
                            <tr>
                                <th>Surname:</th>
                                <td>{{$user['surname']}}</td>
                            </tr>
                            <tr>
                                <th>Country Code:</th>
                                <td>{{$user['country_code']}}</td>
                                <th>Mobile Number:</th>
                                <td>{{$user['mobile_number']}}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$user['address']}}</td>
                                <th>State:</th>
                                <td>{{$user['state']}}</td>
                            </tr>
                            <tr>
                                <th>Office Address:</th>
                                <td>{{$user['office_address']}}</td>
                                <th>Current Address:</th>
                                <td>{{$user['current_address']}}</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td class="center">
                                    @if($user['gender'] == '0')
                                        {{'Other'}}
                                    @elseif ($user['gender'] == '1')
                                        {{'Female'}}
                                    @else 
                                        {{'Male'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Hospital name:</th>
                                <td class="center">
                                  {{$user['hospital_name'] }}
                                </td>
                                <th>Blood group:</th>
                                <td class="center">
                                    {{$user['blood_group']}}
                                </td>
                            </tr>
                            <tr>
                                <th>NHIS number:</th>
                                <td class="center">
                                    {{$user['nhis_number'] }}
                                </td>
                                <th>Allergy:</th>
                                <td class="center">
                                     {{$user['allergy']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Medicine:</th>
                                <td class="center">

                                    {{$user['medicine']}}

                                </td>
                                <th>Vital Info:</th>
                                <td class="center">

                                    {{$user['vital_info']}}

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