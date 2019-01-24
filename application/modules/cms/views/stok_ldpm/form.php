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
    <form action="<?php echo $action; ?>" method="post">
        <div class="box-body">
            <div class="form-group">
            <label class="col-sm-2 control-label">Kabupaten <?php echo form_error('id_kabupaten') ?></label>
                <div class="col-sm-3">
                    <?php echo form_dropdown('id_kabupaten', $load_cities, $id_kabupaten, 'id="id_kabupaten" class="form-control select2"'); ?>
                </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="varchar">Bulan <?php echo form_error('bulan') ?></label>
                <input type="text" class="form-control" name="bulan" id="bulan" placeholder="bulan" value="<?php echo $bulan; ?>" />
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="varchar">Tahun <?php echo form_error('tahun') ?></label>
                <input type="number" class="form-control" name="tahun" id="tahun" placeholder="tahun" value="<?php echo $tahun; ?>" />
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="varchar">Stok Awal <?php echo form_error('stok_awal') ?></label>
                <input type="number" class="form-control" name="stok_awal" id="stok_awal" placeholder="stok_awal" value="<?php echo $stok_awal; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
            </div>
        </div>
        <div class="box-footer">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('cms/stok_ldpm') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>