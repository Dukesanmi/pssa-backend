@extends('layouts.admin_layout')
@section('title', ' - Create Department')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Medical Department</h1>
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
                            <li class="breadcrumb-item"><a href="{{route('medical.index')}}">Medical Department List</a></li>
                            <li class="breadcrumb-item active">Create Medical Department</li>
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
                            <form method="post" action="{{route('medical.store')}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Create Medical Department
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Name:<span>*</span></label>
                                                    <input value="{{ old('name') ? old('name') : ''}}" type="text" name="name" placeholder="Enter name" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>
                                               

                                                <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Email:<span>*</span></label>
                                                    <input type="email" value="{{ old('email') ? old('email') : ''}}" name="email" placeholder="Enter email" aria-describedby="nameHelp" class="form-control" required autofocus>
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
                                               
                                                    <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="exampleInputEmailName">Password:<span>*</span></label>
                                                   <input value="{{ old('password') ? old('password') : ''}}" type="password" name="password" placeholder="Enter password" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                       @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>

                                                <div class="col-md-6 {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Mobile Number:<span>*</span></label>
                                                    <input value="{{ old('mobile_number') ? old('mobile_number') : ''}}" type="text" name="mobile_number" placeholder="Enter mobile number" aria-describedby="nameHelp" class="form-control" required autofocus>
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
                                              
                                                 <div class="col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Address:<span>*</span></label>
                                                    <input value="{{ old('address') ? old('address') : ''}}" type="text" name="address" placeholder="Enter address" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                     @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>
                                                <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Medical Department Pic:</label>
                                                    <input type="file" name="image" placeholder="Enter " aria-describedby="nameHelp" class="form-control my_file" accept="image/x-png,image/gif,image/jpeg">
                                                        @if ($errors->has('image'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>

                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                 
                                                    <div class="col-md-6 {{ $errors->has('state') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">State:<span>*</span></label>
                                                     <input value="{{ old('state') ? old('state') : ''}}" type="text" name="state" placeholder="Enter state" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                    @if ($errors->has('state'))
                                                       <span class="help-block">
                                                           <strong>{{ $errors->first('state') }}</strong>
                                                       </span>
                                                    @endif  
                                                </div>

                                                <div class="col-md-6 {{ $errors->has('city') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">City:<span>*</span></label>
                                                    <input value="{{ old('city') ? old('city') : ''}}" type="text" name="city" placeholder="Enter city" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                      @if ($errors->has('city'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('city') }}</strong>
                                                        </span>
                                                     @endif  
                                                </div>

                                                </div>
                                              
                                            </div>
                                        
                                        <div class="form-group">
                                            <div class="form-row col-md-12">
                                                   
                                                  <div class="col-md-6 {{ $errors->has('status') ? ' has-error' : '' }}">
                                                    <label for="exampleInputName">Status:<span>*</span></label>
                                                 <select class="form-control" name="status" required>
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" {{old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                        <option value="0"{{old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                     @endif
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
