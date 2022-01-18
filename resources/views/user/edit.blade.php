@extends('layouts.admin_layout')
@section('title', ' - Edit User')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit User</h1>
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
                            <li class="breadcrumb-item"><a href="{{route('user.index')}}">User List</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                    @if(session()->has('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session()->get('success') }}
                        </div>
                @endif
                <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="col-sm-12">
                            <form method="post" id="userEditForm" action="{{route('user.update',$getUsers['id'])}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                {{ method_field('PUT') }}

                                <div class="card mb-3">
                                    <div class="card-header">
                                        Edit User
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Full Name:<span>*</span></label>
                                                    <input type="text" name="user_name" value="{{ old('name') ? old('name') : isset($getUsers['name']) ? $getUsers['name'] : ''}}"   placeholder="Enter full name" aria-describedby="nameHelp" class="form-control" required  autofocus>
                                                        @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                     @endif    
                                                </div>
                                                <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="exampleInputEmailName">Email:<span>*</span></label>
                                                    <input  name="email"  type="email" placeholder="Enter email" value="{{ old('email') ? old('email') : isset($getUsers['email']) ? $getUsers['email'] : ''}}" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                      @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                     @endif    
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                <div class="col-md-6 {{ $errors->has('country_code') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Country Code:<span>*</span></label>
                                                    <input  name="country_code"  type="text" value="{{ old('country_code') ? old('country_code') : isset($getUsers['country_code']) ? $getUsers['country_code'] : ''}}" placeholder="Enter country code" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                     @if ($errors->has('country_code'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('country_code') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>
                                                <div class="col-md-6 {{ $errors->has('mobile_number') ? ' has-error' : '' }}">

                                                    <label for="exampleInputName">Phone Number:<span>*</span></label>
                                                    <input type="tel" name="mobile_number" value="{{ old('mobile_number') ? old('mobile_number') : isset($getUsers['mobile_number']) ? $getUsers['mobile_number'] : ''}}"   placeholder="Enter mobile number" aria-describedby="nameHelp" class="form-control"  autofocus>
                                                          @if ($errors->has('mobile_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('mobile_number') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                <div class="col-md-6 {{ $errors->has('country') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Country:<span>*</span></label>
                                                    <input type="text" name="country" value="{{ old('country') ? old('country') : isset($getUsers['country']) ? $getUsers['country'] : ''}}"  placeholder="Enter country name" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                      @if ($errors->has('country'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('country') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>
                                                {{--<div class="col-md-6">--}}
                                                    {{--<label for="exampleInputEmailName">City:<span>*</span></label>--}}
                                                    {{--<input  name="city"  type="text" value="{{ old('city') ? old('city') : isset($getUsers['city']) ? $getUsers['city'] : ''}}" placeholder="Enter city name" aria-describedby="nameHelp" class="form-control" required autofocus>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="col-md-6 {{ $errors->has('dob') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Dob:<span>*</span></label>

                                                    <input  name="dob"  type="date" value="{{ old('dob') ? old('dob') : isset($getUsers['dob']) ? $getUsers['dob'] : ''}}" placeholder="Enter Dob name" aria-describedby="nameHelp" class="form-control my_file" required autofocus>
                                                       @if ($errors->has('dob'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('dob') }}</strong>
                                                        </span>
                                                     @endif     
                                                </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                
                                                {{--<div class="col-md-6">--}}
                                                    {{--<label for="exampleInputEmailName">Email:<span>*</span></label>--}}
                                                    {{--<input  name="email"  type="email" placeholder="Enter email" value="{{ old('email') ? old('email') : isset($getUsers['email']) ? $getUsers['email'] : ''}}" aria-describedby="nameHelp" class="form-control" required autofocus>--}}
                                                {{--</div>--}}

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Profile Picture:<span>*</span></label>
                                                    <input type="file" name="image"   placeholder="Select profile picture" aria-describedby="nameHelp" class="form-control my_file" autofocus accept="image/x-png,image/gif,image/jpeg">
                                                       @if ($errors->has('image'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                     @endif     
                                                </div>

                                                <div class="col-md-6 {{ $errors->has('state') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">State:<span>*</span></label>
                                                    <input  name="state"  type="text" placeholder="Enter state name" value="{{ old('state') ? old('state') : isset($getUsers['state']) ? $getUsers['state'] : ''}}" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                         @if ($errors->has('state'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('state') }}</strong>
                                                        </span>
                                                     @endif   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                {{--<div class="col-md-6">--}}
                                                    {{--<label for="exampleInputName">User Name:<span>*</span></label>--}}
                                                    {{--<input type="text" name="user_name"   placeholder="Please endter user name" value="{{ old('user_name') ? old('user_name') : isset($getUsers['name']) ? $getUsers['name'] : ''}}" aria-describedby="nameHelp" class="form-control" autofocus>--}}

                                                {{--</div>--}}

                                                <div class="col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Address:<span>*</span></label>
                                                    <input  name="address"  type="text" placeholder="Enter address " value="{{ old('address') ? old('address') : isset($getUsers['address']) ? $getUsers['address'] : ''}}" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                         @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                     @endif    
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

    @push('scripts')
        <script src="{{ asset('assets/frontend/js/user.edit.js') }}"></script>

    @endpush
@endsection