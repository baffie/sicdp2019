<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
        <h4 class="pull-left ml15">Badan Ketahanan Pangan dan Penyuluhan<br>
            Provinsi Banten</h4>
    </div>
</div>
<h3 class="text-center">RENCANA DEFINITIF KEBUTUHAN KELOMPOK (RDKK)<br> PUPUK BERSUBSIDI</h3>
<p><strong>Kelompok Tani</strong> : <?php echo $nama_poktan; ?><br>
    <strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>
    <strong>Kelurahan / Desa</strong> : <?php echo $desa; ?><br>
    <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>
    <strong>Kabupaten / Kota</strong> : <?php echo $kabupaten; ?><br>
    <strong>Sub Sektor</strong> : <?php echo $subsektor; ?><br>
    <strong>Komoditas</strong> : <?php echo $komoditas; ?></p>
<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="10%" rowspan="3">Nama Petani</th>
        <th class="text-center" width="5%" rowspan="3">Luas Tanam (Ha)</th>
        <th class="text-center" colspan="20">Kebutuhan Pupuk Bersubsidi (Kg)</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="4">UREA</th>
        <th class="text-center" colspan="4">SP-36</th>
        <th class="text-center" colspan="4">ZA</th>
        <th class="text-center" colspan="4">NPK</th>
        <th class="text-center" colspan="4">ORGANIK</th>
    </tr>
    <tr class="active">
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
        <th width="3%" class="text-center">Jml</th>
        <th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
        <th width="3%" class="text-center">MT <br>I</th>
        <th width="3%" class="text-center">MT <br>II</th>
        <th width="3%" class="text-center">MT <br>III</th>
        <th width="3%" class="text-center">Jml</th>
    </tr>
    </thead>
    <?php
    $start = 0;
    foreach ($rdkk_data as $rdkk)
    {
        ?>
        <tr>
            <td><?php echo ++$start; ?></td>
            <td><?php echo $rdkk['nama_petani']; ?></td>
            <td class="text-center"><?php echo $rdkk['luas_tanam']; ?></td>
            <td class="text-center"><?php echo $rdkk['urea_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['urea_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['urea_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['urea_1'] + $rdkk['urea_2'] + $rdkk['urea_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['sp_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['sp_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['sp_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['sp_1'] + $rdkk['sp_2'] + $rdkk['sp_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['za_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['za_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['za_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['za_1'] + $rdkk['za_2'] + $rdkk['za_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['npk_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['npk_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['npk_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['npk_1'] + $rdkk['npk_2'] + $rdkk['npk_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_1']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_2']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_3']; ?></td>
            <td class="text-center"><?php echo $rdkk['organik_1'] + $rdkk['organik_2'] + $rdkk['organik_3']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center"><?php echo $total_luas ?></td>
        <td class="text-center"><?php echo $total_urea_1; ?></td>
        <td class="text-center"><?php echo $total_urea_2; ?></td>
        <td class="text-center"><?php echo $total_urea_3; ?></td>
        <td class="text-center"><?php echo $total_urea_1 + $total_urea_2 + $total_urea_3; ?></td>
        <td class="text-center"><?php echo $total_sp_1; ?></td>
        <td class="text-center"><?php echo $total_sp_2; ?></td>
        <td class="text-center"><?php echo $total_sp_3; ?></td>
        <td class="text-center"><?php echo $total_sp_1 + $total_sp_2 + $total_sp_3; ?></td>
        <td class="text-center"><?php echo $total_za_1; ?></td>
        <td class="text-center"><?php echo $total_za_2; ?></td>
        <td class="text-center"><?php echo $total_za_3; ?></td>
        <td class="text-center"><?php echo $total_za_1 + $total_za_2 + $total_za_3; ?></td>
        <td class="text-center"><?php echo $total_npk_1; ?></td>
        <td class="text-center"><?php echo $total_npk_2; ?></td>
        <td class="text-center"><?php echo $total_npk_3; ?></td>
        <td class="text-center"><?php echo $total_npk_1 + $total_npk_2 + $total_npk_3; ?></td>
        <td class="text-center"><?php echo $total_organik_1; ?></td>
        <td class="text-center"><?php echo $total_organik_2; ?></td>
        <td class="text-center"><?php echo $total_organik_3; ?></td>
        <td class="text-center"><?php echo $total_organik_1 + $total_organik_2 + $total_organik_3; ?></td>
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
    <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url('rdkk/poktan/excel/'.$id_poktan)?>">Unduh</a> | <a href="<?php echo site_url()?>">Home</a>
</p>
