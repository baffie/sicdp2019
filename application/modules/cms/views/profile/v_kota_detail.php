<p class="text-left hidden-print">
   <a href="javascript:window.print()">Cetak</a> | <!--<a href="<?php echo site_url('rdkk/kota/excel/'.$id_kab)?>">Unduh</a>--> | <a href="<?php echo site_url()?>">Home</a>
</p>
<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-pandeglang.png'); ?>" width="80" alt="Logo Pandeglang"><br>
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Kabupaten Pandeglang</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI CPM LPM KABUPATEN PANDEGLANG </h3><br>
<p>
<!--<strong>Kelurahan/Desa</strong> : <?php echo $desa; ?><br>
<strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>-->  

<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="15%" rowspan="3">Kelompok Tani</th>
        <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
        <th class="text-center" colspan="5">Rekapitulasi Cadangan pangan Masyarakat (Kg)</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="4">Stok Akhir</th>
    </tr>
    <tr class="active">
    </tr>
    </thead>
    <?php
    $start = 0;
    foreach ($rdkk_data as $rdkk)
    {
        ?>
        <tr>
            <td><?php echo ++$start; ?></td>
            <td><?php echo $rdkk['nama_poktan']; ?></td>
            <td class="text-center"><?php echo number_format($rdkk['awal_pengadaan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo number_format ($total_stok,2,',','.') ?></td>
        <td class="text-center"><?php echo number_format ($total_stok_awal,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_stok_awal + $total_penambahan - $total_penyaluran,2,',','.'); ?></td>
    </tr>
    </tfoot>
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                <br><br><br>Mengetahui, <br>
                Kepala Dinas Ketahanan Pangan<br>
                Kabupaten Pandeglang<br>
                <br><br><br><br>
                _____________________________
            </p>
        </td>
        <td>
            <p class="text-center">
                <br><br>Pandeglang, <?php echo dateformatindo(date('d M Y'),2);?><br>
                <br>Operator,<br>
                <br><br><br><br><br>
                _____________________________
            </p>
        </td>
    </tr>
</table>
<p class="text-center hidden-print">
    <a href="javascript:window.print()">Cetak</a> | <!--<a href="<?php echo site_url('rdkk/kota/excel/'.$id_kab)?>">Unduh</a>--> | <a href="<?php echo site_url()?>">Home</a>
</p>
<br>
<p class="text-left hidden-print">
*Data tidak akan tampil jika belum di validasi <br>
*untuk <strong>Validasi</strong> pilih menu <strong>Master</strong> -> pilih <strong>CPM LPM</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong><br>
*kemudian pilih menu <strong>Data</strong> -> pilih <strong>DATA CPM LPM</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</p>