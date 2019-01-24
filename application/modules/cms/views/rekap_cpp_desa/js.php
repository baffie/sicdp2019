<script>
    $("#id_kabupaten").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_kecamatan')?>",{'id_kabupaten' : id},
            function(data){
                var option = "<option value='0'>-- Kecamatan --</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kec']+"'>"+data[i]['nama_kec']+"</option>";
                }

                $("#id_kecamatan").html(option);
            },'json');
    });

    $("#id_kecamatan").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_desa')?>",{'id_kecamatan' : id},
            function(data){
                var option = "<option value='0'>-- Desa --</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kel']+"'>"+data[i]['nama_kel']+"</option>";
                }

                $("#id_desa").html(option);
            },'json');
    });
</script>