@extends('layouts.admin_layout')
@section('title', ' - Broadcast')
@section('style')
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div id="page-wrapper" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-bullhorn fa-fw" style="transform: rotate(325deg);"></i> PSSA Emergency Broadcast System (PSSA-EBS)</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

          <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default" id="broad_panel">
                    <!-- <div class="panel-heading">
                        <div class="panel-heading">
                            <ol class="breadcrumb col-md-4 col-sm-4">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('broadcast')}}">Broadcast Message</a></li>
                            </ol>
                           
                        </div>
                    </div> -->

                         @if(session()->has('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                    <!-- /.panel-heading -->
                    <div class="panel-body broadcast_body">
                        @if(Auth::guard('member')->check())
                    <form action="{{route('member.broadcast')}}" method="POST" id="broadcastForm" enctype="multipart/form-data">

                        @else
                    <form action="{{route('broadcast')}}" method="POST" id="broadcastForm" enctype="multipart/form-data">

                        @endif
                         @csrf
    					<div class="form-group">
                            <label ><i class="icofont-ui-message"></i> Message:</label>
                            <textarea class="form-control" rows="10" id="message" name="message" placeholder="Enter your Message" required></textarea>
    					</div>
    					<button class="btn btn-primary broad" type="submit">Broadcast Message</button>
  						</form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

</div>
@endsection
@section("script")
    
@endsection
