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
        <div class="form-group <?php echo form_error('description') ? 'has-error has-feedback' : '' ?>">
            <label for="description" class="col-sm-2 control-label">Konten <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control wysihtml5" rows="10" name="description" id="description"><?php echo $description; ?></textarea>
                <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                    <span>* Tekan "<strong>Enter</strong>" untuk membuat paragraf atau baris baru</span>
                    <?php
                    if (form_error('description'))
                    {
                        echo '<p class="help-block">'.form_error('description').'</p>
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
                <a href="<?php echo site_url('cms/page') ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        </form>
    </div>
</div>