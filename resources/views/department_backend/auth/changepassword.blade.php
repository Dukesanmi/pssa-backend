@extends('department_backend.layouts.admin_layout')
@section('title', ' - Change Password')
@section('content')
<div id="main_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
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
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Password Officer Department</h3>
                    </div>
                    <div class="panel-body">

                        <img class="img-responsive" src="{{ URL::asset('image/NPEA Logo.png') }}" >
                        <form method="POST" action="{{ route('post.change.password') }}">
                            
                            {{ csrf_field() }}
                            <fieldset>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Old Password" name="current-password" type="password" required>
                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('old_password') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="password" type="password" required>
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="password_confirmation" type="password" required>
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                </span>
                                    @endif
                                </div>
                               <!--  <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                             
                                <button type="submit" class="btn btn-lg btn-success btn-block">Update</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection
