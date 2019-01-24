<div class="box">
<div class="box-header with-border">
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Desa</th>
        <th width="200px"><a href="<?php echo site_url('cms/cpp/cpp_kec'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> All Kecamatan</a></th>
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
                <td><a href="<?php echo site_url('cms/cpp/cpp_desa_rekap/view/'.$row['id_desa']); ?>" target="_blank" title="<?php echo $row['id_desa'] ?>"><?php echo $row['nama_kel'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('cms/cpp/cpp_desa_rekap/view/'.$row['id_desa']); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td colspan="6" class="text-center">Data tidak ditemukan!</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
*Data <strong>CPP DESA</strong> tidak akan tampil jika belum di validasi<br>
*untuk <strong>Validasi</strong> pilih menu <strong>Master</strong> -> pilih <strong>CPP DESA</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</div>
</div>