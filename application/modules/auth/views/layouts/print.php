<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($page_heading)) { echo $page_heading; } ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">

    <?php
    if(isset($css))
    {
        echo $css;
    }
    ?>
</head>
<body>
<div class="container">
    <?php
    if(isset($content))
    {
        echo $content;
    }
    ?>
</div>
</body>
</html>