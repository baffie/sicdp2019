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
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
        <div class="box-body">
            <div class="form-group <?php echo form_error('parent_id') ? 'has-error has-feedback' : '' ?>">
                <label for="parent_id" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('parent_id', $category_parent, $parent_id, 'class="form-control select2"'); ?>
                    <?php
                    if (form_error('parent_id'))
                    {
                        echo '<p class="help-block">'.form_error('parent_id').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('name') ? 'has-error has-feedback' : '' ?>">
                <label for="name" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" />
                    <?php
                    if (form_error('name'))
                    {
                        echo '<p class="help-block">'.form_error('name').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('status') ? 'has-error has-feedback' : '' ?>">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-2">
                    <select class="form-control" name="status">
                        <option value="1" <?php echo ($status == 1) ? 'selected="selected"' : ''; ?>>Active</option>
                        <option value="0" <?php echo ($status == 0) ? 'selected="selected"' : ''; ?>>Not Active</option>
                    </select>
                    <?php
                    if (form_error('status'))
                    {
                        echo '<p class="help-block">'.form_error('status').'</p>
					<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('cms/news_channel') ?>" class="btn btn-default">Batal</a>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />

        </div>
    </form>
</div>