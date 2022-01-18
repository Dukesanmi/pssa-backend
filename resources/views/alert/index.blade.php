@extends('layouts.admin_layout')
@section('title', ' - List Emergency Alert')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Emergency Alert</h1>
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
                                <li class="breadcrumb-item active"><a href="{{route('alert.index')}}">Emergency Alert List</a></li>
                            </ol>
                            <div class="form_outer">
                             <form method="get" action="{{route('alert.index')}}" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                          <div class="form-group">
                            <select class="form-control" name="status">
                             <option value="0"{{old('status') == '0' ? 'selected' : isset($statusKey) && $statusKey == 0 ? 'selected' : ''}}>Choose Status</option>
                             <option value="1" {{old('status') == '1' ? 'selected' : isset($statusKey) && $statusKey == 1 ? 'selected' : ''}}>To Do</option>
                             <option value="2" {{old('status') == '2' ? 'selected' : isset($statusKey) && $statusKey == 2 ? 'selected' : ''}}>In Progress</option>
                             <option value="3" {{old('status') == '3' ? 'selected' : isset($statusKey) && $statusKey == 3 ? 'selected' : ''}}>In Complete</option>
                             <option value="4" {{old('status') == '4' ? 'selected' : isset($statusKey) && $statusKey == 4 ? 'selected' : ''}}>Complete</option>

                             </select>
                            <button type="submit" class="btn btn-primary register">Filter</button>
                               
                                <!--<div class="input-group-append">
                                </div>-->
                              </div>
                            </form>
                             <form method="get" action="{{route('alert.index')}}" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                          <div class="form-group">
                                <input type="text" class="form-control" value="{{$searchKey}}" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <button type="submit" class="btn btn-primary register">Search</button>
                                <!--<div class="input-group-append">
                                </div>-->
                              </div>
                            </form>
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
                                <th>Mobile Number</th>
                                <th>Profile Pic</th>
                                <th>Case Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getAlert))
                                <?php $i = 1 ?>
                                @foreach($getAlert as $alert)

                                    <tr class="odd gradeX">
                                        <td>{{ (($getAlert->currentPage() - 1 ) * $getAlert->perPage() ) + $i}}</td>
                                        <td>{{$alert['name']}}</td>
                                        <td>{{$alert['email']}}</td>
                                        <td>{{$alert['mobile_number']}}</td>
                                        <td>@if($alert['profile_pic'])
                                            <img src="{{$alert['profile_pic'] }}" height="50" width="75"></td>
                                        @else
                                        <img src="{{ asset('/image/no-image.png')}}" height="50" width="75"></td>
                                        @endif</td>
                                        <td class="center">{{$alert['unique_code']}}</td>
                                        <td class="center">
                                            @if($alert['status'] == 1)
                                                {{'To Do'}}
                                            @elseif($alert['status'] == 2)
                                                {{'In Progress'}}
                                            @elseif($alert['status'] == 3)
                                                {{'In Comlete'}}
                                            @else
                                                  {{'Complete'}}   
                                            @endif
                                        </td>
                                        <td class="center">
                                            <!-- <a href="{{route('alert.change_officer',$alert['ea_id'])}}" title="Assign new police officer"><i class="fa fa-tasks fa-fw"></i></a> -->
                                            <a href="{{route('alert.show',$alert['ea_id'])}}" title="View Details"><i class="fa fa-eye fa-fw"></i>View Emergency</a>
                                            <a href="{{route('start.tracking',$alert['ea_id'])}}" title="View Details"><i class = "fa fa-map fa-fw"></i>Start Tracking</a>

                                          <!--   <form action="{{route('alert.destroy',$alert['id'])}}" method="POST" style="display: inline">
                                                <input name="_method" type="hidden" value="DELETE" >
                                                {{ csrf_field() }}
                                                <button type="submit" title="Delete Job Category" onclick="return confirm('Are you sure wants to delete?')">
                                                    <i class="fa fa-trash-o fa-fw"></i>
                                                </button>
                                            </form> -->
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
                {!! $getAlert->render() !!}
            </nav>
        </div>
        @if($getAlert->count() > 0)
            <div class="mt-15">
                <span class="font-14"> Showing {{$getAlert->firstItem() .'  to  '.  $getAlert->lastItem() .'  of  '. $getAlert->total() }}
                    entries</span>
            </div>
        @endif

    </div>
@endsection
