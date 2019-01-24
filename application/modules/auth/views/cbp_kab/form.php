<!-- Default box -->
<form action="<?php echo $action; ?>" method="post" class="form-horizontal" >
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
             <!--<div class="form-group">
                <label class="col-sm-2 control-label">Kabupaten <?php echo form_error('id_kabupaten') ?></label>
                <div class="col-sm-3">
                    <?php echo form_dropdown('id_kabupaten', $load_cities, $id_kabupaten, 'id="id_kabupaten" class="form-control select2"'); ?>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Awal Pengadaan <?php echo form_error('awal_pengadaan') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="awal_pengadaan" id="awal_pengadaan" placeholder="Awal Pengadaan" value="<?php echo $awal_pengadaan; ?>" size="4" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Bulan <?php echo form_error('bulan_pengadaan') ?></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="bulan_pengadaan" id="bulan_pengadaan" placeholder="Bulan" value="<?php echo $bulan_pengadaan; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun <?php echo form_error('tahun_pengadaan') ?></label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="tahun_pengadaan" id="tahun_pengadaan" placeholder="Tahun" value="<?php echo $tahun_pengadaan; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
        <div class="box-footer">
            <input type="hidden" name="id_cbp" value="<?php echo $id_cbp; ?>" />
            <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
            <input type="hidden" name="id_kabupaten" value="<?php echo $id_kabupaten; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('auth/cbp_kab') ?>" class="btn btn-default">Batal</a>
        </div>
    </div>
</form>
