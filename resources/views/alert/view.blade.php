@extends('layouts.admin_layout') @section('title', ' - View Detail Emergency Alert') @section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Emergency Alert Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading">
                        <ol class="breadcrumb col-md-11">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('alert.index')}}">Emergency Alert List</a></li>
                            <li class="breadcrumb-item active">View Emergency Alert Detail</li>
                        </ol>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Share Location
                          </button>
                        <button type="button" @if($emergencyAlert[ 'status']==1) disabled @else @endif class="btn btn-primary" id="emergency_complete" onclick='changeEmergencyStatus()'>
                            Mark Emergency Complete
                           </button>
                           <div class="col-lg-6">
                            <a href="{{route('download-emergency-pdf',['id'=>$emergencyAlert['ea_id']])}}" class="btn btn-primary assign detail_emer"><i class="fa fa-download" aria-hidden="true"></i> Download PDF</a>
                        </div>

                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                            <tbody>

                                <tr>
                                    <th>Full Name:</th>
                                    <td>{{$emergencyAlert['name']}} {{$emergencyAlert['surname']}}</td>
                                    <th>Email:</th>
                                    <td>{{$emergencyAlert['email']}}</td>

                                </tr>
                                <tr>
                                    <th>Mobile Number:</th>
                                    <td>{{$emergencyAlert['mobile_number']}}</td>
                                    <!--  <th>Text:</th>
                                <td>{{$emergencyAlert['text']}}</td> -->
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{$emergencyAlert['address']}}</td>
                                    <th>State:</th>
                                    <td>{{$emergencyAlert['state']}}</td>
                                </tr>
                                <tr>
                                    <th>Directions:</th>
                                    <td>
                                        <a href="http://maps.google.com/?q={{$emergencyAlert['latitude']}},{{$emergencyAlert['longitude']}}" id="direction">View location in map</a>


                                    </td>

                                </tr>
                                <tr>
                                    <th>Office Address:</th>
                                    <td class="center">
                                        {{$emergencyAlert['office_address']}}
                                    </td>
                                    <th>Phone Verified:</th>
                                    <td class="center">
                                        @if($emergencyAlert['phone_verified'] == '0') {{'No'}} @else {{'Yes'}} @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Current Address:</th>
                                    <td class="center">
                                        {{$emergencyAlert['current_address']}}
                                    </td>
                                    <th>Gender:</th>
                                    <td class="center">
                                        @if($emergencyAlert['gender'] == '0') {{'Female'}} @else {{'Male'}} @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hospital Name:</th>
                                    <td class="center">
                                        {{$emergencyAlert['hospital_name']}}
                                    </td>
                                    <th>Blood Group:</th>
                                    <td class="center">
                                        {{$emergencyAlert['blood_group']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>NHIS Number:</th>
                                    <td class="center">
                                        {{$emergencyAlert['nhis_number']}}
                                    </td>

                                    <th>Allergy:</th>
                                    <td class="center">
                                        {{$emergencyAlert['allergy']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Medicine:</th>
                                    <td class="center">
                                        {{$emergencyAlert['medicine']}}
                                    </td>

                                    <th>Vital Info:</th>
                                    <td class="center">
                                        {{$emergencyAlert['vital_info']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date and Time:</th>
                                    <td class="center">
                                        {{convertTimeZoneWithoutFormat('NG',$emergencyAlert['created_at'])}}
                                    </td>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">View Emergency Alert Detail</li>
                    </ol>
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>


                                <tr>
                                    <th>Case Id:</th>
                                    <td>{{$emergencyAlert['unique_code']}}</td>
                                    <th>Network Provider:</th>
                                    <td>{{$emergencyAlert['network_provider']}}</td>
                                </tr>
                                <tr>
                                    <th>Latitude:</th>
                                    <td>{{$emergencyAlert['latitude']}}</td>
                                    <th>Longitude:</th>
                                    <td>{{$emergencyAlert['longitude']}}</td>
                                </tr>
                                <tr>
                                    <th>Network Strength:</th>
                                    <td>{{$emergencyAlert['network_strength']}}</td>
                                    <th>Recording:</th>
                                    <td>

                                        <audio controls>
                              
				                <source src="{{$emergencyAlert['recording']}}" >

                                Your browser does not support the audio tag.
                                </audio>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Office Address:</th>
                                    <td class="center">
                                        {{$emergencyAlert['office_address']}}
                                    </td>
                                    <th>Battery Level:</th>
                                    <td class="center">
                                        {{$emergencyAlert['battery_label']}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Person Count:</th>
                                    <td class="center">
                                        {{$emergencyAlert['person_count']}}
                                    </td>

                                    @if($emergencyAlert['status'] == 3)
                                    <th>Incomplete Comment:</th>
                                    <td class="center">
                                        {{$emergencyAlert['comment']}}
                                    </td>

                                    @elseif($emergencyAlert['status'] == 4)
                                    <th>Complete Comment:</th>
                                    <td class="center">
                                        {{$emergencyAlert['comment']}}
                                    </td>
                                    @endif



                                </tr>
                                <tr>
                                    <th>Evidence File:</th>

                                    <td class="center">
                                        {{$emergencyAlert['person_count']}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="em_id" id="em_id" value="{{$emergencyAlert['id']}}">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Files</th>

                                </tr>
                            </thead>
                            <tbody>


                                @if(!empty($getEmergencyAlertFiles)) @foreach($getEmergencyAlertFiles as $emergencyAlertFiles)
                                <tr class="odd gradeX col-md-4 col-sm-12 col-xs-12">

                                    <td rowspan="1" class="col-md-12 col-sm-12 col-xs-12"><img src="{{$emergencyAlertFiles->file}}" class="img-responsive"></td>
                                </tr>
                                @endforeach @else

                                <tr class="odd gradeX">
                                    <td colspan="7" align="center">No file found</td>

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

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <label>Select Responder</label>
                <select class="form-control" id='responders'>
                    @foreach($responders as $value)

                    <option phone_number = "{{$value->phone_number}}" value="{{ $value->id}}">{{$value->first_name}} {{$value->last_name}}</option>

                    @endforeach
                </select>

                <input type="radio" id="whatsapp" name="bla" value="whatsapp">
                <label for="whatsapp"> Whatsapp</label><br>
                <input type="radio" id="email" name="bla" value="email">
                <label for="email"> Email</label><br>

                <!-- <input type="radio" id="both" name="bla" value="both">
                <label for="both"> Both</label><br> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick='shareLocation()'>Share</button>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function shareLocation() {
        let medium

        medium = $("[name=bla]:checked").val()

        if (medium == 'whatsapp') {
            let mobile_number = $("#responders").find(':selected').attr('phone_number');

            window.open(`https://wa.me/234${mobile_number}/?text=${$("#direction").attr('href')}`, '_blank');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

        $.ajax({
            type: "POST",
            url: '{{route("share.location")}}',
            data: {
                responder_id: $("#responders").val(),
                medium: medium,
                directions: $("#direction").attr('href')
            },
            success: function(data) {
                if (data == 'email') {
                    Swal.fire('Location Sent Via Email successfully')

                }
            }
        })

    }

    function changeEmergencyStatus() {
        medium = $("[name=bla]:checked").val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

        $.ajax({
            type: "POST",
            url: '{{route("change.emergency.status")}}',
            data: {
                em_id: $("#em_id").val()

            },
            success: function(data) {
                if (data) {
                    Swal.fire('Emergency Completed successfully')

                }

                $("#emergency_complete").prop('disabled', true)
            }
        })
    }
</script>
@endsection