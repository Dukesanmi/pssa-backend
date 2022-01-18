$(document).ready(function() {

     $("#Department").change(function(){
              $.ajax({
                    url: "EmailEmergency",
                    type: "post",
                    data: { id : $(this).val() },
                    success: function(data){
                      alert("helllo");
                   $("").html(data);
             }
          });
     });
                    


               
    


    }