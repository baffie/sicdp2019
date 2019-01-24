<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $total_lpm ?></h3>
						<p>Data CPM LPM</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('auth/lpm')?>" class="small-box-footer">
						Selengkapnya <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $total_ldpm ?></h3>
						<p>Data CPM LDPM</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('auth/ldpm')?>" class="small-box-footer">
						Selengkapnya <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $total_data_cppkab ?></h3>

						<p>Data CPP Kab/kota</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('auth/data_cppkab')?>" class="small-box-footer">
						Selengkapnya <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $total_cpp ?></h3>

						<p>CPP Kab/kota</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('auth/cpp_kab')?>" class="small-box-footer">
						Selengkapnya <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $total_cpm_ldpm ?></h3>

						<p>CPM LDPM</p>
					</div>
					<div class="icon">
						<i class="fa fa-group"></i>
					</div>
					<a href="<?php echo site_url('auth/cpm_ldpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $total_cpm_lpm ?></h3>

						<p>CPM LPM</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="<?php echo site_url('auth/cpm_lpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>