@extends('layouts.admin_layout') @section('title', ' - List Responders') @section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Responders</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="col-sm-12">
                    <form method="post" action="{{route('responder.create')}}" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                        <div class="card mb-3">
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">first Name:<span>*</span></label>
                                            <input value="{{ old('name') ? old('name') : ''}}" type="text" name="f_name" placeholder="Enter  firstname" aria-describedby="nameHelp" class="form-control txtOnly" autofocus required> @if ($errors->has('name'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span> @endif

                                        </div>
                                        <div class="col-md-6 {{ $errors->has('surname') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Last Name:<span>*</span></label>
                                            <input value="{{ old('surname') ? old('surname') : ''}}" type="text" name="l_name" placeholder="Enter lastname" aria-describedby="nameHelp" class="form-control txtOnly" required autofocus> @if ($errors->has('surname'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('surname') }}</strong>
                                                        </span> @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-6 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Gender:<span>*</span></label>
                                            <select class="form-control" name="gender" required autofocus>
                                                        <option value=""> --Select-- </option>
                                                        <option value="2" {{old('gender') == '2' ? 'selected' : '' }}>Male</option>
                                                        <option value="1" {{old('gender') == '1' ? 'selected' : '' }}>Female</option>
                                                        <option value="0" {{old('gender') == '0' ? 'selected' : '' }}>Other</option>
                                                    </select> @if ($errors->has('gender'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                        </span> @endif

                                        </div>
                                        <div class="col-md-6 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Date of Birth:<span>*</span></label>
                                            <input value="{{ old('dob') ? old('dob') : ''}}" type="date" max="2019-01-02" name="dob" placeholder="Enter dob " aria-describedby="nameHelp" class="form-control" required autofocus> @if ($errors->has('dob'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('dob') }}</strong>
                                                        </span> @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="exampleInputName">Email:<span>*</span></label>
                                        <input type="email" value="{{ old('email') ? old('email') : ''}}" name="email" placeholder="Enter email" aria-describedby="nameHelp" class="form-control" required autofocus> @if ($errors->has('email'))
                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span> @endif
                                    </div>
                                    <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmailName">Password:<span>*</span></label>
                                        <input value="{{ old('password') ? old('password') : ''}}" type="password" name="password" placeholder="Enter password" aria-describedby="nameHelp" class="form-control" required autofocus> @if ($errors->has('password'))
                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span> @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="form-row col-md-12">

                                        <div class="col-md-6 {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                            <label for="exampleInputName" style="width: 100%;">Mobile Number:<span>*</span></label>
                                            <div class="col-md-9 col-sm-7 col-xs-7">

                                                <input value="{{ old('mobile_number') ? old('mobile_number') : ''}}" type="text" name="mobile_number" placeholder="Enter mobile Number" aria-describedby="nameHelp" class="form-control mobile_number_valid" required autofocus>                                                @if ($errors->has('mobile_number'))
                                                <span class="help-block">
                                                            <strong>{{ $errors->first('mobile_number') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Address:<span>*</span></label>
                                            <input value="{{ old('address') ? old('address') : ''}}" type="text" name="address" placeholder="Enter address" aria-describedby="nameHelp" class="form-control" required autofocus> @if ($errors->has('address'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span> @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row col-md-6 ">
                                        <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Profile Pic:</label>
                                            <input type="file" name="image" placeholder="Enter " aria-describedby="nameHelp" class="form-control my_file" autofocus accept="image/x-png,image/gif,image/jpeg" /> @if ($errors->has('image'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span> @endif
                                        </div>


                                    </div>

                                </div>


                                <div class="form-group">
                                    <div class="form-row col-md-6">
                                        <div class="col-md-12 {{ $errors->has('status') ? ' has-error' : '' }}">
                                            <label for="exampleInputName">Status:<span>*</span></label>
                                            <select class="form-control" name="status" required autofocus>
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" {{old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                        <option value="0"{{old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                                    </select> @if ($errors->has('status'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row col-md-12">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary register mt-15">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


</div>
@endsection