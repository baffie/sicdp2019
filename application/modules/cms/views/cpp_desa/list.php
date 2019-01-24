<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">
			<!--<?php echo anchor(site_url('cms/cpp_desa/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah"'); ?>
			<?php echo anchor(site_url('auth/data_cppkab/rekap'), '<i class="fa fa-eye"></i> Rekap', 'class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Rekap"'); ?>-->
		</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-striped table-bordered dt-responsive nowrap" id="table">
			<thead>
			<tr>
				<th width="5%">No</th>
				<th width="15%">Desa</th>
				<th width="15%">Kecamatan</th>
				<th width="5%">Bulan</th>
				<th width="5%">Tahun</th>
				<th width="5%">Awal Pengadaan</th>
				<th width="5%">Status</th>
				<th width ="10%">Action</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td colspan="11" class="dataTables_empty">Loading data...</td>
			</tr>
			</tbody>
		</table>
		*<strong>CPP DESA</strong> di entri oleh penyuluh/operator, admin hanya kroscek dan melakukan validasi data.<br>
		*untuk <strong>Validasi</strong	> pilih -> <strong>Edit</strong>->pilih opsi -><strong>Status</strong>-> ubah dengan <strong>tervalidasi</strong>-><strong>Update</strong>
	</div>
</div>
<!-- /.box -->