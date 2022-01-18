@extends('layouts.admin_layout')
@section('title', ' - View Detail Police Officer')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Police Officer Detail</h1>
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
                                <li class="breadcrumb-item"><a href="{{route('officer.index')}}">Police Officer List</a></li>
                                <li class="breadcrumb-item active">View Police Officer Detail</li>
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
                                <td>{{$user['name']}}</td>
                                <th rowspan="3">Profile Pic:</th>
                                <td rowspan="3">@if($user['profile_pic'])
                                    <img src="{{$user['profile_pic'] }}" height="150" width="200"></td>
                                @else
                                <img src="{{ asset('/image/no-image.png')}}" height="150" width="200"></td>
                                @endif</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$user['email']}}</td>

                            </tr>
                            <tr>
                               <th>Dept:</th>
                                <td class="center">
                                    {{$user['dept'] }}
                                </td>
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
                                <th>Police Id:</th>
                                <td class="center">
                                  {{$user['police_id'] }}
                                </td>
                                <th>Rank:</th>
                                <td class="center">
                                    {{$user['rank']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Dept:</th>
                                <td class="center">
                                    {{$user['dept'] }}
                                </td>
                                <th>Station:</th>
                                <td class="center">
                                     {{$user['station']}}
                                </td>
                            </tr>
                               <tr>
                                <th>Dob:</th>
                                <td class="center">
                                    {{$user['dob'] }}
                                </td>
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