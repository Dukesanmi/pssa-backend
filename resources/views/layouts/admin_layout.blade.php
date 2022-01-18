<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PSSA</title>
    <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"> {{--
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}} {{--
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="{{ URL::asset('vendor/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="{{route('home')}}">
                    <img class="img-responsive" src="{{asset('app_logo.png')}}" height="40" width="40" alt="NPF Recue Me!" title="NPF App">
                    <p>PSSA Smart Alert</p>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        {{--
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>--}} {{--
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>--}}
                        <li><a href="{{route('change.password')}}"><i class="fa fa-key fa-fw"></i> Change Password</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                <a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        {{--
                        <li class="sidebar-search">--}} {{--
                            <div class="input-group custom-search-form">--}} {{--
                                <input type="text" class="form-control" placeholder="Search...">--}} {{--
                                <span class="input-group-btn">--}}
                                {{--<button class="btn btn-default" type="button">--}}
                                    {{--<i class="fa fa-search"></i>--}}
                                {{--</button>--}}
                            {{--</span>--}} {{--
                            </div>--}} {{--
                            <!-- /input-group -->--}} {{--
                        </li>--}} @if(Auth::guard('department')->check())

                        <li>
                            <a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        <li>
                            <a href="{{route('alert.index')}}"><i class="fa fa-globe fa-fw"></i> Emergency Alert</a>
                        </li>
                        <li>
                            <a href="{{route('crime.index')}}"><i class="fa fa-gavel fa-fw"></i> Crime Report</a>
                        </li>
                        <li>
                            <a href="{{route('police.index')}}"><i class="fa fa-file fa-fw"></i> Police Report</a>
                        </li>

                        <li>
                            <a href="{{route('officer.index')}}"><img class="img-responsive" src="{{asset('image/policeman_small.png')}}"> Police Officer</a>
                        </li>


                        @elseif(Auth::guard('fire')->check())
                        <li>
                            <a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        <li>
                            <a href="{{route('ambulance.index')}}"><i class="fa fa-ambulance fa-fw"></i> Ambulance Request </a>
                        </li>

                        @elseif(Auth::guard('member')->check()) @if(Auth::guard('member')->user()->dashboard==1)
                        <li>
                            <a href="{{route('member.home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @endif @if(Auth::guard('member')->user()->users==1)
                        <li>
                            <a href="{{route('member_user.index')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        @endif @if(Auth::guard('member')->user()->emergency_alert==1)
                        <li>
                            <a href="{{route('member_alert.index')}}"><i class="fa fa-warning fa-fw"></i> Emergency Alert</a>
                        </li>

                        @endif @if(Auth::guard('member')->user()->alerts_on_map==1)
                        <li>
                            <a href="{{route('member.alerts.map')}}"><i class="fa fa-globe fa-fw"></i>  Alerts on Map</a>
                        </li>

                        @endif @else

                        <li>
                            <a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        <li>
                            <a href="{{route('alert.index')}}"><i class="fa fa-warning fa-fw"></i> Emergency Alert</a>
                        </li>

                        <li>
                            <a href="{{route('alerts.map')}}"><i class="fa fa-globe fa-fw"></i> Alerts on Map</a>
                        </li>

                        <li>
                            <a href="{{route('member.index')}}"><i class="fa fa-globe fa-fw"></i>Users Role</a>
                        </li>

                        <li>
                            <a href="{{route('responder')}}"><i class="fa fa-globe fa-fw"></i>Responder</a>
                        </li>

                        <li>
                            <a href="{{route('broadcast')}}"><i class="fa fa-globe fa-fw"></i>Broadcast</a>
                        </li>

                        {{--
                        <li>--}} {{--
                            <a href="{{route('crime.index')}}"><i class="fa fa-gavel fa-fw"></i> Crime Report</a>--}} {{--
                        </li>--}} {{--
                        <li>--}} {{--
                            <a href="{{route('police.index')}}"><i class="fa fa-file fa-fw"></i> Police Report</a>--}} {{--
                        </li>--}} {{--
                        <li>--}} {{--
                            <a href="{{route('ambulance.index')}}"><i class="fa fa-ambulance fa-fw"></i> Ambulance Request </a>--}} {{--
                        </li>--}} {{--
                        <li>--}} {{--
                            <a href="{{route('officer.index')}}"><img class="img-responsive" src="{{asset('image/policeman_small.png')}}"> Police Officer</a>--}} {{--
                        </li>--}} {{----}} {{--
                        <li>--}} {{--
                            <a href="{{route('department.index')}}"><img class="img-responsive" src="{{asset('image/police-station_small.png')}}"></i> Police Department</a>--}} {{--
                        </li>--}} {{--
                        <li>--}} {{--
                            <a href="{{route('medical.index')}}"><img class="img-responsive" src="{{asset('image/fire-station_small.png')}}"></i> Medical Department</a>--}} {{--
                        </li>--}} @endif




                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @yield('content')

    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('js/locales/bootstrap-datetimepicker.fr.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendor/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('data/morris-data.js') }}"></script>
    <script src="{{ asset('dist/js/sb-admin-2.js') }}"></script>
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $('#successMessage').fadeOut('fast');
            }, 4000); // <-- time in milliseconds

        });

        $(function() {
            $("#dob").datepicker({
                maxDate: 0,
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
    @yield('script') @stack('scripts')
</body>

</html>