@extends('layouts.admin_layout')
@section('title', ' - View Detail Department')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Medical Department Detail</h1>
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
                                <li class="breadcrumb-item"><a href="{{route('medical.index')}}">Medical Department List</a></li>
                                <li class="breadcrumb-item active">View Medical Department Detail</li>
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
                                    <img src="{{$user['profile_pic'] }}" height="50" width="75"></td>
                                @else
                                <img src="{{ asset('/image/no-image.png')}}" height="50" width="75"></td>
                                @endif</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$user['email']}}</td>

                            </tr>
                            <tr>
                               <th>Country Code:</th>
                                <td class="center">
                                    {{$user['country_code'] }}
                                </td>
                            </tr>
                            <tr>
                                
                                <th>Mobile Number:</th>
                                <td>{{$user['mobile_number']}}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$user['address']}}</td>
                                <th>State:</th>
                                <td>{{$user['state']}}</td>
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