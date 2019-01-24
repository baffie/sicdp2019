<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css') ?>">
    <?php
    if(isset($css))
    {
        echo $css;
    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <base href="<?php echo base_url(); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo site_url()?>"><b>Login</b> Penyuluh</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">
            Silakan login di sini
        </p>
        <?php
        if (!empty($message)):
            ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php echo form_open("auth/login");?>
        <div class="form-group">
            <input type="text" class="form-control" name="identity" id="identity" value="<?php echo $this->form_validation->set_value('identity')?>" placeholder="Username" autofocus required />
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required />
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Masuk</button>
        <?php echo form_close();?>
        <br>
        <a href="<?php echo site_url()?>">Halaman depan</a><br>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
</body>
</html>