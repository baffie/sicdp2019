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
     <div class="form-group">
                <label class="col-sm-2 control-label">Nama poktan <?php echo form_error('nama_poktan') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_gapoktan" id="nama_poktan" placeholder="Nama Poktan" value="<?php echo $nama_poktan; ?>" />
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
                <label for="varchar">Stok Awal <?php echo form_error('stok_awal') ?></label>
                <input type="number" class="form-control" name="stok_awal" id="stok_awal" placeholder="stok_awal" value="<?php echo $stok_awal; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
            </div>
        </div>
        <div class="box-footer">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('cms/stok_lpm') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>