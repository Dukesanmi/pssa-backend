@extends('layouts.admin_layout')
@section('title', ' - Edit Move')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Move</h1>
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
                            <li class="breadcrumb-item"><a href="{{route('move.index')}}">Move List</a></li>
                            <li class="breadcrumb-item active">Edit Move</li>
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
                            <form method="post" action="{{route('move.update',$moveInfo['id'])}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                {{ method_field('PUT') }}

                                <div class="card mb-3">
                                    <div class="card-header">
                                        Edit Move
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Text:<span>*</span></label>
                                                    <input type="text" name="text" value="{{ old('text') ? old('text') : isset($moveInfo['text']) ? $moveInfo['text'] : ''}}"   placeholder="Enter move text" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmailName">Location:<span>*</span></label>
                                                    <input  name="location"  type="text" placeholder="Enter location" value="{{ old('location') ? old('location') : isset($moveInfo['location']) ? $moveInfo['location'] : ''}}" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Privacy:<span>*</span></label>

                                                    <select class="form-control" name="privacy">
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" {{old('privacy') == '1' ? 'selected' : isset($moveInfo['privacy']) && $moveInfo['privacy'] == 1 ? 'selected' : ''}}>Public</option>
                                                        <option value="0" {{old('privacy') == '0' ? 'selected' : isset($moveInfo['privacy']) && $moveInfo['privacy'] == 0 ? 'selected' : ''}}>Private</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">

                                                    <label for="exampleInputName">Move Date Time:<span>*</span></label>
                                                    <input type="text" name="move_date_time_tz" value="{{ old('move_date_time_tz') ? old('move_date_time_tz') : isset($moveInfo['move_date_time_tz']) ? $moveInfo['move_date_time_tz'] : ''}}"   placeholder="Enter move date time" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Latitude:<span>*</span></label>
                                                    <input type="text" name="latitude" value="{{ old('latitude') ? old('latitude') : isset($moveInfo['latitude']) ? $moveInfo['latitude'] : ''}}"  placeholder="Enter latitude" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmailName">Longitude:<span>*</span></label>
                                                    <input  name="longitude"  type="text" value="{{ old('longitude') ? old('longitude') : isset($moveInfo['longitude']) ? $moveInfo['longitude'] : ''}}" placeholder="Enter longitude" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleInputName">Status:<span>*</span></label>
                                                    <select class="form-control" name="status">
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" {{old('status') == '1' ? 'selected' : isset($moveInfo['status']) && $moveInfo['status'] == 1 ? 'selected' : ''}}>Active</option>
                                                        <option value="0" {{old('status') == '0' ? 'selected' : isset($moveInfo['status']) && $moveInfo['status'] == 0 ? 'selected' : ''}}>Inactive</option>
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
