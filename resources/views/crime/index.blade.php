@extends('layouts.admin_layout')
@section('title', ' - List Crime Report')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Crime Report</h1>
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
                                <li class="breadcrumb-item active"><a href="{{route('crime.index')}}">Crime Report List</a></li>
                            </ol>
                             <form method="get" action="{{route('crime.index')}}" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

  							

<!--                               <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
 -->                                  <div class="form-group">
 	
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
                                <th>Mobile Number</th>
                                <th>Profile Pic</th>
                                <th>Case Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getCrime))
                                <?php $i = 1 ?>
                                @foreach($getCrime as $crime)

                                    <tr class="odd gradeX">
                                        <td>{{ (($getCrime->currentPage() - 1 ) * $getCrime->perPage() ) + $i}}</td>
                                        <td>{{$crime['name']}}</td>
                                        <td>{{$crime['email']}}</td>
                                        <td>{{$crime['mobile_number']}}</td>
                                        <td> @if($crime['profile_pic'])
                                            <img src="{{$crime['profile_pic']}}" height="50" width="75">
                                            @else
                                            <img src="{{ asset('/image/no-image.png')}}" height="50" width="75">
                                            @endif</td>
                                        <td class="center">{{$crime['unique_code']}}</td>
                                        <td class="center">
                                            @if($crime['status'] == '0')
                                                {{'Active'}}
                                            @else
                                                {{'Inactive'}}
                                            @endif
                                        </td>
                                        <td class="center">

                                            <a href="{{route('crime.show',['id'=>$crime['rc_id']])}}" title="View Details"><i class="fa fa-eye fa-fw"></i></a>

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
                {!! $getCrime->render() !!}
            </nav>
        </div>
        @if($getCrime->count() > 0)
            <div class="mt-15">
                <span class="font-14"> Showing  {{$getCrime->firstItem() .'  to  '.  $getCrime->lastItem() .'  of  '. $getCrime->total() }}
                    entries</span>
            </div>
        @endif

    </div>
@endsection
