<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Pemerintah Provinsi Banten</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI CPP PROVINSI BANTEN (LDPM)<br></h3>
<p>
    <strong>Kabupaten/Kota</strong> : <?php echo $kabupaten; ?><br>
    <strong>Provinsi</strong> : Banten<br>

<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="10%" rowspan="3">Gapoktan</th>
        <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
        <th class="text-center" colspan="6">Rekapitulasi CPP LDPM (Kg) Gabah</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text-center" colspan="1">Koordinat Penyaluran</th>
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
            <td class="text-center"><?php echo $rdkk['awal_pengadaan']; ?></td>
            <td class="text-center"><?php echo $rdkk['stok_awal']; ?></td>
            <td class="text-center"><?php echo $rdkk['penambahan']; ?></td>
            <td class="text-center"><?php echo $rdkk['penyaluran']; ?></td>
            <td class="text-center"><?php echo $rdkk['penyusutan']; ?></td>
            <td><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rdkk['lokasi'] ?></a></td>
            <td class="text-center"><?php echo $rdkk['akhir']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo $total_stok ?></td>
        <td class="text-center"><?php echo $total_stok_awal; ?></td>
        <td class="text-center"><?php echo $total_penambahan; ?></td>
        <td class="text-center"><?php echo $total_penyaluran; ?></td>
        <td class="text-center"><?php echo $total_penyusutan; ?></td>
        <td class="text-center"><?php echo $total_penyusutn; ?></td>
        <td class="text-center"><?php echo $total_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan; ?></td>
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
