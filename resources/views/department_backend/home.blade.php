@extends('department_backend.layouts.admin_layout')
@section('title', ' - Dashboard')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-primary panel_user">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$userCount}}</div>
                                <div>Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('user.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-emergency">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-warning fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$emergencyAlertCount}}</div>
                                <div>Emergency Alert</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('alert.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-gavel fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$reportCrimeCount}}</div>
                                <div>Crime Report!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('crime.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file fa-5x"></i>

                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$reportPolicieCount}}</div>
                                <div>Police Report!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('police.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
         
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-police">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <!--<i class="fa fa-users fa-5x"></i>-->
                                <img class="img-responsive" src="{{asset('image/policeman.png')}}">
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$officerCount}}</div>
                                <div>Police Officer!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('officer.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                               <!-- <i class="fa fa-building-o fa-5x"></i>--->
                                <img class="img-responsive" src="{{asset('image/police-station.png')}}">
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$departmentCount}}</div>
                                <div>Police Department!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('department.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    </div>
@endsection
