@extends('layouts.admin_layout') @section('title', ' - Dashboard') @section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-primary panel_user">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$userCount}}</div>
                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('user.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-emergency">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-warning fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$emergencyAlertCount}}</div>
                            <div>Emergency Alert</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('alert.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right">
            <lable>Sort By</lable>
            <select class="form-control" name="sort" id="chartfilter" onchange="chartFilter()">
                <option selected disabled>Select</option>
                <option value="date">Date</option>
                <option value="year">Year</option>
                <option value="month">Month</option>
                
           </select>
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="row">
        <div class="col-md-6">
            <canvas id="piechart" style="width:200px; height:100px;"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="myChart" style="width:600px; height:400px;"></canvas>
        </div>


    </div>


</div>
<!-- /.row -->
</div>
@include('js-helper.notification-modal')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    loadCharts()
    let barChart;
    let pieChart;

    function loadCharts(filter = null) {
        let label = [];
        let count = [];

        if (filter != null) {
            $('#chartfilter option').prop('selected', function() {
                return this.defaultSelected;
            });
            barChart.destroy();
            pieChart.destroy();
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{route('get.chart.details')}}",
            data: filter,
            success: function(data) {
                $.each(data.result, function(index, value) {
                    if (value.types_of_problem != '') {
                        label.push(value.types_of_problem);
                        count.push(value.count);
                    }
                })
                let barchartdiv = document.getElementById('myChart').getContext('2d');
                barChart = new Chart(barchartdiv, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Emergencies Chart',
                            data: count,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 3, 0, 0.2)',
                                'rgba(255, 36, 0, 0.2)',
                                'rgba(240, 139, 0, 0.2)',
                                'rgba(255, 73, 0, 0.2)',
                                'rgba(241, 201, 21, 0.2)',
                                'rgba(240, 141, 0, 0.2)',
                                'rgba(3, 151, 51, 0.2)',
                                'rgba(172, 187, 30, 0.2)',
                                'rgba(248, 74, 0, 0.2)',
                                'rgba(240, 162, 0, 0.2)',
                                'rgba(3, 92, 185, 0.2)',
                                'rgba(56, 151, 221, 0.2)',
                                'rgba(0,  248, 122, 0.2)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 3, 0, 1)',
                                'rgba(255, 36, 0, 1)',
                                'rgba(240, 139, 0, 1)',
                                'rgba(255, 73, 0, 1)',
                                'rgba(241, 201, 21, 1)',
                                'rgba(240, 141, 0, 1)',
                                'rgba(3, 151, 51, 1)',
                                'rgba(172, 187, 30, 1)',
                                'rgba(248, 74, 0, 1)',
                                'rgba(240, 162, 0, 1)',
                                'rgba(3, 92, 185, 1)',
                                'rgba(56, 151, 221, 1)',
                                'rgba(0,  248, 122, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });


                var ctx = document.getElementById("piechart").getContext('2d');
                pieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: label,
                        datasets: [{
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e",
                                '#333300',
                                '#00ff00',
                                '#999966',
                                '#666699',
                                '#cc6699',
                                '#00cc66',
                                '#ff66ff',
                                '#ffff66',
                                '#66ff66',
                                '#990000',
                                '#b3ffff',
                                '#cc0000',
                            ],
                            data: count,
                            options: {
                                maintainAspectRatio: true,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        }]
                    }
                });


            }
        })
    }



    function chartFilter() {
        let chartfilter = $("#chartfilter").val()

        if (chartfilter == 'date') {
            Swal.fire({
                title: '<lable>Select Date</lable><input type="date" class="form control" onchange="loadCharts({date:this.value})">',
                showConfirmButton: false,
                showCloseButton: true,
            })
        }

        if (chartfilter == 'year') {
            Swal.fire({
                title: '<lable>Select Year</lable> <select id="date-dropdown" onchange="loadCharts({year:this.value})"><option selected disabled  hidden>Select Year</option></select>',
                showConfirmButton: false,
                showCloseButton: true,
            })
            populateYear()
        }

        if (chartfilter == 'month') {
            Swal.fire({
                title: '<lable>Select Date</lable><input type="month" class="form control" onchange="loadCharts({month:this.value})">',
                showConfirmButton: false,
                showCloseButton: true,
            })
        }


    }

    function populateYear() {
        let dateDropdown = document.getElementById('date-dropdown');

        let currentYear = new Date().getFullYear();
        let earliestYear = 1970;
        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            dateDropdown.add(dateOption);
            currentYear -= 1;
        }
    }
</script>



@endsection