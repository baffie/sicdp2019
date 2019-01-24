<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-user"></i> <?php echo $nama_petani; ?></h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th class="text-center" width="3%" rowspan="3">No</th>
				<th class="text-center" width="10%" rowspan="3">Nama Petani</th>
				<th class="text-center" width="5%" rowspan="3">Luas Tanam (Ha)</th>
				<th class="text-center" colspan="20">Kebutuhan Pupuk Bersubsidi (Kg)</th>
			</tr>
			<tr>
				<th class="text-center" colspan="4">UREA</th>
				<th class="text-center" colspan="4">SP-36</th>
				<th class="text-center" colspan="4">ZA</th>
				<th class="text-center" colspan="4">NPK</th>
				<th class="text-center" colspan="4">ORGANIK</th>
			</tr>
			<tr>
				<th width="3%" class="text-center">MT <br>I</th>
				<th width="3%" class="text-center">MT <br>II</th>
				<th width="3%" class="text-center">MT <br>III</th>
				<th width="3%" class="text-center">Jml</th>
				<th width="3%" class="text-center">MT <br>I</th>
				<th width="3%" class="text-center">MT <br>II</th>
				<th width="3%" class="text-center">MT <br>III</th>
				<th width="3%" class="text-center">Jml</th>
				<th width="3%" class="text-center">MT <br>I</th>
				<th width="3%" class="text-center">MT <br>II</th>
				<th width="3%" class="text-center">MT <br>III</th>
				<th width="3%" class="text-center">Jml</th>
				<th width="3%" class="text-center">MT <br>I</th>
				<th width="3%" class="text-center">MT <br>II</th>
				<th width="3%" class="text-center">MT <br>III</th>
				<th width="3%" class="text-center">Jml</th>
				<th width="3%" class="text-center">MT <br>I</th>
				<th width="3%" class="text-center">MT <br>II</th>
				<th width="3%" class="text-center">MT <br>III</th>
				<th width="3%" class="text-center">Jml</th>
			</tr>
			</thead>
			<tr>
				<td class="text-center">1.</td>
				<td><?php echo $nama_petani; ?></td>
				<td class="text-center"><?php echo $luas_tanam; ?></td>
				<td class="text-center"><?php echo $urea_1; ?></td>
				<td class="text-center"><?php echo $urea_2; ?></td>
				<td class="text-center"><?php echo $urea_3; ?></td>
				<td class="text-center"><?php echo $urea_1 + $urea_2 + $urea_3; ?></td>
				<td class="text-center"><?php echo $sp_1; ?></td>
				<td class="text-center"><?php echo $sp_2; ?></td>
				<td class="text-center"><?php echo $sp_3; ?></td>
				<td class="text-center"><?php echo $sp_1 + $sp_2 + $sp_3; ?></td>
				<td class="text-center"><?php echo $za_1; ?></td>
				<td class="text-center"><?php echo $za_2; ?></td>
				<td class="text-center"><?php echo $za_3; ?></td>
				<td class="text-center"><?php echo $za_1 + $za_2 + $za_3; ?></td>
				<td class="text-center"><?php echo $npk_1; ?></td>
				<td class="text-center"><?php echo $npk_2; ?></td>
				<td class="text-center"><?php echo $npk_3; ?></td>
				<td class="text-center"><?php echo $npk_1 + $npk_2 + $npk_3; ?></td>
				<td class="text-center"><?php echo $organik_1; ?></td>
				<td class="text-center"><?php echo $organik_2; ?></td>
				<td class="text-center"><?php echo $organik_3; ?></td>
				<td class="text-center"><?php echo $organik_1 + $organik_2 + $organik_3; ?></td>
			</tr>
		</table>
	</div>
	<div class="box-footer">
		<a href="<?php echo site_url('cms/bulog') ?>" class="btn btn-default">Kembali</a>
		<a href="<?php echo site_url('cms/bulog') ?>" class="btn btn-default">Cetak</a>
	</div>
</div>
<!-- /.box -->

