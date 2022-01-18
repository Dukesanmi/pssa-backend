@extends('layouts.admin_layout')
@section('title', ' - Create Department')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Department</h1>
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
                            <li class="breadcrumb-item"><a href="{{route('department.index')}}">Department List</a></li>
                            <li class="breadcrumb-item active">Create Department</li>
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
                            <form method="post" action="{{route('department.store')}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Create Department
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Name:<span>*</span></label>
                                                    <input value="{{ old('name') ? old('name') : ''}}" type="text" name="name" placeholder="Enter name" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>
                                                    <div class="col-md-6">
                                                    <label for="exampleInputName">Surname:<span>*</span></label>
                                                    <input value="{{ old('surname') ? old('surname') : ''}}" type="text" name="surname" placeholder="Enter surname" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>

                                            </div>
                                        </div>
                                 
                                         <div class="form-group">
                                            <div class="form-row">
                                               
                                                   </div>
                                                    <div class="col-md-6">
                                                    <label for="exampleInputName">Email:<span>*</span></label>
                                                    <input type="email" value="{{ old('email') ? old('email') : ''}}" name="email" placeholder="Enter email" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>
                                                    <div class="col-md-6">
                                                    <label for="exampleInputEmailName">Password:<span>*</span></label>
                                                   <input value="{{ old('password') ? old('password') : ''}}" type="password" name="password" placeholder="Enter password" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                             
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <div class="form-row">
                                              
                                                 <div class="col-md-6">
                                                    <label for="exampleInputName">Mobile Number:<span>*</span></label>
                                                    <input value="{{ old('mobile_number') ? old('mobile_number') : ''}}" type="text" name="mobile_number" placeholder="Enter mobile Number" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                                 <div class="col-md-6">
                                                    <label for="exampleInputName">Address:<span>*</span></label>
                                                    <input value="{{ old('address') ? old('address') : ''}}" type="text" name="address" placeholder="Enter address" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <label for="exampleInputName">Profile Pic:</label>
                                                    <input type="file" name="image" placeholder="Enter " aria-describedby="nameHelp" class="form-control" autofocus>
                                                </div>
                                                    <div class="col-md-6">
                                                    <label for="exampleInputName">State:<span>*</span></label>
                                                     <input value="{{ old('state') ? old('state') : ''}}" type="text" name="state" placeholder="Enter state" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>

                                                </div>
                                              
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                   <div class="col-md-6">
                                                    <label for="exampleInputName">City:<span>*</span></label>
                                                    <input value="{{ old('city') ? old('city') : ''}}" type="text" name="city" placeholder="Enter city" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                                  <div class="col-md-6">
                                                    <label for="exampleInputName">Status:<span>*</span></label>
                                                    <select class="form-control" name="status" required>
                                                        <option value=""> --Select-- </option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
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
