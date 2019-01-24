<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel Penyuluh</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <base href="<?php echo base_url(); ?>">
</head>
<body class="hold-transition login-page">
<div class="register-box">
    <div class="register-logo">
        <a href="<?php echo site_url()?>"><b>Daftar</b> Pengguna</a>
    </div>
    <div class="register-box-body">
        <p class="login-box-msg">
            Lengkapi formulir di bawah ini
        </p>
        <?php echo form_open("cms/register");?>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="name" id="_name" placeholder="Nama Lengkap dan Gelar" value="<?php echo $name; ?>" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <?php
            if (form_error('name'))
            {
                echo '<small class="help-block">'.form_error('name').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?php echo $nip; ?>" />
            <span class="fa fa-bars form-control-feedback"></span>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>
                        <input class="flat-red" type="radio" name="gender" id="gender1" value="L" <?php echo ($gender == 'L')?' checked':'' ?>> Laki-laki
                    </label>
                </div>
                <div class="col-md-6">
                    <label>
                        <input class="flat-red" type="radio" name="gender" id="gender2" value="P" <?php echo ($gender == 'P')?' checked':'' ?>> Perempuan
                    </label>
                </div>
            </div>
            <?php
            if (form_error('gender'))
            {
                echo '<small class="help-block">'.form_error('gender').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Telepon / Handphone" value="<?php echo $phone; ?>" />
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>

        <div class="form-group">
            <?php echo form_dropdown('id_kabupaten', $load_cities, $id_kabupaten, 'id="id_kabupaten" class="form-control"'); ?>
            <?php
            if (form_error('id_kabupaten'))
            {
                echo '<small class="help-block">'.form_error('id_kabupaten').'</small>';
            }
            ?>
        </div>
        <div class="form-group">
            <?php echo form_dropdown('id_kecamatan', $load_kecamatan, $id_kecamatan, 'id="id_kecamatan" class="form-control"'); ?>
            <?php
            if (form_error('id_kecamatan'))
            {
                echo '<small class="help-block">'.form_error('id_kecamatan').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <?php echo form_dropdown('id_desa[]', $load_kelurahan, $id_desa, 'multiple id="id_desa" class="form-control"'); ?>
            <span class="glyphicon glyphicon-globe form-control-feedback"></span>
            <?php
            if (form_error('id_desa'))
            {
                echo '<small class="help-block">'.form_error('id_desa').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" id="email" placeholder="Alamat Email" value="<?php echo $email; ?>" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php
            if (form_error('email'))
            {
                echo '<small class="help-block">'.form_error('email').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="identity" id="identity" placeholder="Username" value="<?php echo $identity; ?>" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <?php
            if (form_error('identity'))
            {
                echo '<small class="help-block">'.form_error('identity').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
            <span class="fa fa-key form-control-feedback"></span>
            <?php
            if (form_error('password'))
            {
                echo '<small class="help-block">'.form_error('password').'</small>';
            }
            ?>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Ulangi Password" value="<?php echo $password_confirm; ?>" />
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <?php
            if (form_error('password_confirm'))
            {
                echo '<small class="help-block">'.form_error('password_confirm').'</small>';
            }
            ?>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Daftar</button>
        <?php echo form_close();?>
        <br>
        <a href="<?php echo site_url('cms   ')?>" class="text-center">Sudah punya Akun, Login di sini <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js') ?>"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $("#id_desa").select2();
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
    });

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

    $("#id_kecamatan").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_desa')?>",{'id_kecamatan' : id},
            function(data){
                var option = "";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kel']+"'>"+data[i]['nama_kel']+"</option>";
                }

                $("#id_desa").html(option);
            },'json');
    });

</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.min.js') ?>"></script>

</body>
</html>