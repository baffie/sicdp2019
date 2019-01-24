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
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Sektor <?php echo form_error('id_sektor') ?></label>
                <div class="col-sm-6">
                    <?php echo form_dropdown('id_sektor', $load_sector, $id_sektor, 'class="form-control select2"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama <?php echo form_error('id_sektor') ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Sub Sektor" value="<?php echo $name; ?>" />
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('cms/subsektor') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>