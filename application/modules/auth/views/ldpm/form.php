<!-- Default box -->
<form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                <label class="col-sm-2 control-label">Kabupaten <?php echo form_error('id_kab') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_kab', $cities, $id_kab, 'class="form-control select2" id="id_kab"'); ?>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Gapoktan <?php echo form_error('id_gapoktan') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_gapoktan', $load_gpk, $id_gapoktan, 'class="form-control select2" id="id_gapoktan" onChange="getStokAwal()"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal <?php echo form_error('tanggal') ?></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Stok Awal<?php echo form_error('stok_awal') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="stok_awal" id="stok_awal" placeholder="stok awal" value="<?php echo $stok_awal; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Penambahan<?php echo form_error('penambahan') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="penambahan" id="penambahan" placeholder="Penambahan" value="<?php echo $penambahan; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Penyaluran<?php echo form_error('penyaluran') ?></label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="penyaluran" id="penyaluran" placeholder="Penyaluran" value="<?php echo $penyaluran; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
                </div>
            </div>
        <div class="form-group">
             <label class="col-sm-2 control-label">Lokasi Penyaluran<?php echo form_error('lokasi') ?></label>
             <div class="col-sm-3">
                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Longitude, Latitude" value="<?php echo $lokasi; ?>"/>
                <span class="help-block">Format: <strong>-0.000000, 000.000000</strong></span>
             </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Penyusutan <?php echo form_error('penyusutan') ?></label>
            <div class="col-sm-2">
                <input type="number" step="0.01" class="form-control" name="penyusutan" id="penyusutan" placeholder="Penyusutan" value="<?php echo $penyusutan; ?>" size="10" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)"/>
            </div>
        </div>  
        <div class="form-group <?php echo form_error('attach_file') ? 'has-error has-feedback' : '' ?>">
            <label for="attach_file" class="col-sm-2 control-label"> Attach File</label>
            <div class="col-sm-6">
                <input type="file" id="file-3" data-show-upload="false" accept="pdf" name="attach_file">
                <span class="help-block">File extension: <strong>PDF (.pdf)</strong></span>
                <?php
                if (form_error('attach_file'))
                {
                    echo '<p class="help-block">'.form_error('attach_file').'</p>
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
        <div class="box-footer">
            <input type="hidden" name="id_ldpm" value="<?php echo $id_ldpm; ?>" />
            <input type="hidden" name="id_penyuluh" value="<?php echo $id_penyuluh; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('auth/ldpm') ?>" class="btn btn-default">Batal</a>
        </div>
    </div>
</div>    
</form>

<script>
function getStokAwal(){
        var id=document.getElementById('id_gapoktan').value;
       // alert (id);
        
    //var txt = $("input").val();
    $.post("<?php echo site_url()?>/ajax/get_stok_ldpm", {id_gapoktan: id}, function(result){
        //alert (result);
        document.getElementById('stok_awal').value = result ;
        
    });    
}
</script>