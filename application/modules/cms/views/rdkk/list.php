<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">
			<?php echo anchor(site_url('cms/rdkk/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah"'); ?>
			<?php echo anchor(site_url('cms/rdkk/excel'), '<i class="fa fa-download"></i> Excel', 'class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Unduh Excel"'); ?>
		</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel panel-default">
					<div class="panel-body">
						<form action="" method="post" id="form_filter">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kabupaten / Kota</label>
										<?php echo form_dropdown('id_kabupaten', $load_cities, '', 'id="id_kabupaten" class="form-control"'); ?>
									</div>
									<div class="form-group">
										<label class="control-label">Sub Sektor</label>
										<?php echo form_dropdown('id_subsektor', $load_subsektor, '', 'id="id_subsektor" class="form-control"'); ?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kecamatan</label>
										<?php echo form_dropdown('id_kecamatan', '', '', 'id="id_kecamatan" class="form-control"'); ?>
									</div>
									<div class="form-group">
										<label class="control-label">Tahun</label>
										<select name="tahun" id="tahun" class="form-control select2">
											<option value="0">Tahun</option>
											<?php
											$now = date("Y");
											$tahun = setting('tahun_anggaran');
											for($year = $tahun; $year <= '2021'; $year++)
											{
												?>
												<option value="<?php echo $year?>" <?php echo ($year == $now) ? 'selected' : '';?>><?php echo $year?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kelurahan / Desa</label>
										<?php echo form_dropdown('id_desa', '', '', 'id="id_desa" class="form-control"'); ?>
									</div>
									<label class="control-label">&nbsp;</label>
									<button type="submit" class="btn btn-info btn-block">
										Filter <i class="fa fa-filter"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered dt-responsive nowrap" id="table">
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
<!-- /.box -->