<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-pandeglang.png') ?>">
    <title>SiCDP Provinsi Banten</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/styles.min.css">
    <?php
    if(isset($css))
    {
        echo $css;
    }
    ?>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container theme">
    <?php
    if(isset($content))
    {
        echo $content;
    }
    ?>
</div>
<script src="<?php echo site_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo site_url('assets/js/bootstrap.min.js')?>"></script>
</body>
</html>