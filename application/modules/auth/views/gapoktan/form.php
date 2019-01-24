<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo $button ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Gapoktan <?php echo form_error('nama_gapoktan') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_gapoktan" id="nama_gapoktan" placeholder="Nama Gapoktan" value="<?php echo $nama_gapoktan; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ketua Gapoktan <?php echo form_error('ketua_gapoktan') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ketua_gapoktan" id="ketua_gapoktan" placeholder="Ketua Gapoktan" value="<?php echo $ketua_gapoktan; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Desa <?php echo form_error('id_desa') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_desa', $load_kelurahan, $id_desa, 'id="id_desa" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('auth/gapoktan') ?>" class="btn btn-default">Batal</a>
                </div>
            </div>
            <input type="hidden" name="id_gapoktan" value="<?php echo $id_gapoktan; ?>" />
            <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
            <input type="hidden" name="id_kabupaten" value="<?php echo $id_kabupaten; ?>" />
            <input type="hidden" name="id_kecamatan" value="<?php echo $id_kecamatan; ?>" />
        </form>
    </div>
</div>