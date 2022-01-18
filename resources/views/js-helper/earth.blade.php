<script>
    
    var chart;
    $(document).ready(function() { console.log($("#alert_countries").val());

        if (($(window).width() <= 1400)){
          $("#chart-coll").removeClass("col-md-4").addClass('col-md-5');
        }else{
            $("#chart-coll").removeClass("col-md-5").addClass('col-md-4');
        }
            $("#stateBySelection").change(function () {
                if($(this).val()=='date'){
                    $(".rest_btn").show();
                    $("#month_filter").hide();
                    $(".month-picker").hide();
                    $("#year-picker").hide();
                    $("#dateState").show();
                    $("#submitbtn").hide();
                    $("#dateSbmtState").show();
                    $(".date_filter").show();
                    $("#dateSbmtState").click(function () {

                         $.ajaxSetup({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

                    $.ajax({
                        url:$('#alert_countries').val(),
                        type:'POST',
                        data:{'filter':$(this).val(),date:$("#dateState").val()},
                        success:function (data) {

                            let label=[];
                            $("#dateState").hide();
                            $("#dateSbmtState").hide();
                            $(".date_filter").hide();
                            $("#append-body").empty();
                            var result=data.result;
                            if(result.length>0){

                                let html;
                                $.each(result,function (index,value) {
                                    let assault_robbery=0;
                                    let burglary=0;
                                    let disaster=0;
                                    let domestic_threat=0;
                                    let homicide=0;
                                    let kidnapping=0;
                                    let killing_spree=0;
                                    let other=0;
                                    let rape=0;
                                    let violence=0;
                                    $.each(value.types_of_problems,function (type_index,type_value) {
                                        if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                            assault_robbery=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                            burglary=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                            disaster=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                            domestic_threat=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                            homicide=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                            kidnapping=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
                                            killing_spree=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                            other=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                            rape=type_value.count;
                                        }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                            violence=type_value.count;
                                        }else{
                                            assault_robbery=0;
                                            burglary=0;
                                            disaster=0;
                                            domestic_threat=0;
                                            homicide=0;
                                            kidnapping=0;
                                            killing_spree=0;
                                            other=0;
                                            rape=0;
                                            violence=0;
                                        }
                                        if(index==0){
                                            $("#state_selected").text(value.display_name);
                                            label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                                        }
                                    });
                                    if(value.display_name==''){

                                    }else{
                                        html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                                    }

                                    $("#append-body").append(html);
                                });
                                am4core.ready(function() {

// Themes begin
                                    am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                    chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                                    chart.data=label;

// Set inner radius
                                    chart.innerRadius = am4core.percent(50);

// Add and configure Series
                                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                                    pieSeries.dataFields.value = "litres";
                                    pieSeries.dataFields.category = "country";
                                    pieSeries.slices.template.stroke = am4core.color("#fff");
                                    pieSeries.slices.template.strokeWidth = 2;
                                    pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                                    pieSeries.hiddenState.properties.opacity = 1;
                                    pieSeries.hiddenState.properties.endAngle = -90;
                                    pieSeries.hiddenState.properties.startAngle = -90;

                                }); // end am4core.ready()
                            }else{
                                $("#append-body").append('<p>No Data Found</p>');
                            }
                        }
                    });
                });
                }else if($(this).val()=='month'){
                    $(".rest_btn").show();
                    $(".month_filter").show();
                    $("#dateState").hide();
                    $("#dateSbmtState").hide();
                    $(".date_filter").hide();
                    $("#year-picker").show();
                    $("#month-picker").show();
                    $("#submitbtn").show();
                    $("#year-picker").css('width','49%');
                    $("#submitbtn").click(function () {

                       
                       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


                        $.ajax({
                            url: $('#alert_countries').val(),
                            type: 'POST',
                            data: {'filter': $("#stateBySelection").val(),'month':$("#month-picker").val(),'year':$("#year-picker").val()},
                            success: function (data) {
                                let label=[];
                                $("#append-body").empty();
                                $(".month_filter").hide();
                                var result=data.result;
                                if(result.length>0){
                                    let html;
                                    $.each(result,function (index,value) {
                                        let assault_robbery=0;
                                        let burglary=0;
                                        let disaster=0;
                                        let domestic_threat=0;
                                        let homicide=0;
                                        let kidnapping=0;
                                        let killing_spree=0;
                                        let other=0;
                                        let rape=0;
                                        let violence=0;
                                        $.each(value.types_of_problems,function (type_index,type_value) {
                                            if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                                assault_robbery=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                                burglary=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                                disaster=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                                domestic_threat=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                                homicide=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                                kidnapping=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
                                                killing_spree=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                                other=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                                rape=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                                violence=type_value.count;
                                            }else{
                                                assault_robbery=0;
                                                burglary=0;
                                                disaster=0;
                                                domestic_threat=0;
                                                homicide=0;
                                                kidnapping=0;
                                                killing_spree=0;
                                                other=0;
                                                rape=0;
                                                violence=0;
                                            }
                                            if(index==0){
                                                $("#state_selected").text(value.display_name);
                                                label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                                            }
                                        });

                                        if(value.display_name==''){

                                        }else{
                                            html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                                        }

                                        $("#append-body").append(html);
                                    });
                                    am4core.ready(function() {

// Themes begin
                                        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                        chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                                        chart.data=label;

// Set inner radius
                                        chart.innerRadius = am4core.percent(50);

// Add and configure Series
                                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                                        pieSeries.dataFields.value = "litres";
                                        pieSeries.dataFields.category = "country";
                                        pieSeries.slices.template.stroke = am4core.color("#fff");
                                        pieSeries.slices.template.strokeWidth = 2;
                                        pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                                        pieSeries.hiddenState.properties.opacity = 1;
                                        pieSeries.hiddenState.properties.endAngle = -90;
                                        pieSeries.hiddenState.properties.startAngle = -90;

                                    }); // end am4core.ready()
                                }else{
                                    $("#append-body").append('<p>No Data Found</p>');
                                }
                            }
                        });
                    });
                    // $("#year-picker").change(function () {
                    //
                    // });
                }else if($(this).val()=='year'){
                    $(".rest_btn").show();
                    $("#month-picker").hide();
                    $("#month_filter").hide();
                    $("#dateState").hide();
                    $("#dateSbmtState").hide();
                    $(".date_filter").hide();
                    $("#year-picker").css('width','99%');
                    $(".month_filter").show();
                    $("#year-picker").show();
                    $("#submitbtn").hide();
                    $("#year-picker").change(function () {
                        $("#dateState").hide();
                        $("#dateSbmtState").hide();
                        $(".date_filter").hide();
                       
                       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



                        $.ajax({
                            url: $('#alert_countries').val(),
                            type: 'POST',
                            data: {'filter': $("#stateBySelection").val(),'year':$(this).val()},
                            success: function (data) {
                                $(".month_filter").hide();
                                let label=[];
                                $("#append-body").empty();
                                var result=data.result;
                                if(result.length>0){
                                    let html;
                                    $.each(result,function (index,value) {
                                        let assault_robbery=0;
                                        let burglary=0;
                                        let disaster=0;
                                        let domestic_threat=0;
                                        let homicide=0;
                                        let kidnapping=0;
                                        let killing_spree=0;
                                        let other=0;
                                        let rape=0;
                                        let violence=0;
                                        $.each(value.types_of_problems,function (type_index,type_value) {
                                            if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                                assault_robbery=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                                burglary=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                                disaster=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                                domestic_threat=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                                homicide=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                                kidnapping=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
                                                killing_spree=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                                other=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                                rape=type_value.count;
                                            }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                                violence=type_value.count;
                                            }else{
                                                assault_robbery=0;
                                                burglary=0;
                                                disaster=0;
                                                domestic_threat=0;
                                                homicide=0;
                                                kidnapping=0;
                                                killing_spree=0;
                                                other=0;
                                                rape=0;
                                                violence=0;
                                            }
                                            if(index==0){
                                                $("#state_selected").text(value.display_name);
                                                label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                                            }
                                        });

                                        if(value.display_name==''){

                                        }else{
                                            html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                                        }

                                        $("#append-body").append(html);
                                    });
                                    am4core.ready(function() {

// Themes begin
                                        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                        chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                                        chart.data=label;

// Set inner radius
                                        chart.innerRadius = am4core.percent(50);

// Add and configure Series
                                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                                        pieSeries.dataFields.value = "litres";
                                        pieSeries.dataFields.category = "country";
                                        pieSeries.slices.template.stroke = am4core.color("#fff");
                                        pieSeries.slices.template.strokeWidth = 2;
                                        pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                                        pieSeries.hiddenState.properties.opacity = 1;
                                        pieSeries.hiddenState.properties.endAngle = -90;
                                        pieSeries.hiddenState.properties.startAngle = -90;

                                    }); // end am4core.ready()
                                }else{
                                    $("#append-body").append('<p>No Data Found</p>');
                                }
                            }
                        });
                    });
                }else if($(this).val()=='week'){
                    $(".rest_btn").show();
                    $(".month_filter").hide();
                    $("#dateState").hide();
                    $("#dateSbmtState").hide();
                    $(".date_filter").hide();
                    $("#month-picker").hide();
                    $("#year-picker").hide();
                    $("#submitbtn").hide();

                    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


                    $.ajax({
                    url:$('#alert_countries').val(),
                    type:'POST',
                    data:{'filter':$(this).val()},
                    success:function (data) {
                        let label=[];
                        $("#append-body").empty();
                        var result=data.result;
                        if(result.length>0){
                            let html;
                            $.each(result,function (index,value) {
                                let assault_robbery=0;
                                let burglary=0;
                                let disaster=0;
                                let domestic_threat=0;
                                let homicide=0;
                                let kidnapping=0;
                                let killing_spree=0;
                                let other=0;
                                let rape=0;
                                let violence=0;
                                $.each(value.types_of_problems,function (type_index,type_value) {
                                    if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                        assault_robbery=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                        burglary=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                        disaster=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                        domestic_threat=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                        homicide=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                        kidnapping=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
                                        killing_spree=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                        other=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                        rape=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                        violence=type_value.count;
                                    }else{
                                        assault_robbery=0;
                                        burglary=0;
                                        disaster=0;
                                        domestic_threat=0;
                                        homicide=0;
                                        kidnapping=0;
                                        killing_spree=0;
                                        other=0;
                                        rape=0;
                                        violence=0;
                                    }
                                    if(index==0){
                                        $("#state_selected").text(value.display_name);
                                        label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                                    }
                                });

                                if(value.display_name==''){

                                }else{
                                    html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                                }

                                $("#append-body").append(html);
                            });
                            am4core.ready(function() {

// Themes begin
                                am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                                chart.data=label;

// Set inner radius
                                chart.innerRadius = am4core.percent(50);

// Add and configure Series
                                var pieSeries = chart.series.push(new am4charts.PieSeries());
                                pieSeries.dataFields.value = "litres";
                                pieSeries.dataFields.category = "country";
                                pieSeries.slices.template.stroke = am4core.color("#fff");
                                pieSeries.slices.template.strokeWidth = 2;
                                pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                                pieSeries.hiddenState.properties.opacity = 1;
                                pieSeries.hiddenState.properties.endAngle = -90;
                                pieSeries.hiddenState.properties.startAngle = -90;

                            }); // end am4core.ready()
                        }else{
                            $("#append-body").append('<p>No Data Found</p>');
                        }

                    }
                });
                }else{
                    return true;
                }
            });
        //State Filter Starts
//         $("#stateBySelection").change(function () {
//
//             if($(this).val()=='date'){
//                 $("#dateState").show();
//                 $("#dateSbmtState").show();
//                 $(".date_filter").show();
//                 $("#dateSbmtState").click(function () {
//
//                     $.ajax({
//                         url:$('#alert_countries').val(),
//                         type:'POST',
//                         data:{'filter':$(this).val(),date:$("#dateState").val()},
//                         success:function (data) {
//                             let label=[];
//                             $("#dateState").hide();
//                             $("#dateSbmtState").hide();
//                             $(".date_filter").hide();
//                             $("#append-body").empty();
//                             var result=data.result;
//                             if(result.length>0){
//
//                                 let html;
//                                 $.each(result,function (index,value) {
//                                     let assault_robbery=0;
//                                     let burglary=0;
//                                     let disaster=0;
//                                     let domestic_threat=0;
//                                     let homicide=0;
//                                     let kidnapping=0;
//                                     let killing_spree=0;
//                                     let other=0;
//                                     let rape=0;
//                                     let violence=0;
//                                     $.each(value.types_of_problems,function (type_index,type_value) {
//                                         if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
//                                             assault_robbery=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
//                                             burglary=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
//                                             disaster=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
//                                             domestic_threat=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
//                                             homicide=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
//                                             kidnapping=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
//                                             killing_spree=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Other')==0){
//                                             other=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Rape')==0){
//                                             rape=type_value.count;
//                                         }else if(type_value.types_of_problem.localeCompare('Violence')==0){
//                                             violence=type_value.count;
//                                         }else{
//                                             assault_robbery=0;
//                                             burglary=0;
//                                             disaster=0;
//                                             domestic_threat=0;
//                                             homicide=0;
//                                             kidnapping=0;
//                                             killing_spree=0;
//                                             other=0;
//                                             rape=0;
//                                             violence=0;
//                                         }
//                                         if(index==0){
//                                             $("#state_selected").text(value.display_name);
//                                             label.push({'country':type_value.types_of_problem,'litres':type_value.count});
//                                         }
//                                     });
//                                     if(value.display_name==''){
//
//                                     }else{
//                                         html='<tr><td><a href="#" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
//                                     }
//
//                                     $("#append-body").append(html);
//                                 });
//                                 am4core.ready(function() {
//
// // Themes begin
//                                     am4core.useTheme(am4themes_animated);
// // Themes end
//
// // Create chart instance
//                                     chart = am4core.create("radar-chart-container", am4charts.PieChart);
//
// // Add data
//                                     chart.data=label;
//
// // Set inner radius
//                                     chart.innerRadius = am4core.percent(50);
//
// // Add and configure Series
//                                     var pieSeries = chart.series.push(new am4charts.PieSeries());
//                                     pieSeries.dataFields.value = "litres";
//                                     pieSeries.dataFields.category = "country";
//                                     pieSeries.slices.template.stroke = am4core.color("#fff");
//                                     pieSeries.slices.template.strokeWidth = 2;
//                                     pieSeries.slices.template.strokeOpacity = 1;
//
// // This creates initial animation
//                                     pieSeries.hiddenState.properties.opacity = 1;
//                                     pieSeries.hiddenState.properties.endAngle = -90;
//                                     pieSeries.hiddenState.properties.startAngle = -90;
//
//                                 }); // end am4core.ready()
//                             }else{
//                                 $("#append-body").append('<p>No Data Found</p>');
//                             }
//                         }
//                     });
//                 });
//             } else{
//                 $("#dateState").hide();
//                 $("#dateSbmtState").hide();
//                 $(".date_filter").hide();
//                 $.ajax({
//                     url:$('#alert_countries').val(),
//                     type:'POST',
//                     data:{'filter':$(this).val()},
//                     success:function (data) {
//                         let label=[];
//                         $("#append-body").empty();
//                         var result=data.result;
//                         if(result.length>0){
//                             let html;
//                             $.each(result,function (index,value) {
//                                 let assault_robbery=0;
//                                 let burglary=0;
//                                 let disaster=0;
//                                 let domestic_threat=0;
//                                 let homicide=0;
//                                 let kidnapping=0;
//                                 let killing_spree=0;
//                                 let other=0;
//                                 let rape=0;
//                                 let violence=0;
//                                 $.each(value.types_of_problems,function (type_index,type_value) {
//                                     if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
//                                         assault_robbery=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
//                                         burglary=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
//                                         disaster=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
//                                         domestic_threat=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
//                                         homicide=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
//                                         kidnapping=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
//                                         killing_spree=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Other')==0){
//                                         other=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Rape')==0){
//                                         rape=type_value.count;
//                                     }else if(type_value.types_of_problem.localeCompare('Violence')==0){
//                                         violence=type_value.count;
//                                     }else{
//                                         assault_robbery=0;
//                                         burglary=0;
//                                         disaster=0;
//                                         domestic_threat=0;
//                                         homicide=0;
//                                         kidnapping=0;
//                                         killing_spree=0;
//                                         other=0;
//                                         rape=0;
//                                         violence=0;
//                                     }
//                                     if(index==0){
//                                         $("#state_selected").text(value.display_name);
//                                         label.push({'country':type_value.types_of_problem,'litres':type_value.count});
//                                     }
//                                 });
//
//                                 if(value.display_name==''){
//
//                                 }else{
//                                     html='<tr><td><a href="#" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
//                                 }
//
//                                 $("#append-body").append(html);
//                             });
//                             am4core.ready(function() {
//
// // Themes begin
//                                 am4core.useTheme(am4themes_animated);
// // Themes end
//
// // Create chart instance
//                                 chart = am4core.create("radar-chart-container", am4charts.PieChart);
//
// // Add data
//                                 chart.data=label;
//
// // Set inner radius
//                                 chart.innerRadius = am4core.percent(50);
//
// // Add and configure Series
//                                 var pieSeries = chart.series.push(new am4charts.PieSeries());
//                                 pieSeries.dataFields.value = "litres";
//                                 pieSeries.dataFields.category = "country";
//                                 pieSeries.slices.template.stroke = am4core.color("#fff");
//                                 pieSeries.slices.template.strokeWidth = 2;
//                                 pieSeries.slices.template.strokeOpacity = 1;
//
// // This creates initial animation
//                                 pieSeries.hiddenState.properties.opacity = 1;
//                                 pieSeries.hiddenState.properties.endAngle = -90;
//                                 pieSeries.hiddenState.properties.startAngle = -90;
//
//                             }); // end am4core.ready()
//                         }else{
//                             $("#append-body").append('<p>No Data Found</p>');
//                         }
//
//                     }
//                 });
//             }
//         });
        //State Filter Ends
        // Collapse window

        $("#arrow_container").click( function(event){
            event.preventDefault();
            if ( $(this).hasClass("isRight") ) {
                $("#arrow_container").empty();
                $("#arrow_container").append('<i class="fa fa-angle-double-left" aria-hidden="true"></i>');
                $("#report_col").stop().animate({right:"0%"}, 500);
            } else { //closing the tab
                $("#arrow_container").empty();
                $("#arrow_container").append('<i class="fa fa-file-text" aria-hidden="true"></i>');
                if (($(window).width() <= 1600)){
                    $("#report_col").stop().animate({right:"-22%"}, 500);
                }else{
                    $("#report_col").stop().animate({right:"-17%"}, 500);
                }

            }
            $(this).toggleClass("isRight");
            return false;
        });
        // Collase end




        // Collapse 3 window

        $("#arrow_container_3").click( function(event){
            event.preventDefault();
            if ( $(this).hasClass("isLeft") ) {
                $("#arrow_container_3").empty();
                $("#arrow_container_3").append('<i class="fa fa-angle-double-right" aria-hidden="true"></i>');
                $("#navbar-main").stop().animate({right:"0%"}, 500);
                $("#navbar-main").css('overflow','');

            } else { //closing the tab
                $("#arrow_container_3").empty();
                $("#arrow_container_3").append('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                if (($(window).width() <= 1600)){
                    $("#navbar-main").stop().animate({right:"-22%"}, 500);
                }else{
                    $("#navbar-main").stop().animate({right:"-17%"}, 500);
                }
            }
            $(this).toggleClass("isLeft");
            return false;
        });
        // Collase 3 end

// Collapse 4 window

        $("#arrow_container_4").click( function(event){
            event.preventDefault();
            if ( $(this).hasClass("isTop") ) {
                $("#arrow_container_4").empty();
                $("#arrow_container_4").append('<i class="fa fa-angle-double-left" aria-hidden="true"></i>');
                $("#chart-coll").stop().animate({left:"0px"}, 500);
            } else { //closing the tab
                $("#arrow_container_4").empty();
                $("#arrow_container_4").append('<i class="fa fa-line-chart" aria-hidden="true"></i>');
                // $("#chart-coll").stop().animate({bottom:"-310px"}, 500);
                if (($(window).width() <= 1400)){
                    $("#chart-coll").stop().animate({left:"-42%"}, 500);
                }else{
                    $("#chart-coll").stop().animate({left:"-33.5%"}, 500);
                }
            }
            $(this).toggleClass("isTop");
            return false;
        });
        // // Collapse 2 window
        //
        // $("#arrow_container_2").click( function(event){
        //     event.preventDefault();
        //     if ( $(this).hasClass("isRight") ) {
        //         $("#arrow_container_2").empty();
        //
        //         $("#arrow_container_2").append('<i class="fa fa-angle-double-left" aria-hidden="true"></i>');
        //         $("#country_col").stop().animate({left:"0%"}, 500);
        //         $("#country_col_1").stop().animate({left:"-66.5%"}, 500);
        //     } else { //closing the tab
        //         $("#arrow_container_country").show();
        //         $("#arrow_container_country").append('<i class="icofont-ui-map"></i>');
        //         $("#arrow_container_2").empty();
        //         $("#arrow_container_2").hide();
        //         // $("#arrow_container_2").append('<i class="fa fa-globe" aria-hidden="true"></i>');
        //         // $.ajax({
        //         //     type: "GET",
        //         //     url: $("#state_route").val(),
        //         //     error:function(data){
        //         //         console.log(data);
        //         //     },
        //         //     success: function(data) {
        //         //         $("#append-body-country").empty();
        //         //         $.each(data.result,function (index,value) {
        //         //
        //         //             let country_name;
        //         //             value.country_name?country_name=value.country_name:country_name='Undefined Country';
        //         //             console.log(value.count_todo);
        //         //             $("#append-body-country").append("<tr><td>"+country_name+"</td><td style='color: #FFFFFF'>"+value.count_todo+"</td><td style='color: #FFFFFF'>"+value.count_inprogress+"</td><td style='color: #FFFFFF'>"+value.count_incomplete+"</td><td style='color: #FFFFFF'>"+value.count_complete+"</td></tr>");
        //         //         });
        //         //
        //         //     }
        //         // });
        //         if (($(window).width() < 1023)){
        //             $("#country_col").stop().animate({left:"-66.4%"}, 500);
        //             $("#country_col_1").stop().animate({left:"0px"}, 500);
        //         }else{
        //             $("#country_col").stop().animate({left:"-66.4%"}, 500);
        //             $("#country_col_1").stop().animate({left:"0px"}, 500);
        //         }
        //
        //     }
        //     $(this).toggleClass("isRight");
        //     return false;
        // });
        // Collapse 2 window

        $("#arrow_container_2").click( function(event){
            event.preventDefault();
            if ( $(this).hasClass("isRight") ) {
                $("#arrow_container_2").empty();
                $("#arrow_container_2").append('<i class="icofont-ui-map" aria-hidden="true"></i>');
                $("#country_col").stop().animate({left:"0%"}, 500);
            } else { //closing the tab
                $("#arrow_container_2").empty();
                $("#arrow_container_2").hide();
                $("#arrow_container_country").show();
                $("#arrow_container_2").append('<i class="icofont-ui-map" aria-hidden="true"></i>');
                        $.ajax({
                            type: "GET",
                            url: $("#state_route").val(),
                            error:function(data){
                                console.log(data);
                            },
                            success: function(data) {
                                $("#append-body-country").empty();
                                $.each(data.result,function (index,value) {

                                    let country_name;
                                    value.country_name?country_name=value.country_name:country_name='Undefined State';
                                    if(value.country_name){
                                        $("#append-body-country").append("<tr><td>"+country_name+"</td><td style='color: #FFFFFF'>"+value.count_todo+"</td><td style='color: #FFFFFF'>"+value.count_inprogress+"</td><td style='color: #FFFFFF'>"+value.count_incomplete+"</td><td style='color: #FFFFFF'>"+value.count_complete+"</td></tr>");
                                    }

                                });

                            }
                        });
                if (($(window).width() < 1023)){
                    $("#country_col").stop().animate({left:"-66.4%"}, 500);
                    $("#country_col_1").stop().animate({left:"0px"}, 500);
                }else{
                    $("#country_col").stop().animate({left:"-69.4%"}, 500);
                    $("#country_col_1").stop().animate({left:"0px"}, 500);
                }

            }
            $(this).toggleClass("isRight");
            return false;
        });
        // Collase 2 end
        $("#arrow_container_country").click(function (event) {
            
            event.preventDefault();
            if ( $(this).hasClass("isRight") ) {
                $("#arrow_container_country").empty();
                $("#arrow_container_country").append('<i class="fa fa-globe" aria-hidden="true"></i>');
                $("#country_col_1").stop().animate({left:"0%"}, 500);
            } else { //closing the tab
                $("#arrow_container_country").empty();
                $("#arrow_container_2").show();
                $("#arrow_container_country").hide();

                $("#arrow_container_country").append('<i class="fa fa-globe" aria-hidden="true"></i>');
                if (($(window).width() < 1023)){
                    $("#country_col_1").stop().animate({left:"-66.4%"}, 500);
                    $("#country_col").stop().animate({left:"0px"}, 500);
                }else{
                    $("#country_col_1").stop().animate({left:"-69.4%"}, 500);
                    $("#country_col").stop().animate({left:"0px"}, 500);
                }

            }
            $(this).toggleClass("isRight");
            return false;
        });
        // Collase 2 end
        // $("#arrow_container_country").click( function(event){
        //     event.preventDefault();
        //     if ( $(this).hasClass("isRight") ) { //opening a tab
        //         $("#arrow_container_country").empty();
        //         $("#arrow_container_2").show();
        //         $("#country_col_1").stop().animate({left:"0px"}, 500);
        //         // $("#country_col").stop().animate({left:"0px"}, 500);
        //     } else { //closing the tab
        //         $("#arrow_container_country").empty();
        //         $("#arrow_container_2").show();
        //         $("#arrow_container_2").append('<i class="fa fa-angle-double-left" aria-hidden="true"></i>');
        //         $("#arrow_container_country").hide();
        //         // $("#arrow_container_country").append('<i class="icofont-ui-map"></i>');
        //         // $("#chart-coll").stop().animate({bottom:"-310px"}, 500);
        //         if (($(window).width() <= 1400)){
        //             $("#country_col_1").stop().animate({left:"-66.5%"}, 500);
        //             $("#country_col").stop().animate({left:"0px"}, 500);
        //         }else{
        //             $("#country_col_1").stop().animate({left:"-66.5%"}, 500);
        //             $("#country_col").stop().animate({left:"0px"}, 500);
        //         }
        //     }
        //     $(this).toggleClass("isRight");
        //     return false;
        // });
        // Collase 4 end




        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });
        $.ajax({
            type: "GET",
            url: 'get_locations',
            error:function(data){
                console.log(data);
            },
            success: function(data) {
                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation=myObj;
                initialize(mylocation);
                if(myObj.status=="nok"){
                    alert("something went wrong");
                }else{
                    //location.reload();
                }
            }
        });

        $(".custom_close").click(function () {
            $("#open_hide").hide();
            $("#chatting_bar").hide();
            // $("#map").css('height','957px');
            $("#map").removeClass('responsive-class');
        });
        function printStates(){ 
            //alerts by state with all states
            $.ajax({
                url:$('#alert_countries').val(),
                type:'get',
                beforeSend: function(){
                },
                success: function (data) {
                    $("#append-body").empty();
                    var result=data.result;
                    var statistics=data.statistics_count;
                    $("#report_tbody").empty();
                    let reporthtml="<tr class='emergency_row'><td class='emergency_heading'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Emergency Reports</td><td class='emergency'>"+statistics.total_emergency+"</td></tr><tr class='crime_row'><td class='crime_heading'><i class='icofont-file-alt'></i> Crime Reports</td><td class='crime'>"+statistics.report_crime+"</td><tr class='police_row'><td class='police_heading'><i class='icofont-file-alt'></i> Police Reports</td><td class='report'>"+statistics.report_police+"</td></tr><tr class='vehicle_row'><td class='vehicle_heading'><i class='icofont-car-alt-1'></i> Vehicle Reports</td><td class='vehicle'>"+statistics.vehicle_report+"</td></tr>";
                    $("#report_tbody").append(reporthtml);
                    let html='';
                    let label=[];
                    $.each(result,function (index,value) {
                        let assault_robbery=0;
                        let burglary=0;
                        let disaster=0;
                        let domestic_threat=0;
                        let homicide=0;
                        let kidnapping=0;
                        let killing_spree=0;
                        let other=0;
                        let rape=0;
                        let violence=0;
                        $.each(value.types_of_problems,function (type_index,type_value) {
                            if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                assault_robbery=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                burglary=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                disaster=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                domestic_threat=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                homicide=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                kidnapping=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0 ){
                                killing_spree=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                other=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                rape=type_value.count;
                            }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                violence=type_value.count;
                            }else{
                                assault_robbery=0;
                                burglary=0;
                                disaster=0;
                                domestic_threat=0;
                                homicide=0;
                                kidnapping=0;
                                killing_spree=0;
                                other=0;
                                rape=0;
                                violence=0;
                            }
                            if(index==0){
                                $("#state_selected").text(value.display_name);
                                label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                            }
                            let display_name=value.display_name?value.display_name:'undefined_state';
                            if(value.display_name){
                                html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+value.display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                            }

                        });
                        $("#append-body").append(html);
                    });
                    am4core.ready(function() {

// Themes begin
                        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                        chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                        chart.data=label;

// Set inner radius
                        chart.innerRadius = am4core.percent(50);

// Add and configure Series
                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                        pieSeries.dataFields.value = "litres";
                        pieSeries.dataFields.category = "country";
                        pieSeries.slices.template.stroke = am4core.color("#fff");
                        pieSeries.slices.template.strokeWidth = 2;
                        pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                        pieSeries.hiddenState.properties.opacity = 1;
                        pieSeries.hiddenState.properties.endAngle = -90;
                        pieSeries.hiddenState.properties.startAngle = -90;

                    }); // end am4core.ready()
                }
            });
        }

        printStates();
        $("#reset_button").click(function () {
            printStates();
        })
    });
    function getStates(state){ 
        // let country;
        $(".check").on('click',function(e) {
            e.stopImmediatePropagation();
           let country = $(this).text();
            $("#state_selected").text(country);
            $.ajax({
                type:'GET',
                url:'../../../emergency/states/'+country.trim(),
                data:{'filter':$("#stateBySelection").val(),date:$("#dateState").val()},
                success:function (data) {
                    //setting chart according to the country selected
                    var countryData=data.state;
                    let label=[];
                    let count=[];
                    var l= countryData.length;
                    for (var i=0;i<=countryData.length; i++){
                        var current=countryData[i];
                        if(current){
                            label.push({'country':current.types_of_problem,'litres':current.count});
                        }
                    }
                    // if(typeof chart!=='undefined'){
                    //     //destroying Pie Chart
                    //     chart.destroy();
                    // }
                    am4core.ready(function() {

// Themes begin
                        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                        chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                        chart.data=label;

// Set inner radius
                        chart.innerRadius = am4core.percent(50);

// Add and configure Series
                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                        pieSeries.dataFields.value = "litres";
                        pieSeries.dataFields.category = "country";
                        pieSeries.slices.template.stroke = am4core.color("#fff");
                        pieSeries.slices.template.strokeWidth = 2;
                        pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                        pieSeries.hiddenState.properties.opacity = 1;
                        pieSeries.hiddenState.properties.endAngle = -90;
                        pieSeries.hiddenState.properties.startAngle = -90;

                    }); // end am4core.ready()
                }
            });
        });
    }
    function getAlert(id){
        $.ajax({
            type: "POST",
            url: 'get_emergency_alert',
            data:{'id':id},
            success: function(data) {
                var myObj = JSON.parse(data);
                var mylocation = [];
                //console.log(data);
                mylocation=myObj;
                // document.getElementById("open_hide").style.display='block';
                // $("#open_hide").fadeIn()
                //     .css({top:1000})
                //     .animate({top:0}, 800, function() {
                //         //callback
                //     });

                showEmergencyDetails(mylocation);
                if(myObj.status=="nok"){
                    alert("somthing went wrong");
                }else{
                    //location.reload();
                }
            }
        });
    }

    Pusher.logToConsole = true;
    var pusher = new Pusher('794acf82292b0bd4dd28', {
        cluster: 'us2',
        forceTLS: true
    });
    let marker;
    let earth;
    function initialize(locations) {

        if (($(window).width() <= 1400)){
            var options = {atmosphere: true, center: [0, 0],zooming:false,zoom:2.5};
        }else{
            var options = {atmosphere: true, center: [0, 0],zooming:false,zoom:3};
        }

        earth = new WE.map('earth_div', options);
        $.each(locations,function (index,value) {
            // console.log(value.latitude+''+value.longitude);
            marker = WE.marker([value.latitude, value.longitude]).addTo(earth);
        });

        var channel = pusher.subscribe('alert-channel');
        // const capitalize = (s) => {
        //     if (typeof s !== 'string') return '';
        //     return s.charAt(0).toUpperCase() + s.slice(1)
        // };
        channel.bind('alerts-event', function(data) { 
            let reason =data.emergency_data.reason?data.emergency_data.reason:'';
            @if(Auth::guard('department')->check())
                let state='<?php echo Auth::guard('department')->user()->state ?>';
            $(".emergency").text(parseInt($(".emergency").text())+1);
                if(state == data.emergency_data.state){
                    let name=data.emergency_data.name?data.emergency_data.name:data.emergency_data.md_name;
                    let address=data.emergency_data.emergency_address?data.emergency_data.emergency_address:data.emergency_data.md_address;
                        $("#emergency-alert-popup").html('<p>'+name+' is in emergency</p>');
                        $("#emergency-alert-popup").fadeIn();

                        $("#emergency-alert-popup").fadeOut(10000);

                        //appending new information to side menu map
                        let emergency=name+" is in "+data.emergency_data.types_of_problem+" threat."+"("+data.emergency_data.unique_code+")";
                        let time=data.emergency_data.time;
                        //emergency Class
                        let typeEmergencyClass='';
                        if(data.emergency_data.types_of_problem =='Assault Robbery' || data.emergency_data.types_of_problem=='Assault_Robbery' ){
                            typeEmergencyClass='assault-robbery';
                        }else if(data.emergency_data.types_of_problem=='Burglary'){
                            typeEmergencyClass='burglary';
                        }
                        else if(data.emergency_data.types_of_problem=='Disaster'){
                            typeEmergencyClass='disaster';
                        }else if(data.emergency_data.types_of_problem=='Domestic Threat' || data.emergency_data.types_of_problem=='Domestic threat'){
                            typeEmergencyClass='domestic-threat';
                        }else if(data.emergency_data.types_of_problem=='Homicide'){
                            typeEmergencyClass='homicide';
                        }else if(data.emergency_data.types_of_problem=='Kidnapping'){
                            typeEmergencyClass='kidnapping';
                        }else if(data.emergency_data.types_of_problem=='Killing Spree' || data.emergency_data.types_of_problem=='Killing_Spree'){
                            typeEmergencyClass='killing-spree';
                        }else if(data.emergency_data.types_of_problem=='Rape' || data.emergency_data.types_of_problem=='rape'){
                            typeEmergencyClass='rape';
                        }else if(data.emergency_data.types_of_problem=='Violence'){
                            typeEmergencyClass='violence';
                        }else{
                            typeEmergencyClass='other';
                        }
                        let menuHTML="<li class='timeline-inverted'><div class='timeline-badge todo badge'></div><a class='timeline-panel "+typeEmergencyClass+"' onclick='getAlert("+data.emergency_data.id+")'><p>"+reason+"</p><div class='timeline-heading'>"+emergency+" <small class='emergency_time'>"+time+"</small> @ <p>"+address+"</p></div> </a> </li>";
                        $("#side-menu-map").prepend(menuHTML);

                        marker = WE.marker([data.emergency_data.latitude,data.emergency_data.longitude]).addTo(earth);
                }
            @else
            $(".emergency").text(parseInt($(".emergency").text())+1);
            let name=data.emergency_data.name?data.emergency_data.name:data.emergency_data.md_name;
            let address=data.emergency_data.emergency_address?data.emergency_data.emergency_address:data.emergency_data.md_address;

            $("#emergency-alert-popup").html('<p>'+name+' is in emergency</p>');

            $("#emergency-alert-popup").fadeIn();

            $("#emergency-alert-popup").fadeOut(10000);

            //appending new information to side menu map
            let emergency=name+" is in "+data.emergency_data.types_of_problem+" threat."+"("+data.emergency_data.unique_code+")";
            let time=data.emergency_data.time;
            //emergency Class
            let typeEmergencyClass='';
            if(data.emergency_data.types_of_problem =='Assault Robbery'){
                typeEmergencyClass='assault-robbery';
            }else if(data.emergency_data.types_of_problem=='Burglary'){
                typeEmergencyClass='burglary';
            }
            else if(data.emergency_data.types_of_problem=='Disaster'){
                typeEmergencyClass='disaster';
            }else if(data.emergency_data.types_of_problem=='Domestic Threat' || data.emergency_data.types_of_problem=='Domestic threat'){
                typeEmergencyClass='domestic-threat';
            }else if(data.emergency_data.types_of_problem=='Homicide'){
                typeEmergencyClass='homicide';
            }else if(data.emergency_data.types_of_problem=='Kidnapping'){
                typeEmergencyClass='kidnapping';
            }else if(data.emergency_data.types_of_problem=='Killing Spree' || data.emergency_data.types_of_problem=='Killing spree'){
                typeEmergencyClass='killing-spree';
            }else if(data.emergency_data.types_of_problem=='Rape' || data.emergency_data.types_of_problem=='rape'){
                typeEmergencyClass='rape';
            }else if(data.emergency_data.types_of_problem=='Violence'){
                typeEmergencyClass='violence';
            }else{
                typeEmergencyClass='other';
            }
            let menuHTML="<li class='timeline-inverted'><div class='timeline-badge todo badge'></div><a class='timeline-panel "+typeEmergencyClass+"' onclick='getAlert("+data.emergency_data.id+")'><div class='timeline-heading'>"+emergency+" <small class='emergency_time'>"+time+"</small> @ <p>"+address+"</p></div> </a> </li>";
            $("#side-menu-map").prepend(menuHTML);

            marker = WE.marker([data.emergency_data.latitude,data.emergency_data.longitude]).addTo(earth);
            @endif

                var w = $("#country-wrapper");
                $('table tr').each(function(index,value){
                    if($(this).find('td').eq(0).text() == data.emergency_data.state){
                        // $(this).css('background','red');
                        $(this).css('animation','blink-emergency 1s');
                        $(this).css('-webkit-animation','blink-emergency 1s');
                        $(this).css('-moz-animation','blink-emergency 1s');
                        $(this).css('-o-animation','blink-emergency 1s');
                        $(this).css('-ms-animation','blink-emergency 1s');
                        $(this).css('animation-iteration-count','3');
                    }
                });
                setTimeout(function () { 
                    $("table tr").css('animation');
                    $("table tr").css('-webkit-animation');
                    $("table tr").css('-moz-animation');
                    $("table tr").css('-o-animation');
                    $("table tr").css('-ms-animation');
                    $("table tr").css('animation-iteration-count');
                    // $("table tr").css('background','none');
                    $.ajax({
                        url:$('#alert_countries').val(),
                        type:'POST',
                        beforeSend: function(){
                        },
                        success: function (data) {
                            $("#append-body").empty();
                            var result=data.result;
                            var statistics=data.statistics_count;
                            $("#report_tbody").empty();
                            let reporthtml="<tr class='emergency_row'><td class='emergency_heading'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Emergency Reports</td><td class='emergency'>"+statistics.total_emergency+"</td></tr><tr class='crime_row'><td class='crime_heading'><i class='icofont-file-alt'></i> Crime Reports</td><td class='crime'>"+statistics.report_crime+"</td><tr class='police_row'><td class='police_heading'><i class='icofont-file-alt'></i> Police Reports</td><td class='report'>"+statistics.report_police+"</td></tr><tr class='vehicle_row'><td class='vehicle_heading'><i class='icofont-car-alt-1'></i> Vehicle Reports</td><td class='vehicle'>"+statistics.vehicle_report+"</td></tr>";
                            $("#report_tbody").append(reporthtml);
                            let html='';
                            let label=[];
                            $.each(result,function (index,value) {
                                let assault_robbery=0;
                                let burglary=0;
                                let disaster=0;
                                let domestic_threat=0;
                                let homicide=0;
                                let kidnapping=0;
                                let killing_spree=0;
                                let other=0;
                                let rape=0;
                                let violence=0;
                                $.each(value.types_of_problems,function (type_index,type_value) {
                                    if(type_value.types_of_problem.localeCompare('Assault Robbery')==0){
                                        assault_robbery=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Burglary')==0){
                                        burglary=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Disaster')==0){
                                        disaster=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Domestic Threat')==0 || type_value.types_of_problem.localeCompare('Domestic threat')==0){
                                        domestic_threat=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Homicide')==0){
                                        homicide=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Kidnapping')==0){
                                        kidnapping=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Killing Spree')==0 || type_value.types_of_problem.localeCompare('Killing spree')==0){
                                        killing_spree=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Other')==0){
                                        other=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Rape')==0){
                                        rape=type_value.count;
                                    }else if(type_value.types_of_problem.localeCompare('Violence')==0){
                                        violence=type_value.count;
                                    }else{
                                        assault_robbery=0;
                                        burglary=0;
                                        disaster=0;
                                        domestic_threat=0;
                                        homicide=0;
                                        kidnapping=0;
                                        killing_spree=0;
                                        other=0;
                                        rape=0;
                                        violence=0;
                                    }
                                    if(index==0){
                                        $("#state_selected").text(value.display_name);
                                        label.push({'country':type_value.types_of_problem,'litres':type_value.count});
                                    }
                                    let display_name=value.display_name?value.display_name:'undefined_state';
                                    html='<tr><td class="stat"><a href="#" data-toggle="tooltip" title="'+value.display_name+'" onclick="getStates()" class="check">'+display_name+'</a></td><td style="color: #ffffff">'+assault_robbery+'</td><td style="color: #ffffff">'+burglary+'</td><td style="color: #ffffff">'+disaster+'</td><td style="color: #ffffff">'+domestic_threat+'</td><td style="color: #ffffff">'+homicide+'</td><td style="color: #ffffff">'+kidnapping+'</td><td style="color: #ffffff">'+killing_spree+'</td><td style="color: #ffffff">'+other+'</td><td style="color: #ffffff">'+rape+'</td><td style="color: #ffffff">'+violence+'</td></tr>';
                                });
                                $("#append-body").append(html);
                            });
                            am4core.ready(function() {

// Themes begin
                                am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                chart = am4core.create("radar-chart-container", am4charts.PieChart);

// Add data
                                chart.data=label;

// Set inner radius
                                chart.innerRadius = am4core.percent(50);

// Add and configure Series
                                var pieSeries = chart.series.push(new am4charts.PieSeries());
                                pieSeries.dataFields.value = "litres";
                                pieSeries.dataFields.category = "country";
                                pieSeries.slices.template.stroke = am4core.color("#fff");
                                pieSeries.slices.template.strokeWidth = 2;
                                pieSeries.slices.template.strokeOpacity = 1;
// This creates initial animation
                                pieSeries.hiddenState.properties.opacity = 1;
                                pieSeries.hiddenState.properties.endAngle = -90;
                                pieSeries.hiddenState.properties.startAngle = -90;

                            }); // end am4core.ready()
                        }
                    });
                },4000);


            // $("#open_hide").show();
            $("#form_wrapper").animate({ scrollTop: 0 },0);
            $("#form_wrapper").animate({ scrollTop: '500px' },60*1000);
            setTimeout(function(){$("#open_hide").hide()},60*1000);
            showEmergencyDetails(data.emergency_data);
        });
        let page_count=0;
        setInterval(function () {
            page_count++;
            console.log(page_count);
            $.ajax({
                url:'{{route('todo.notification.data')}}',
                type:'GET',
                data:{'page_count':parseInt(page_count)-1},
                beforeSend: function(){
                },
                success: function (data) {
                    $("#form_wrapper").animate({ scrollTop: 0 },0);
                    $("#form_wrapper").animate({ scrollTop: '500px' },60*1000);
                    setTimeout(function(){$("#open_hide").hide()},40000);
                    showEmergencyDetails(JSON.parse(data));
                }
            });

        },60*1000);
        var baselayer = WE.tileLayer('https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=4D0anK4wGybB5ggsiYUH', {
        }).addTo(earth);
        // Start a simple rotation animation
        var before = null;
        requestAnimationFrame(function animate(now) {
            var c = earth.getPosition();
            var elapsed = before? now - before: 0;
            before = now;
            earth.setCenter([c[0], c[1] + 0.1*(elapsed/30)]);
            requestAnimationFrame(animate);
        });
    }
    function showEmergencyDetails(parameters) {
        $("#open_hide").show();
        // console.log(parameters);
        $("#assign_officer_info_window").attr('href','change/officer/edit/'+parameters.id);
        $("#map").addClass('responsive-class');
        var status='';
        if(parameters.status=='1'){
            status="Todo";
        }else if(parameters.status=="2"){
            status="InProgress";
        }else if(parameters.status=="3"){
            status="InComplete";
        }else if(parameters.status=="4"){
            status="Complete";
        }else{
            status="empty";
        }

        //collapsing  mobile menu bar
        $(".sidebar-nav").removeClass("in");
        //end
        if(parameters.location_array['4']&&parameters.location_array['5'] && parameters.location_array['6']){
            var append_location_html="<tr><td>Address:</td><td>"+parameters.location_array['0']['long_name']+','+parameters.location_array['1']['long_name']+','+parameters.location_array['2']['long_name']+','+parameters.location_array['3']['long_name']+"</td></tr>" + "" +
                "<tr><td>City, State:</td><td>"+parameters.location_array['4']['long_name']+','+parameters.location_array['5']['long_name']+"</td></tr>"
                +"<tr><td>Country:</td><td>"+parameters.location_array['6']['long_name']+', '+parameters.location_array['6']['short_name']+"</td></tr>"
            ;
        }else{
            var append_location_html="<tr><td>Address:</td><td>"+parameters.location_array['0']['long_name']+','+parameters.location_array['1']['long_name']+','+parameters.location_array['2']['long_name'];
        }


        var device_details="<tr><td>Carrier:</td><td>"+parameters.network_provider+"</td></tr>"
            +"<tr><td>Network Strength:</td><td>"+parameters.network_strength+"</td></tr>";


        var emergency_details="<tr><td>Type of Emergency:</td><td>"+parameters.types_of_problem+"</td></tr>"
            +"<tr><td>Unique Code</td><td>"+parameters.unique_code+"</td></tr>"
            +"<tr><td>Person Count:</td><td>"+parameters.person_count+"</td></tr>"+
            "<tr><td>Status:</td><td>"+status+"</td></tr>"+
            "<tr><td>Assigned to:</td><td>"+parameters.officer_name+"</td></tr>";
            let name=parameters.name?parameters.name:parameters.md_name;
            let email=parameters.email?parameters.email:parameters.md_email;
            let address=parameters.current_address?parameters.current_address:parameters.md_address;
            let state=parameters.state?parameters.state:parameters.md_state;

        var user_details="<tr><td>Name:</td><td>"+name+"</td></tr>"+"<tr style='display:none'><td>Surname:</td><td>"+parameters.surname+"</td></tr>"+"<tr><td>Email:</td><td>"+email+"</td></tr>"+"<tr><td>Date of Birth:</td><td>"+parameters.dob+"</td></tr>"+
            +"<tr><td>Address</td><td>"+parameters.address+"</td></tr>"
            +"<tr><td>Current Address:</td><td>"+address+"</td></tr>"+
            "<tr><td>Office Address:</td><td>"+parameters.office_address+"</td></tr>"+
            "<tr><td>State:</td><td>"+state+"</td></tr>"+
            "<tr><td>Hospital Name:</td><td>"+parameters.hospital_name+"</td></tr>"+
            "<tr><td>Nhis Number:</td><td>"+parameters.nhis_number+"</td></tr>"+"<tr><td>Vital Info:</td><td>"+parameters.vital_info+"</td></tr>"+"<tr><td>Time & Date:</td><td>"+parameters.time+"</td></tr>";
        //start tracking form setting values
        $("#id").val(parameters.id);
        $("#lat").val(parameters.latitude);
        $("#lng").val(parameters.longitude);
        $("#police_id").val(parameters.police_officer_id);
        $("#type_of_problem").val(parameters.types_of_problem);
        //end
        //setting chat header name
        $(".chat_header h4").html(parameters.name);

        //setting mobile number in call
        $("#call_btn").attr('href','tel:'+parameters.mobile_number);

        //setting image in chatting bar
        var profile_pic='';
        if(parameters.profile_pic!=''){
            profile_pic=parameters.profile_pic;
        }else{
            profile_pic='/image/no-profile-pic.png';
        }
        $("#sender_image").attr('src',profile_pic);
        $("#sender_link").attr('href',profile_pic);
        // document.getElementById("imageThumb").setAttribute('data-src', parameters.profile_pic);
        $("#user_id").val(parameters.user_id);
        $("#user_details").html(user_details);
        $("#view_details").attr('href','alert/'+parameters.id);
        $(" #emergency_details").html(emergency_details);
        $(" #append_device_details").html(device_details);
        $(" #append_locations").html(append_location_html);
    }
    let policeChannel = pusher.subscribe('police-report-channel');
    policeChannel.bind('police-event-event',function (data) {
        $(".report").text(parseInt($(".report").text())+1);
    });
    let crimeChannel = pusher.subscribe('crime-report-channel');
    crimeChannel.bind('crime-event-event',function (data) {
        $(".crime").text(parseInt($(".crime").text())+1);
    });
    var channel = pusher.subscribe('rv-channel');
    channel.bind('rv-event', function(data) {
        $(".vehicle").text(parseInt($(".vehicle").text())+1);
    });
    $(function() {

        $('[data-toggle="tooltip"]').tooltip();
        $( ".datepicker" ).datepicker({
            dateFormat: "mm-dd-yy",
            changeYear: true,
            changeMonth:true,
            maxDate: 0
        });
    });

</script>