<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php echo anchor(site_url('gapoktan/create'), 'Tambah', 'class="btn btn-primary"'); ?>
            <?php echo anchor(site_url('gapoktan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
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
                <th width="50px">No</th>
                <th>Kelompok Tani</th>
                <th>Alamat</th>
                <th>Gapoktan</th>
                <th>Penyuluh</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($data_poktan) {
                $start = 0;
                foreach ($data_poktan as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><a href="<?php echo site_url('rekap/detail/'.$row['slug']); ?>" title="<?php echo $row['nama_poktan'] ?>"><?php echo $row['nama_poktan'] ?></a></td>
                        <td><?php echo $row['alamat'] ?></td>
                        <td><?php echo $row['nama_gapoktan'] ?></td>
                        <td><?php echo $row['id_penyuluh'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo site_url('rekap/detail/'.$row['slug']); ?>" class="btn btn-sm btn-success">Detail</a>
                                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-print fa-lg"></i></a>
                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-save fa-lg"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <tr>
                    <td colspan="6" class="text-center">Data belum tersedia!</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.box -->