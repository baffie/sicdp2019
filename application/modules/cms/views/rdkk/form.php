<!-- Default box -->
<form action="<?php echo $action; ?>" method="post" class="form-horizontal">
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
            <div class="form-group">
                <label class="col-sm-2 control-label">Kelompok Tani <?php echo form_error('id_poktan') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_poktan', $options_poktan, $id_poktan, 'class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Petani <?php echo form_error('nama_petani') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_petani" id="nama_petani" placeholder="Nama Petani" value="<?php echo $nama_petani; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Luas Tanam <?php echo form_error('luas_tanam') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="luas_tanam" id="luas_tanam" placeholder="Luas Tanam" value="<?php echo $luas_tanam; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Urea</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="urea_1" id="urea_1" placeholder="Musim Tanam I" value="<?php echo $urea_1; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="urea_2" id="urea_2" placeholder="Musim Tanam II" value="<?php echo $urea_2; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="urea_3" id="urea_3" placeholder="Musim Tanam III" value="<?php echo $urea_3; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">SP-36</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="sp_1" id="sp_1" placeholder="Musim Tanam I" value="<?php echo $sp_1; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="sp_2" id="sp_2" placeholder="Musim Tanam II" value="<?php echo $sp_2; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="sp_3" id="sp_3" placeholder="Musim Tanam III" value="<?php echo $sp_3; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">ZA</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="za_1" id="za_1" placeholder="Musim Tanam I" value="<?php echo $za_1; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="za_2" id="za_2" placeholder="Musim Tanam II" value="<?php echo $za_2; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="za_3" id="za_3" placeholder="Musim Tanam III" value="<?php echo $za_3; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">NPK</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="npk_1" id="npk_1" placeholder="Musim Tanam I" value="<?php echo $npk_1; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="npk_2" id="npk_2" placeholder="Musim Tanam II" value="<?php echo $npk_2; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="npk_3" id="npk_3" placeholder="Musim Tanam III" value="<?php echo $npk_3; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Organik</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="organik_1" id="organik_1" placeholder="Musim Tanam I" value="<?php echo $organik_1; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="organik_2" id="organik_2" placeholder="Musim Tanam II" value="<?php echo $organik_2; ?>" />
                        </div>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="organik_3" id="organik_3" placeholder="Musim Tanam III" value="<?php echo $organik_3; ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun <?php echo form_error('tahun') ?></label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Berdiri<?php echo form_error('tahun_berdiri') ?></label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="tahun_berdiri" id="tahun_berdiri" placeholder="Tahun Berdiri" value="<?php echo $tahun_berdiri; ?>" />
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('cms/rdkk') ?>" class="btn btn-default">Batal</a>
        </div>
    </div>
</form>
