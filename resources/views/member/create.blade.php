@extends('layouts.admin_layout')
@section('title', ' - User Role')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">CreateUser Role</h1>
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
                            <li class="breadcrumb-item"><a href="{{route('department.index')}}">User Role List</a></li>
                            <li class="breadcrumb-item active">Create User Role</li>
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
                            <form method="post" action="{{route('member.create.role')}}" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Create User Role
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
                                             </div>
                                            </div>
                                        
                                          <div class="form-group">
                                             <div class="form-row col-md-12">
                                            <label>Please Select Features</label>
                                        </div>


                                             <div class="form-row col-md-12">
                                              
                                                 <input type="checkbox" id="check_all" name="scales" onclick="checkall()">
                                                  <label for="scales">Select All</label>
                                            
                                            </div>


                                            <div class="form-row col-md-12">
                                              
                                                 <input type="checkbox" class="scales" name="dashboard" value="1">
                                                  <label for="scales">Dashboard</label>
                                            
                                            </div>
                                            <div class="form-row col-md-12">
                                              
                                                 <input type="checkbox" class="scales" name="users"  value="1">
                                                  <label for="scales">Users</label>
                                            
                                            </div>
                                            <div class="form-row col-md-12">
                                              
                                                <input type="checkbox" class="scales" name="emergency_alert"  value="1">
                                                <label for="scales">Emergency Alerts</label>
                                            
                                            </div>
                                            <div class="form-row col-md-12">
                                              
                                            <input type="checkbox" class="scales" name="alerts_on_map"  value="1">
                                            <label for="scales">Alerts On Map</label>
                                            
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
    <script>
        function checkall()
        {   
            if($("#check_all").prop('checked') == true)
            { 
                $(".scales").prop('checked',true);
            }
            else
            { 
                 $(".scales").prop('checked',false);
            }
            
         }
    </script>
@endsection
