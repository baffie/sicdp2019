<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <!--<h3 class="box-title">
            <?php echo anchor(site_url('auth/cpm_ldpm/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah"'); ?>
        </h3>-->

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
                <th>Nama Gapoktan</th>
                <th>Ketua Gapoktan</th>
                <th>Angota</th>
                <th>Luas Lahan</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Status</th>
                <th width="60px">Action</th>
                <th width="30">Lokasi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="7" class="dataTables_empty">Loading data...</td>
            </tr>
            </tbody>
        </table>
        *<strong>CPM LDPM</strong> di entri oleh penyuluh/operator, admin hanya kroscek dan melakukan validasi data.<br>
        *untuk <strong>Validasi</strong	> pilih -> <strong>Edit</strong>->pilih opsi -><strong>Status</strong>-> ubah dengan <strong>tervalidasi</strong>-><strong>Update</strong>
    </div>
</div>
<!-- /.box -->