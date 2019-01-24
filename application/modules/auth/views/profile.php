<div class="box">

    <?php echo form_open(site_url('auth/profile'),array('class' => 'form-horizontal'));?>
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Lengkap <small class="text-danger">*</small></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" id="_name" placeholder="Nama Lengkap" value="<?php echo $name; ?>" />
                <?php
                if (form_error('name'))
                {
                    echo '<small class="help-block">'.form_error('name').'</small>';
                }
                ?>
                <small class="help-block">Isi Nama lengkap dengan gelar</small>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">NIP</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?php echo $nip; ?>" />
            </div>
        </div>
        ?<div class="form-group">
            <label class="col-sm-2 control-label">Wilayah Binaan <small class="text-danger">*</small></label>
            <div class="col-sm-6">
                <?php echo form_dropdown('id_desa[]', $load_kelurahan, $id_desa, 'multiple id="id_desa" class="form-control select2"'); ?>
                <?php
                if (form_error('id_desa'))
                {
                    echo '<small class="help-block">'.form_error('id_desa').'</small>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin <small class="text-danger">*</small></label>
            <div class="col-sm-6">
                <label class="radio-inline">
                    <input type="radio" name="gender" id="inlineRadio1" value="L" <?php echo ($gender == 'L')?' checked':'' ?>> Laki-laki
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" id="inlineRadio2" value="P" <?php echo ($gender == 'P')?' checked':'' ?>> Perempuan
                </label>
                <?php
                if (form_error('gender'))
                {
                    echo '<small class="help-block">'.form_error('gender').'</small>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Telepon" value="<?php echo $phone; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                <small class="help-block">Isi jika ingin mengubah password</small>
                <?php
                if (form_error('password'))
                {
                    echo '<small class="help-block">'.form_error('password').'</small>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Ulangi Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Ulangi Password" />
                <small class="help-block">Isi jika ingin mengubah password</small>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_hidden('id', $user->id);?>
        <?php echo form_hidden($csrf); ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    <?php echo form_close();?>
</div>