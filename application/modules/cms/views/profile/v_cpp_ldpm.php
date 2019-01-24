<div class="box">
    <div class="box-header with-border">
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Kelompok Tani</th>
        <th>Alamat</th>
        <th>Luas Lahan</th>
        <th>Anggota</th>
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
                <td><a href="<?php echo site_url('profil/cpp_ldpm/data/'.$row['slug']); ?>" title="<?php echo $row['nama_gapoktan'] ?>"><?php echo $row['nama_gapoktan'] ?></a></td>
                <td><?php echo $row['alamat'] ?></td>
                <td><?php echo number_format ($row['luas_lahan'],2,',','.'); ?></td>
                <td><?php echo $row['jumlah_anggota'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td>
                    <a href="<?php echo site_url('profil/cpp_ldpm/view/'.$row['slug']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
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
</div>
</div>