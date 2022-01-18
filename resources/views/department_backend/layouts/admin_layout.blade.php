<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Config::get('constants.APP_NAME') }}@yield('title')</title>
    <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    {{--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="{{ URL::asset('vendor/custom.css') }}" rel="stylesheet">


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
                <img class="img-responsive" src="{{asset('image/NPEA Logo.png')}}" height="40" width="40" alt="NPF Recue Me!" title="NPF App">
                <p>NPF Recue Me!</p>

            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>--}}
               
                    <li><p><b>Officer Department</b></p>
                        <form id="logout-form"  action="{{ route('department.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <a href="{{ route('department.logout') }}"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
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
                    {{--<li class="sidebar-search">--}}
                        {{--<div class="input-group custom-search-form">--}}
                            {{--<input type="text" class="form-control" placeholder="Search...">--}}
                                {{--<span class="input-group-btn">--}}
                                {{--<button class="btn btn-default" type="button">--}}
                                    {{--<i class="fa fa-search"></i>--}}
                                {{--</button>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--<!-- /input-group -->--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{route('department.home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('department.users','list')}}"><i class="fa fa-users fa-fw"></i> Users</a>
                    </li>
                    <li>
                        <a href="{{route('alert.index')}}"><i class="fa fa-file fa-fw"></i> Emergency Alert</a>
                    </li>
                     <li>
                        <a href="{{route('crime.index')}}"><i class="fa fa-file fa-fw"></i> Crime Report</a>
                    </li>
                     <li>
                        <a href="{{route('police.index')}}"><i class="fa fa-file fa-fw"></i> Police Report</a>
                    </li>
                     {{--<li>--}}
                        {{--<a href="{{route('ambulance.index')}}"><i class="fa fa-ambulance fa-fw"></i>Ambulance Request </a>
                    {{--</li>--}}
                     <li>
                        <a href="{{route('officer.index')}}"><i class="fa fa-users fa-fw"></i> Police Officer</a>
                    </li>
                    <!--   <li>
                        <a href="{{route('department.department.users','list')}}"><i class="fa fa fa-building-o fa-fw"></i>Police Department</a>
                    </li> -->
                    {{--<li>--}}
                        {{--<a href="{{route('fire.index')}}"><i class="fa fa fa-building-o fa-fw"></i>Fire Department</a>--}}
                    {{--</li>--}}
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

<script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('vendor/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('data/morris-data.js') }}"></script>
<script src="{{ asset('dist/js/sb-admin-2.js') }}"></script>
<script>
    $(document).ready(function(){

        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 4000); // <-- time in milliseconds

    });
</script>
@yield('script')
@stack('scripts')
</body>
</html>
