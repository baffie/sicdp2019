<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">
			<?php echo anchor(site_url('auth/rdkk/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success" title="Tambah"'); ?>
			<?php echo anchor(site_url('auth/rdkk/excel'), '<i class="fa fa-download"></i> Excel', 'class="btn btn-primary" title="Unduh Excel"'); ?>
		</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="table">
			<thead>
			<tr>
				<th width="5%">No</th>
				<th>Nama Petani</th>
				<th>Kelompok Tani</th>
				<th>Luas Tanam (Ha)</th>
				<th>Urea</th>
				<th>SP-36</th>
				<th>ZA</th>
				<th>NPK</th>
				<th>Organik</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td colspan="11" class="dataTables_empty">Loading data...</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>