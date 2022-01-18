@extends('layouts.admin_layout')
@section('title', ' - Edit Department')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Department</h1>
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
                            <li class="breadcrumb-item active">Edit Department</li>
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
                              <form method="post" action="{{route('department.update',$getUsers['id'])}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                {{ method_field('PUT') }}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Edit Department
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Name:<span>*</span></label>
                                                    <input type="text" value="{{ old('name') ? old('name') : isset($getUsers['name']) ? $getUsers['name'] : ''}}"  name="name" placeholder="Enter name" aria-describedby="nameHelp" class="form-control" autofocus>

                                                </div>
<!--                                                 <div class="col-md-6">-->
<!--                                                    <label for="exampleInputName">Surname:<span>*</span></label>-->
<!--                                                    <input type="text" value="{{ old('surname') ? old('surname') : isset($getUsers['surname']) ? $getUsers['surname'] : ''}}"  name="surname" placeholder="Enter surname" aria-describedby="nameHelp" class="form-control" autofocus>-->
<!---->
<!--                                                </div>-->
                                                  

                                            </div>
                                        </div>
                                       
                                         <div class="form-group">
                                            <div class="form-row">
                                               <div class="col-md-6">
                                                    <label for="exampleInputName">Email:<span>*</span></label>
                                                    <input type="email" value="{{ old('email') ? old('email') : isset($getUsers['email']) ? $getUsers['email'] : ''}}" name="email" placeholder="Enter email" aria-describedby="nameHelp" class="form-control" required autofocus>

                                                </div>
                                                    <div class="col-md-6">
                                                    <label for="exampleInputName">Mobile Number:<span>*</span></label>
                                                    <input value="{{ old('mobile_number') ? old('mobile_number') : isset($getUsers['mobile_number']) ? $getUsers['mobile_number'] : ''}}" type="text" name="mobile_number" placeholder="Enter mobile Number" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                             
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <div class="form-row">
                                               <div class="col-md-6">
                                                    <label for="exampleInputName">Address:<span>*</span></label>
                                                    <input type="text" value="{{ old('address') ? old('address') : isset($getUsers['address']) ? $getUsers['address'] : ''}}" name="address" placeholder="Enter address" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                              <div class="col-md-6">
                                                    <label for="exampleInputName">State:<span>*</span></label>
                                                     <input value="{{ old('state') ? old('state') : isset($getUsers['state']) ? $getUsers['state'] : ''}}" type="text" name="state" placeholder="Enter state" aria-describedby="nameHelp" class="form-control" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <label for="exampleInputName">Department Pic:</label>
                                                    <input type="file" name="image" placeholder="Enter " aria-describedby="nameHelp" class="form-control"  autofocus>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Status:<span>*</span></label>
                                                      <select class="form-control" name="status">
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" {{old('status') == '1' ? 'selected' : isset($getUsers['status']) && $getUsers['status'] == 1 ? 'selected' : ''}}>Active</option>
                                                        <option value="0" {{old('status') == '0' ? 'selected' : isset($getUsers['status']) && $getUsers['status'] == 0 ? 'selected' : ''}}>Inactive</option>
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
