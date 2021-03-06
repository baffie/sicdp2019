<!-- Default box -->
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
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                    <span class="help-block">Isi Nama lengkap dengan gelar</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?php echo $nip; ?>" />
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

            <!--<div class="form-group">
                <label class="col-sm-2 control-label">Kabupaten/Kota</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_kabupaten', $load_cities, $id_kabupaten, 'id="id_kabupaten" class="form-control select2"'); ?>
                    <?php
                    if (form_error('id_kabupaten'))
                    {
                        echo '<small class="help-block">'.form_error('id_kabupaten').'</small>';
                    }
                    ?>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Kecamatan</label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_kecamatan', $load_kecamatan, $id_kecamatan, 'id="id_kecamatan" class="form-control select2"'); ?>
                    <?php
                    if (form_error('id_kecamatan'))
                    {
                        echo '<small class="help-block">'.form_error('id_kecamatan').'</small>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kel / Desa Binaan</label>
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
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
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
                </div>
            </div>

            <?php if ($this->ion_auth->is_admin()): ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Level User</label>
                    <div class="col-sm-6">
                        <?php foreach ($groups as $group):?>
                            <label class="checkbox-inline">
                                <?php
                                $gID=$group['id'];
                                $checked = null;
                                $item = null;
                                foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked= ' checked="checked"';
                                        break;
                                    }
                                }
                                ?>
                                <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                <?php echo $group['description'];?>
                            </label>
                        <?php endforeach?>
                    </div>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status <small class="text-danger">*</small></label>
                <div class="col-sm-6">
                    <select name="active" id="active" class="form-control select2">
                        <option value="0" <?php echo ($active == '0')?' selected':'' ?>>Not Active</option>
                        <option value="1" <?php echo ($active == '1')?' selected':'' ?>>Active</option>
                    </select>
                </div>
            </div>
    </div>
    <div class="box-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('cms/users') ?>" class="btn btn-default">Batal</a>
    </div>
    </form>
</div>
<!-- /.box -->