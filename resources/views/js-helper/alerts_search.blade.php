<script>

        $("#search").keyup(function () {
            $.ajax({
                url:"{{route('alert.index')}}",
                type:'get',
                data:{'search_key':$("#search").val()},
                success:function (data) {
                    var result= JSON.parse(data);
                    if(result.length>0){
                        $("#country-list").empty();
                        $("#suggesstion-box").show();
                        $("#country-list").show();
                        $("#search-box").css("background","#FFF");
                        let html;
                        $.each(result,function (index,value) {
                            if(value.name!=null){
                                html=`<li onclick="selectCountry('${value.name}')">${value.name}</li>`;
                                $("#country-list").append(html);
                            }

                        });
                    }else{
                        $("#country-list").hide();
                        $("#suggesstion-box").hide();
                    }
                }
            });
        });
        function selectCountry(val) {
            $("#search").val(val);
            $("#country-list").hide();
            $("#suggesstion-box").hide();
            $("#search-emergency").submit();
        }
</script>