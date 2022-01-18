@extends('layouts.admin_layout')
@section('title', ' - List User Roles')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User Role</h1>
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
                                <li class="breadcrumb-item active"><a href="{{route('alert.index')}}">User role</a></li>
                            </ol>
                            <div class="form_outer">
                          <div class="form-group">
                           
                            <a href="{{route('member.create.role')}}" class="btn btn-primary register">Create User Role</a>
                             
                        </div>
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
                           <th>Actions</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            </thead>
                            <tbody>

                           
                             <?php $i = 1 ?>
                            @forelse ($data as $user)
                            <tr class="odd gradeX">
                                <td>{{ (($data->currentPage() - 1 ) * $data->perPage() ) + $i}}</td>
                                   <td>{{$user['name']}}</td>
                                    <td>{{$user['email']}}</td>
                                
                                      <td class="center">
                                            <a href="{{route('edit.member.role',$user['id'])}}" title="View Details"><i class="fa fa-eye fa-fw"></i></a>
                                        </td>
                            </tr>
                        @empty
                            
                                <tr class="odd gradeX">
                                    <td colspan="7" align="center">No data found</td>

                                </tr>

                        @endforelse




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
                {!! $data->render() !!}
            </nav>
        </div>
        @if($data->count() > 0)
            <div class="mt-15">
                <span class="font-14"> Showing {{$data->firstItem() .'  to  '.  $data->lastItem() .'  of  '. $data->total() }}
                    entries</span>
            </div>
        @endif

    </div>
@endsection
