@extends('layouts.admin_layout')
@section('title', ' - List Move Files')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Move Files</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('move.index')}}">Move List</a></li>
                                <li class="breadcrumb-item"><a href="#">Move File List</a></li>
                            </ol>
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
                                <th>Move File</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($getMoveFiles))
                                <?php $i = 1 ?>
                                @foreach($getMoveFiles as $moveFiles)

                                    <tr class="odd gradeX">

                                        <td>{{ (($getMoveFiles->currentPage() - 1 ) * $getMoveFiles->perPage() ) + $i}}</td>

                                        @if($moveFiles['file_type'] == 'image')
                                            <td><img src="{{$moveFiles['file_name']}}" height="200" width="220"></td>

                                        @else
                                            <td>
                                            <video width="200" height="220" controls>
                                                <source src="{{$moveFiles['file_name']}}" type="video/mp4">

                                            </video>
                                            </td>
                                        @endif
                                        <td class="center">
                                            <a onclick="return confirm('Are you sure wants to delete?')" href="{{route('delete.move.file',$moveFiles['id'])}}" title="Delete move file"><i class="fa fa-trash-o fa-fw"></i></a>

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
        &#160;
        <div class="pull-right">
            <nav>
                {!! $getMoveFiles->render() !!}
            </nav>
        </div>
        @if($getMoveFiles->count() > 0)
            <div class="mt-15">
                <span class="font-14"> Showing &nbsp; {{$getMoveFiles->firstItem() .'&nbsp;to&nbsp;'.  $getMoveFiles->lastItem() .'&nbsp;of&nbsp;'. $getMoveFiles->total() }}
                    &nbsp;entries</span>
            </div>
        @endif

    </div>
@endsection
