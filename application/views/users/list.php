<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php echo anchor(site_url('cms/users/create'), '<i class="fa fa-plus-circle"></i> Tambah', 'class="btn btn-success"'); ?>
        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($users_data as $users)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $users->name ?></td>
                    <td><?php echo $users->nip ?></td>
                    <td><?php echo $users->username ?></td>
                    <td><?php echo $users->email ?></td>
                    <td>
                        <?php foreach ($users->groups as $group):?>
                            <?php echo $group->description ;?><br />
                        <?php endforeach?>
                    </td>
                    <td>
                        <?php
                        if($users->active == '1'){
                            echo '<span class="label label-success">Active</span>';
                        }else{
                            echo '<span class="label label-danger">Not Active</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?php
                            echo anchor(site_url('cms/users/update/'.$users->id),'<i class="fa fa-edit"></i>','data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-sm btn-primary"');
                            echo '<button onclick="return confirmModal(\''.base_url('cms/users/delete/'.$users->id).'\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>';
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.box -->