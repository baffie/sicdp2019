<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Operator Panel - SIM SICAPER Pandeglang</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-pandeglang.png') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/responsive.bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css') ?>">
    <?php
    if(isset($css))
    {
        echo $css;
    }
    ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-dialog/css/bootstrap-dialog.min.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <base href="<?php echo base_url(); ?>">
</head>
<?php $this->user = $this->ion_auth->user()->row(); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Header -->
    <?php $this->load->view('layouts/header'); ?>

    <?php $this->load->view('layouts/sidebar'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php
                if(isset($page_heading))
                {
                    echo $page_heading;
                }
                ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                    <?php
                    if(isset($page_heading))
                    {
                        echo $page_heading;
                    }
                    ?>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php
            if(isset($content))
            {
                echo $content;
            }
            ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Footer -->
    <?php $this->load->view('layouts/footer'); ?>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?php echo site_url()?>assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url('assets/plugins/noty/packaged/jquery.noty.packaged.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/responsive.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-dialog/js/bootstrap-dialog.min.js') ?>"></script>
<script type="text/javascript">


    $("#id_kabupaten").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_kecamatan')?>",{'id_kabupaten' : id},
            function(data){
                var option = "<option value='0'>--Pilih Kecamatan--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kec']+"'>"+data[i]['nama_kec']+"</option>";
                }

                $("#id_kecamatan").html(option);
            },'json');
    });
    
    $("#id_kab").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_gapoktan')?>",{'id_kab' : id},
            function(data){
                var option = "<option value='0'>--Pilih--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_gapoktan']+"'>"+data[i]['nama_gapoktan']+"</option>";
                }

                $("#id_gapoktan").html(option);
            },'json');
    });
    
    $("#id_kabu").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_poktan')?>",{'id_kab' : id},
            function(data){
                var option = "<option value='0'>--Pilih--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_poktan']+"'>"+data[i]['nama_poktan']+"</option>";
                }

                $("#id_poktan").html(option);
            },'json');
    });
    
    $("#id_kabup").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_cpp_gapoktan')?>",{'id_kab' : id},
            function(data){
                var option = "<option value='0'>--Pilih--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_gapoktan']+"'>"+data[i]['nama_gapoktan']+"</option>";
                }

                $("#id_gapoktan").html(option);
            },'json');
    });

    $("#id_kecamatan").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_desa')?>",{'id_kecamatan' : id},
            function(data){
                var option = "<option value='0'>--Pilih Desa--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kel']+"'>"+data[i]['nama_kel']+"</option>";
                }

                $("#id_desa").html(option);
            },'json');
    });

    $("#id_sektor").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_subsektor')?>",{'id_sektor' : id},
            function(data){
                var option = "<option value='0'>--Pilih--</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";
                }

                $("#id_subsektor").html(option);
            },'json');
    });
</script>
<?php
if(isset($js))
{
    echo $js;
}
?>
<script type="text/javascript">
    function confirmModal(url){
        BootstrapDialog.confirm({
            title: 'Konfirmasi',
            message: 'Anda yakin akan menghapus?',
            closable: true,
            draggable: true,
            btnCancelLabel: 'Batal',
            callback: function(result) {
                if(result) { location.href = url; }
            }
        });
    }
    <?php if($this->session->flashdata('error')):?>
    $(document).ready(function () {
        msg_noty('<?php echo $this->session->userdata('error')?>','error');
    });
    <?php endif;?>
    <?php if($this->session->flashdata('success')):?>
    $(document).ready(function () {
        msg_noty('<?php echo $this->session->userdata('success')?>','success');
    });
    <?php endif;?>

    function msg_noty(text,type){
        $.noty.clearQueue();
        var n = noty({
            layout: 'topRight',
            type: type,
            text: text,
           // theme : 'relax',
            timeout : 3000,
            animation: {
                open: 'animated fadeInRight', // Animate.css class names
                close: 'animated fadeOutRight', // Animate.css class names
                easing: 'swing', // easing
                speed: 500 // opening & closing animation speed
            }
        });
    }
</script>
<script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
</body>
</html>