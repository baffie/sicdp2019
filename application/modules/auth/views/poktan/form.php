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
                <label class="col-sm-3 control-label">Nama Poktan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_poktan" id="nama_poktan" placeholder="Nama Kelompok Tani" value="<?php echo $nama_poktan; ?>" />
                    <?php
                    if (form_error('nama_poktan'))
                    {
                        echo '<small class="help-block">'.form_error('nama_poktan').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Gapoktan</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_gapoktan', $load_gapoktan, $id_gapoktan, 'class="form-control"'); ?>
                    <?php
                    if (form_error('id_gapoktan'))
                    {
                        echo '<small class="help-block">'.form_error('id_gapoktan').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Sektor</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_sektor', $load_sector, $id_sektor, 'id="id_sektor" class="form-control"'); ?>
                    <?php
                    if (form_error('id_sektor'))
                    {
                        echo '<small class="help-block">'.form_error('id_sektor').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Sub Sektor</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_subsektor', $load_subsektor, $id_subsektor, 'id="id_subsektor" class="form-control"'); ?>
                    <?php
                    if (form_error('id_subsektor'))
                    {
                        echo '<small class="help-block">'.form_error('id_subsektor').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Komoditas</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="komoditas" id="komoditas" placeholder="Komoditas" value="<?php echo $komoditas; ?>" />
                    <?php
                    if (form_error('komoditas'))
                    {
                        echo '<small class="help-block">'.form_error('komoditas').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Ketua</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_ketua" id="nama_ketua" placeholder="Nama Ketua Kelompok Tani" value="<?php echo $nama_ketua; ?>" />
                    <?php
                    if (form_error('nama_ketua'))
                    {
                        echo '<small class="help-block">'.form_error('nama_ketua').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Kampung / Dusun / Jalan / RT / RW"><?php echo $alamat; ?></textarea>
                    <?php
                    if (form_error('alamat'))
                    {
                        echo '<small class="help-block">'.form_error('alamat').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Kelurahan / Desa</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_desa', $load_kelurahan, $id_desa, 'id="id_desa" class="form-control"'); ?>
                    <?php
                    if (form_error('id_desa'))
                    {
                        echo '<small class="help-block">'.form_error('id_desa').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('auth/poktan') ?>" class="btn btn-default">Batal</a>
                </div>
            </div>
    </div>
    <input type="hidden" name="id_poktan" value="<?php echo $id_poktan; ?>" />
    <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
    <input type="hidden" name="id_kabupaten" value="<?php echo $id_kabupaten; ?>" />
    <input type="hidden" name="id_kecamatan" value="<?php echo $id_kecamatan; ?>" />
    </form>
</div>