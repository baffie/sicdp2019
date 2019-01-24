<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-pandeglang.png') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo setting('site_title').' - '.setting('tag_line'); ?></title>
	<meta name="description" content="<?php echo setting('meta_description'); ?>">
	<meta name="keywords" content="<?php echo setting('keywords'); ?>">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/style.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/styles.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/owl-carousel/owl.carousel.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/owl-carousel/owl.theme.default.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/revslider/css/settings.min.css')?>">
	<style>

	</style>
	<?php
	if(isset($css))
	{
		echo $css;
	}
	?>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
	<link rel="canonical" href="<?php echo (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>">
</head>
<body>
<?php $this->load->view('frontend/layouts_2/header'); ?>
<div class="container theme">
	<?php
	if(isset($content))
	{
		echo $content;
	}
	?>
</div>
<?php $this->load->view('frontend/layouts_2/footer'); ?>
<div id="totop" class="fa fa-angle-up" title="To Top"></div>
<script src="<?php echo site_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo site_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo site_url('assets/js/jquery.lazyload.min.js')?>"></script>
<script src="<?php echo site_url()?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo site_url()?>assets/plugins/revslider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo site_url()?>assets/plugins/revslider/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo site_url('assets/js/banten.js')?>"></script>
<?php
if(isset($js))
{
	echo $js;
}
?>
</body>
</html>