<div class="box">
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun Anggaran <?php echo form_error('tahun_anggaran') ?></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="tahun_anggaran" id="tahun" placeholder="Tahun Anggaran" value="<?php echo $tahun_anggaran; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Judul Situs <?php echo form_error('site_title') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_title" id="site_title" placeholder="Site Title" value="<?php echo $site_title; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Url Situs <?php echo form_error('site_url') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_url" id="site_url" placeholder="Site Url" value="<?php echo $site_url; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tag Line <?php echo form_error('tag_line') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tag_line" id="tag_line" placeholder="Tag Line" value="<?php echo $tag_line; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Situs <?php echo form_error('site_name') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name" value="<?php echo $site_name; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Copyright <?php echo form_error('copyright') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="copyright" id="copyright" placeholder="Copyright" value="<?php echo $copyright; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keywords <?php echo form_error('keywords') ?></label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="3" name="keywords" id="keywords" placeholder="Keywords"><?php echo $keywords; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description <?php echo form_error('meta_description') ?></label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description"><?php echo $meta_description; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Googleplus <?php echo form_error('googleplus') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="googleplus" id="googleplus" placeholder="Googleplus" value="<?php echo $googleplus; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Facebook <?php echo form_error('facebook') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="<?php echo $facebook; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Twitter <?php echo form_error('twitter') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" value="<?php echo $twitter; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Youtube <?php echo form_error('youtube') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Youtube" value="<?php echo $youtube; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Instagram <?php echo form_error('instagram') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" value="<?php echo $instagram; ?>" />
                </div>
            </div>
            <fieldset>
                <legend>System</legend>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Site Offline <?php echo form_error('site_offline') ?></label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="site_offline" id="inlineRadio1" value="1" <?php echo ($site_offline == '1')?' checked':'' ?>> Ya
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="site_offline" id="inlineRadio2" value="0" <?php echo ($site_offline == '0')?' checked':'' ?>> Tidak
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Lockscreen</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="lockscreen" id="inlineRadio1" value="Y" <?php echo ($lockscreen == 'Y')?' checked':'' ?>> Ya
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="lockscreen" id="inlineRadio2" value="N" <?php echo ($lockscreen == 'N')?' checked':'' ?>> Tidak
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Lama Lockscreen</label>
                    <div class="col-sm-2">
                        <input type="number" value="<?php echo $lockscreen_time?>" min="1" max="60" class="form-control" name="lockscreen_time">
                        <small class="help-block">menit (maksimal 60 menit)</small>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        </div>
    </form>
</div>