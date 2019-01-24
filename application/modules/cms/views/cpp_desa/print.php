<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title pull-right">
            <a href="javascript:window.print()" class="btn btn-danger hidden-print" title="Cetak"><i class="fa fa-print"></i> Cetak</a>
            <a href="javascript:history.back()" class="btn btn-primary hidden-print" title="Kembali">Kembali</a>
        </h3>
    </div>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Pemerintah Provinsi Banten</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI CPP DESA<br></h3>
<p>
    <strong>Kabupaten/Kota</strong> : <?php echo $kabupaten; ?><br>
    <strong>Provinsi</strong> : Banten<br>

<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="10%" rowspan="3">Tanggal</th>
        <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
        <th class="text-center" colspan="7">Rekapitulasi Cadangan pangan Masyarakat (Kg)</th>
        <th class="text-center" width="10%" rowspan="4">Keterangan</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text-center hidden-print" colspan="1">Koordinat Penyaluran</th>
        <th class="text-center" colspan="2">Stok Akhir</th>
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
            <td><?php echo $rdkk['tanggal']; ?></td>
            <td class="text-center"><?php echo $rdkk['awal_pengadaan']; ?></td>
            <td class="text-center"><?php echo $rdkk['stok_awal']; ?></td>
            <td class="text-center"><?php echo $rdkk['penambahan']; ?></td>
            <td class="text-center"><?php echo $rdkk['penyaluran']; ?></td>
            <td class="text-center"><?php echo $rdkk['penyusutan']; ?></td>
            <td class="text-center hidden-print"><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rdkk['lokasi'] ?></a></td>
            <td class="text-center" colspan="2"><?php echo $rdkk['akhir']; ?></td>
            <td class="text-center" colspan="2"><?php echo $rdkk['keterangan']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo $total_stok ?></td>
        <td class="text-center"><?php echo $get_stok_awal; ?></td>
        <td class="text-center"><?php echo $total_penambahan; ?></td>
        <td class="text-center"><?php echo $total_penyaluran; ?></td>
        <td class="text-center"><?php echo $total_penyusutan; ?></td>
        <td class="text-center hidden-print"><?php echo $total_penyusutn; ?></td>
        <td class="text-center" colspan="2"><?php echo $rdkk['akhir']; ?></td>
        <td class="text-center" colspan="2"><?php echo $total_penyusutn; ?></td>
    </tr>
    </tfoot>
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                <br>Diketahui,<br>
                Pimpinan Kelembagaan Penyuluhan<br>Kabupaten/Kota<br><br><br><br><br>
                _____________________________
            </p>
        </td>
        <td>
            <p class="text-center">
                <?php echo $kabupaten; ?>, <?php echo dateformatindo(date('d M Y'),2);?><br>
                Kepala Dinas Tanaman Pangan/<br>
                Perkebunan/ Peternakan/ Perikanan *)<br>
                Kabupaten/Kota,<br><br><br><br><br>
                _____________________________
            </p>
        </td>
    </tr>
</table>
