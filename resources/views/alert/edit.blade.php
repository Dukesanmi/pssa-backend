@extends('layouts.admin_layout')
@section('title', ' - Assign Officer')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Assign Officer</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('alert.index')}}">Emergency Alert List</a></li>
                            <li class="breadcrumb-item active">Assign Officer</li>
                        </ol>
                    </div>
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
                    <div class="panel-body">

                        <div class="col-sm-12">
                            <form method="post" action="{{route('alert.change_officer_update',$id)}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                {{ method_field('PUT') }}

                                <div class="card mb-3">
                                    <div class="card-header">
                                        Assign Officer
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleInputName">Officer:<span>*</span></label>
                                                    <select class="form-control" name="officer" required>

                                                        <option value=""> --Officer-- </option>

                                                            @if(!empty($getOfficer))
                                                                @foreach($getOfficer as $officer)
                                                                <option value="{{$officer['id']}}">{{$officer['name']}}</option>
                                                                @endforeach
                                                            @endif
                                  
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary register mt-15">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
