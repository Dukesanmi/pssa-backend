

<script type="text/javascript">

$(document).ready(function() {

  $('#search').on('keyup', function(){
    //alert("hello");

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tbody");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        }   
       else {
        tr[i].style.display = "none";
      }
    }       
  }

    });

  
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
       $("#open").click(function () {
           var a=0;
           var radioValue = $("input[name='radio']:checked").val();
           $("#tbody").empty(); //clearing table body on every change
           $.ajax({
               url: '{{route("email")}}',
               type: "post",
               data: { id :$(this).val(),'count':a},
               success: function(data){
                   var myObj=JSON.parse(data);
                   var html=[];
                   myObj.forEach(function(u)
                   {
                       html="<tr><td>"+u.name+"</td><td>"+u.email+"</td><td>"+u.dp_name+"</td><td>"+u.state+"</td><td><input style='margin:0 auto; display:block;' type='radio' id='email_check[]' value="+u.email+" name='sport' ></td></tr>"
                       $("#tbody").append(html);
                   });
               }
           });
       });
    let a=0;
      $('input[type=radio][name=radio]').change(function()
      {
       a=0;
          var radioValue = $("input[name='radio']:checked").val();
          let headingHtml='';
          if(radioValue==1){ //if department
           headingHtml='<tr><th>Name</th><th>Email</th><th>State</th><th>Select Email</th></tr>';
          }else{
              headingHtml='<tr><th>Name</th><th>Email</th><th>Department</th><th>State</th><th>Select Email</th></tr>';
          }
          $("#heading").html(headingHtml);
        $("#tbody").empty(); //clearing table body on every change
          $.ajax({
                    url: '{{route("email")}}',
                    type: "post",
                    data: { id :radioValue,'count':a},
                    success: function(data){
                    var myObj=JSON.parse(data);
                      var html=[];
                      myObj.forEach(function(u)
                      {
                          if(radioValue==1){
                              html="<tr><td>"+u.name+"</td><td>"+u.email+"</td><td>"+u.state+"</td><td><input style='margin:0 auto; display:block;' type='radio' id='email_check[]' value="+u.email+" name='sport' ></td></tr>";
                          }else{
                              html="<tr><td>"+u.name+"</td><td>"+u.email+"</td><td>"+u.dp_name+"</td><td>"+u.state+"</td><td  ><input style='margin:0 auto; display:block;' type='radio' id='email_check[]' value="+u.email+" name='sport' ></td></tr>";
                          }

                        $("#tbody").append(html);
                      });
                      
                       }


                  }); 


 });
    $(".email_sender").scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
            // var a= localStorage.getItem("a");
            a++;
            var radioValue = $("input[name='radio']:checked").val();
            $.ajax({
                url: '{{route("email")}}',
                type: "post",
                data: { id :radioValue,'count':a},
                success: function(data){
                    var myObj=JSON.parse(data);
                    var html=[];
                    myObj.forEach(function(u) {
                        if(radioValue==1){
                            html="<tr><td>"+u.name+"</td><td>"+u.email+"</td><td>"+u.state+"</td><td><input style='margin:0 auto; display:block;' type='radio' id='email_check[]' value="+u.email+" name='sport' ></td></tr>";
                        }else{
                            html="<tr><td>"+u.name+"</td><td>"+u.email+"</td><td>"+u.dp_name+"</td><td>"+u.state+"</td><td><input style='margin:0 auto; display:block;' type='radio' id='email_check[]' value="+u.email+" name='sport' ></td></tr>";
                        }
                        $("#tbody").append(html);
                    });

                }

            });

        }
    });
 });


   function sendMail(id){
        $()
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());
            });

    
            // alert("My favourite sports are: " + favorite.join(", "));
            
            $.ajax({
                url:'../../design/'+id+'',
                type: "post",
                data: { emails:favorite.join(", ") },
                success: function(data){
                    $("#popup").show();
                    $('#popup').fadeOut(3000); 
                  
                }
            });
            // alert(id);
   }    
</script>