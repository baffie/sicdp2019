<p class="text-left hidden-print">
    <a href="#" onclick="history.back();">Kembali</a> | <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url('profil/cpp_ldpm/excel/'.$id_gapoktan)?>">Unduh</a> | <a href="<?php echo site_url()?>">Home</a> 
</p>
<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-pandeglang.png'); ?>" width="80" alt="Logo Pandeglang"><br>
        <h4 class="pull-left ml15">Badan Ketahanan Pangan<br>
            Pemerintah Kabupaten Pandeglang</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI DATA CPP LDPM GABUNGAN KELOMPOK TANI</h3>
<p><strong>Kelompok Tani</strong> : <?php echo $nama_gapoktan; ?><br>
    <!--<strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>-->
    <strong>Kelurahan / Desa</strong> : <?php echo $desa; ?><br>
    <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>
    <strong>Kabupaten / Kota</strong> : <?php echo $kabupaten; ?><br>
    <!--<strong>Sub Sektor</strong> : <?php echo $subsektor; ?><br>-->
    <strong>Tahun Pengadaan</strong> : <?php echo $tahun_pengadaan; ?></p>
<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="10%" rowspan="3">Bulan</th>
        <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
        <th class="text-center" colspan="6">Rekapitulasi Cadangan pangan Masyarakat (Kg)</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="row hidden-print" colspan="1">Koordinat Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text-center" colspan="3">Stok Akhir</th>
    </tr>
    <tr class="active">
        <!--<th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
        <!--<th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
        <th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
        <th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
        <th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>-->
    </tr>
    </thead>
    <?php
    $start = 0;
    foreach ($rdkk_data as $rdkk)
    {
        ?>
        <tr>
            <td><?php echo ++$start; ?></td>
            <td><?php echo $rdkk['bulan']; ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['awal_pengadaan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="row hidden-print"><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rdkk['lokasi'] ?></a></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyusutan'],2,',','.'); ?></td>
            <td class="text-center" colspan="2"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
            <!--<td class="text-center"><?php echo $rdkk['organik_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_1'] + $rdkk['organik_2'] + $rdkk['organik_3']; ?></td>-->
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo number_format($total_stok,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($get_stok_awal,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penyaluran,2,',','.'); ?></td>
        <td class="row hidden-print"><?php echo $total_penyusutn; ?></td>
        <td class="text-center"><?php echo number_format ($total_penyusutan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($get_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan,2,',','.'); ?></td>
    </tr>
    </tfoot>
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                Mengetahui,<br>
                Kepala Dinas Ketahanan Pangan<br>Kabupaten Pandeglang<br><br><br><br>
                __________________________
            </p>
        </td>
        <td>
            <p class="text-center">
                Pandeglang, <?php echo dateformatindo(date('d M Y'),2);?><br>
                Operator,<br><br><br><br><br>__________________________
            </p>
        </td>
    </tr>
</table>
<div class="row hidden-print">
<p class="text-center hidden-print">
    <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url('profil/cpp_ldpm/excel/'.$id_gapoktan)?>">Unduh</a> | <a href="<?php echo site_url()?>">Home</a>
</p>
</div>
