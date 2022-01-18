@extends('layouts.admin_layout')
@section('title', ' - List Users')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <ol class="breadcrumb col-md-6">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('user.index')}}">Users List</a></li>
                            </ol>
                             <form method="get" action="{{route('user.index')}}" class="form-inline d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
<!--                               <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
 -->                              <div class="form-group">
                                <input type="text" class="form-control" value="{{$searchKey}}" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <button type="submit" class="btn btn-primary register">Search</button>
                                <!--<div class="input-group-append">
                                </div>-->
                              </div>
                            </form>
                        </div>
                       
                    </div>
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

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile number</th>
                                <th>Image</th>
                                <th>DOB</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getUsers))
                                <?php $i = 1 ?>
                                @foreach($getUsers as $user)

                                    <tr class="odd gradeX">
                                        <td>{{ (($getUsers->currentPage() - 1 ) * $getUsers->perPage() ) + $i}}</td>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{$user['mobile_number']}}</td>
                                        <td> @if($user['profile_pic'])
                                                <img src="{{$user['profile_pic'] }}" height="50" width="75"></td>
                                        @else
                                            <img src="{{ asset('/image/no-image.png')}}" height="50" width="75"></td>
                                            @endif</td>
                                        <td class="center">{{$user['dob']}}</td>
                                        <td class="center">
                                            @if($user['status'] == '0')
                                                {{'active'}}
                                            @else
                                                {{'Inactive'}}
                                            @endif
                                        </td>
                                        <td class="center">

                                             @if(Auth::guard('department')->check())
                                            <a href="{{route('user.show',$user['id'])}}" title="View Details"><i class="fa fa-eye fa-fw"></i></a>

                                             @elseif(Auth::guard('fire')->check())  
                                                                                          <a href="{{route('user.show',$user['id'])}}" title="View Details"><i class="fa fa-eye fa-fw"></i></a>

                                             @else 
 <a href="{{route('user.show',$user['id'])}}" title="View Details"><i class="fa fa-eye fa-fw"></i></a>
                                            <a href="{{route('user.edit',$user['id'])}}" title="Edit User"><i class="fa fa-edit fa-fw"></i></a>
                                             <form action={{route('user.delete',$user['id'])}} method="POST" style="display: inline">
                                                <input name="_method" type="hidden" value="DELETE" >
                                                {{ csrf_field() }}
                                                <button type="submit" title="Delete Job Category" onclick="return confirm('Are you sure wants to delete?')">
                                                    <i class="fa fa-trash-o fa-fw"></i>
                                                </button>
                                            </form>
                                             @endif

                                           
                                        </td>

                                    </tr>
                                    <?php $i++ ?>
                                @endforeach

                            @else

                                <tr class="odd gradeX">
                                    <td colspan="7" align="center">No data found</td>

                                </tr>

                            @endif

                            </tbody>
                        </table>
                    </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="pull-right">
            <nav>
                {!! $getUsers->render() !!}
            </nav>
        </div>
        @if($getUsers->count() > 0)
            <div class="mt-15">
                <span class="font-14"> Showing {{$getUsers->firstItem() .'  to   '.  $getUsers->lastItem() .'   of  '. $getUsers->total() }}
                    entries</span>
            </div>
        @endif

    </div>
@endsection