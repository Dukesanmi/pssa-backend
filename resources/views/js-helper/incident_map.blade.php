<script>

function getAlert(id)
{ 
	 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });

	 var b="{{route('incident.details')}}";

	 alert(b);


          // $.ajax({
          //           url:b,
          //           type:'GET',
          //           data:{id:id},
          //           success: function (data) {
          //       var name=data.department_id;
          //           }

          //           $("#user_name").html(name);
          //       });




	 
}



</script>