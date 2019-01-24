<ol class="breadcrumb mb30">
    <li><a href="<?php echo site_url()?>">Home</a></li>
    <li>Data</li>
    <li class="active">CPM LPM Tingkat Kabupaten/Kota</li>
</ol>
<h3 class="mb15 text-center">REKAPITULASI CADANGAN PANGAN CPM LDPM</h3>
<br>
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th >Kabupaten / Kota</th>
        <th</th>
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
                <td align = "left"><a href="<?php echo site_url('cpm/kota_ldpm/view/' . $row['id_kab']); ?>"
                       title="<?php echo $row['nama_kab'] ?>"><?php echo $row['nama_kab'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('cpm/kota_ldpm/view/' . $row['id_kab']); ?>"
                       class="btn btn-sm btn-success" title="Detail <?php echo $row['nama_kab'] ?>"><i class="fa fa-share"></i> Detail</a>
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