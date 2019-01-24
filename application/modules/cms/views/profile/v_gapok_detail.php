<p class="text-left hidden-print">
    <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url()?>">Home</a> 
 </p>
<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-pandeglang.png'); ?>" width="80" alt="Logo Pandeglang"><br>
        <h4 class="pull-left ml15">Badan Ketahanan Pangan<br>
            Pemerintah Kabupaten Pandeglang</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI DATA CPM LDPM GABUNGAN KELOMPOK TANI</h3>
<p><strong>Nama Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>
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
        <th class="text-center" colspan="5">Rekapitulasi Cadangan pangan Masyarakat (Kg)</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text-center" colspan="4">Stok Akhir</th>
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
            <td class="text-center"><?php echo number_format($rdkk['awal_pengadaan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyusutan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
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
        <td class="text-center"><?php echo number_format ($total_stok,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($get_stok_awal,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format ($total_penyaluran,2,',','.'); ?></td>
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
<p class="text-center hidden-print">
    <a href="javascript:window.print()">Cetak</a>  | <a href="<?php echo site_url()?>">Home</a>
</p>
<br>
<p class="text-left hidden-print">
    *Rekapitulasi Data tidak tampil jika belum di validasi<br>
    *untuk <strong>Validasi</strong> pilih menu <strong>Data</strong> -> pilih <strong>DATA CPM LDPM</strong> -> Pilih Data yang akan diedit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</p>

