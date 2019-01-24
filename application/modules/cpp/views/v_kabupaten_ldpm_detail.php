<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Provinsi Banten</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI CPP PROVINSI (LDPM)<br></h3>
<p>
    <strong>Kabupaten/Kota</strong> : <?php echo $kabupaten; ?><br>
    <strong>Provinsi</strong> : Banten<br>

<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="10%" rowspan="3">Gapoktan</th>
        <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
        <th class="text-center" colspan="6">Rekapitulasi CPP (LDPM) (Kg) Gabah</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="row hidden-print" colspan="1">Koordinat Penyaluran</th>
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
            <td><?php echo $rdkk['nama_gapoktan']; ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['awal_pengadaan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyusutan'],2,',','.'); ?></td>
            <td class="row hidden-print"><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rdkk['lokasi'] ?></a></td>
            <td class="text-center"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo number_format ($total_stok,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_stok_awal,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penyusutan,2,',','.'); ?></td>
        <td class="row hidden-print"><?php echo $total_penyusutn; ?></td>
        <td class="text-center"><?php echo number_format ($total_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan,2,',','.'); ?></td>
    </tr>
    </tfoot>
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                <br><br><br>Mengetahui, <br>
                Kepala Dinas Ketahanan Pangan<br>
                Provinsi Banten<br>
                <br><br><br><br>
                DR MOH. ALI FADILLAH
            </p>
        </td>
        <td>
            <p class="text-center">
                <br><br>Serang, <?php echo dateformatindo(date('d M Y'),2);?><br>
                <br>Admin Aplikasi SICDP,<br>
                Provinsi Banten<br><br><br><br><br>
                      RONI GUMILAR, ST
            </p>
        </td>
    </tr>
</table>
<p class="text-center hidden-print">
    <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url('rdkk/kota/excel/'.$id_kab)?>">Unduh</a> | <a href="<?php echo site_url()?>">Home</a>
</p>
