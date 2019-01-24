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
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Poktan <?php echo form_error('nama_poktan') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_poktan" id="nama_poktan" placeholder="Nama Kelompok Tani" value="<?php echo $nama_poktan; ?>" />
                </div>
            </div>
           <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Gapoktan <?php echo form_error('id_gapoktan') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_gapoktan', $load_gapoktan, $id_gapoktan, 'class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sektor <?php echo form_error('id_sektor') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_sektor', $load_sector, $id_sektor, 'id="id_sektor" class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sub Sektor <?php echo form_error('id_subsektor') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_subsektor', $load_subsektor, $id_subsektor, 'id="id_subsektor" class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Komoditas <?php echo form_error('komoditas') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="komoditas" id="komoditas" placeholder="Komoditas" value="<?php echo $komoditas; ?>" />
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Ketua <?php echo form_error('nama_ketua') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_ketua" id="nama_ketua" placeholder="Nama Ketua Kelompok Tani" value="<?php echo $nama_ketua; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Alamat <?php echo form_error('alamat') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Kampung / Dusun / Jalan / RT / RW" value="<?php echo $alamat; ?>" />
                </div>
            </div>
                <!--<div class="form-group">
                <label class="col-sm-2 control-label">Kabupaten <?php echo form_error('id_kabupaten') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_kab', $load_cities, $id_kabupaten, 'id="id_kabupaten" class="form-control select2"'); ?>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Kecamatan <?php echo form_error('id_kecamatan') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_kecamatan', $load_kecamatan, $id_kecamatan, 'id="id_kecamatan" class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Desa <?php echo form_error('id_desa') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_desa', $load_kelurahan, $id_desa, 'id="id_desa" class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Berdiri <?php echo form_error('tahun_berdiri') ?></label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="tahun_berdiri" id="tahun_berdiri" placeholder="Tahun Berdiri" value="<?php echo $tahun_berdiri; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Anggota <?php echo form_error('jumlah_anggota') ?></label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="jumlah_anggota" id="jumlah_anggota" placeholder="Jumlah Anggota" value="<?php echo $jumlah_anggota; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Luas Lahan ( Ha ) <?php echo form_error('luas_lahan') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="luas_lahan" id="luas_lahan" placeholder="Luas Lahan" value="<?php echo $luas_lahan; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Lokasi <?php echo form_error('lokasi') ?></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Longitude, Latitude" value="<?php echo $lokasi; ?>"/>
                    <span class="help-block">Format: <strong>-0.000000, 000.000000</strong></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Awal Pengadaan </label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="number" step="0.01" class="form-control" name="awal_pengadaan" id="awal_pengadaan" placeholder="Pengadaan" value="<?php echo $awal_pengadaan; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
                        </div>
                        <!--<div class="col-xs-2">
                            <input type="number" class="form-control" name="tahun_pengadaan" id="tahun_pengadaan" placeholder="Tahun" value="<?php echo $tahun_pengadaan; ?>" />
                        </div>-->
                    </div>
                </div>
            </div>   
        <div class="form-group <?php echo form_error('foto') ? 'has-error has-feedback' : '' ?>">
            <label for="foto" class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-8">
                <input type="file" id="file-3" data-show-upload="false" accept="image/*" name="foto">
                <span class="help-block">File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span>
                <?php
                if (form_error('foto'))
                {
                    echo '<p class="help-block">'.form_error('foto').'</p>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('keterangan') ? 'has-error has-feedback' : '' ?>">
            <label for="summary" class="col-sm-2 control-label">Keterangan </label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="5" name="keterangan" id="keterangan"><?php echo $keterangan; ?></textarea>
                <?php
                if (form_error('keterangan'))
                {
                    echo '<p class="help-block">'.form_error('keterangan').'</p>
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        </div>
        <div class="form-group">
                <label class="col-sm-2 control-label">Status <small class="text-danger">*</small></label>
                <div class="col-sm-4">
                    <select name="status" id="status" class="form-control select2">
                        <option value="0" <?php echo ($status == '0')?' selected':'' ?>>Belum Validasi</option>
                        <option value="1" <?php echo ($status == '1')?' selected':'' ?>>Tervalidasi</option>
                    </select>
                </div>
            </div>
        <div class="box-footer">
            <input type="hidden" name="id_poktan" value="<?php echo $id_poktan; ?>" />
            <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
            <input type="hidden" name="id_kabupaten" value="<?php echo $id_kabupaten; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('cms/cpm_lpm') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>