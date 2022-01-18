<script type="text/javascript">

  $(document).ready(function() {

    var email1=document.getElementById("email_chat").value;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


     $('#email_chat').keyup(function(){
         $("#content").empty();
         var email=document.getElementById("email_chat").value;
         var content = $(this).val();
               $.ajax({
                  url:'{{route("chat.transcript")}}',
                  global: false,
                  type: "POST",
                  data: ({ team : content }),
                  dataType: "html",
                  async:false,
                  success: function(data) {
                       var myObj=JSON.parse(data);
                       if(myObj==0){
                         var data1="<tr><td>"+email+"</td><td><input type='radio' id='email_check[]' value="+email+" name='mysport'></td></tr>"
                           $("#content").append(data1);
                       }else{
                          var myObj=JSON.parse(data);
                          var html=[];
                          myObj.forEach(function(u) {
                              html="<tr><td>"+u.email+"</td><td><input type='radio' id='email_check[]' value="+u.email+" name='mysport'></td></tr>"
                              $("#content").append(html);
                          });
                       }
                   }
               });
    });


  });
</script>
