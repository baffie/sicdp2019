<div class="box">
<div class="box-header with-border">
<table class="table table-no-bordered" id="mytable">
    <thead>
    <tr>
        <th width="800px"></th>
        <th width="200px">
            <a href="<?php echo site_url('cms/cpm/lpm_kecamatan'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Rekap Kecamatan</a>
        </th>
        <th width="200px">
            <a href="<?php echo site_url('cms/cpm/kabupaten_lpm'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> Rekap Kabupaten</a>
        </th>
    </tr>
    </thead>
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th >Nama Kelurahan/desa</th>
        <th width="200px"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($data_poktan) {
        $start = 0;
        foreach ($data_poktan as $row) {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td align = "left"><a href="<?php echo site_url('cms/cpm/rekap_lpm/view/' . $row['id_desa']); ?>"
                       title="<?php echo $row['nama_kel'] ?>" target="_blank"><?php echo $row['nama_kel'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('cms/cpm/rekap_lpm/view/' . $row['id_desa']); ?>"
                       class="btn btn-sm btn-primary" title="Detail <?php echo $row['nama_kel'] ?>" target="_blank"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <?php
        }
    }else {
        ?>
        <tr>
            <td colspan="4" class="text-center">Data tidak ditemukan!</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
*Data tidak akan tampil jika belum di validasi <br>
*untuk <strong>Validasi</strong> pilih menu <strong>Master</strong> -> pilih <strong>CPM LPM</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</div>
</div>