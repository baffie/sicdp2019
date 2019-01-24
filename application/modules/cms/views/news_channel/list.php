<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php echo anchor(site_url('cms/news_channel/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success"'); ?>
        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped" id="table">
            <thead>
            <tr>
                <th width="80px">No</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5" class="dataTables_empty">Loading data...</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>