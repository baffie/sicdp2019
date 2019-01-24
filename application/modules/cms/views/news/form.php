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
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open_multipart($action, $attributes);
    ?>
    <div class="box-body">
        <div class="form-group <?php echo form_error('channel_id') ? 'has-error has-feedback' : '' ?>">
            <label for="type" class="col-sm-2 control-label">Channel <span class="text-danger">*</span></label>
            <div class="col-sm-3">
                <?php echo form_dropdown('channel_id', $options_channel, $channel_id, 'class="form-control select2"'); ?>
                <?php
                if (form_error('channel_id'))
                {
                    echo '<p class="help-block">'.form_error('channel_id').'</p>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('subtitle') ? 'has-error has-feedback' : '' ?>">
            <label for="subtitle" class="col-sm-2 control-label">Sub Judul</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="subtitle" id="subtitle" value="<?php echo $subtitle; ?>" />
                <?php
                if (form_error('subtitle'))
                {
                    echo '<p class="help-block">'.form_error('subtitle').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('title') ? 'has-error has-feedback' : '' ?>">
            <label for="title" class="col-sm-2 control-label">Judul <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" />
                <?php
                if (form_error('title'))
                {
                    echo '<p class="help-block">'.form_error('title').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('summary') ? 'has-error has-feedback' : '' ?>">
            <label for="summary" class="col-sm-2 control-label">Ringkasan <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="summary" id="summary"><?php echo $summary; ?></textarea>
                <?php
                if (form_error('summary'))
                {
                    echo '<p class="help-block">'.form_error('summary').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('content') ? 'has-error has-feedback' : '' ?>">
            <label for="content" class="col-sm-2 control-label">Konten <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control wysihtml5" rows="10" name="content" id="content"><?php echo $content; ?></textarea>
                <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                    <span>* Tekan "<strong>Enter</strong>" untuk membuat paragraf atau baris baru</span>
                    <?php
                    if (form_error('content'))
                    {
                        echo '<p class="help-block">'.form_error('content').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                    }
                    ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('images_content') ? 'has-error has-feedback' : '' ?>">
            <label for="images_content" class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-8">
                <input type="file" id="file-3" data-show-upload="false" accept="image/*" name="foto">
                <span class="help-block">File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span>
                <?php
                if (form_error('images_content'))
                {
                    echo '<p class="help-block">'.form_error('images_content').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('images_caption') ? 'has-error has-feedback' : '' ?>">
            <label for="images_caption" class="col-sm-2 control-label">Caption Foto</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="images_caption" id="images_caption"><?php echo $images_caption; ?></textarea>
                <?php
                if (form_error('images_caption'))
                {
                    echo '<p class="help-block">'.form_error('images_caption').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('keyword') ? 'has-error has-feedback' : '' ?>">
            <label for="keyword" class="col-sm-2 control-label">Keyword/Tags</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="keyword" id="keyword" value="<?php echo $keyword; ?>" />
                <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                    <span>* Isi dengan 1 (satu) atau lebih Keywords/Tags, dipisahkan dengan tanda koma.</span>
                    <?php
                    if (form_error('keyword'))
                    {
                        echo '<p class="help-block">'.form_error('keyword').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                    }
                    ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('source') ? 'has-error has-feedback' : '' ?>">
            <label for="source" class="col-sm-2 control-label">Sumber</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="source" id="source" value="<?php echo $source; ?>" />
                <?php
                if (form_error('source'))
                {
                    echo '<p class="help-block">'.form_error('source').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                }
                ?>
            </div>
        </div>

        <div class="form-group <?php echo form_error('status') ? 'has-error has-feedback' : '' ?>">
            <label for="status" class="col-sm-2 control-label">Status <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="status" id="status" class="form-control select2">
                    <option value="1" <?php echo ($status == '1')?' selected':'' ?>>Publish</option>
                    <option value="0" <?php echo ($status == '0')?' selected':'' ?>>Draft</option>
                </select>
                <?php
                if (form_error('status'))
                {
                    echo '<p class="help-block">'.form_error('status').'</p>';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('cms/news') ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </div>
    <?php echo form_close(); ?>
</div>