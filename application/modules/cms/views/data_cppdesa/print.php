<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title pull-right">
            <a href="javascript:window.print()" class="btn btn-danger hidden-print" title="Cetak"><i class="fa fa-print"></i> Cetak</a>
            <a href="javascript:history.back()" class="btn btn-primary hidden-print" title="Kembali">Kembali</a>
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
                <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
                    Pemerintah Provinsi Banten</h4>
            </div>
        </div>
        <h3 class="text-center">REKAPITULASI CADANGAN PANGAN TINGKAT DESA</h3>
        <!--<p><strong>Nama Kabupaten</strong> : <?php echo $nama_kab; ?><br>
        <strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>
        <strong>Kelurahan / Desa</strong> : <?php echo $desa; ?><br>
        <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>-->
        <strong>Kabupaten / Kota</strong> : <?php echo $kabupaten; ?><br>
        <!--<strong>Sub Sektor</strong> : <?php echo $subsektor; ?><br>-->
        <strong>Tahun Pengadaan</strong> : <?php echo $tahun_pengadaan; ?></p>
        <table class="table table-bordered vertical-align">
            <thead>
            <tr class="active">
                <th class="text-center" width="3%" rowspan="3">No</th>
                <th class="text-center" width="10%" rowspan="3">Bulan</th>
                <th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>
                <th class="text-center" colspan="4">Rekapitulasi Cadangan pangan Masyarakat (Kg)</th>
            </tr>
            <tr class="active">
                <th class="text-center" colspan="1">Stok Awal</th>
                <th class="text-center" colspan="1">Penambahan</th>
                <th class="text-center" colspan="1">Penyaluran</th>
                <th class="text-center" colspan="1">Stok Akhir</th>
            </tr>
            <tr class="active">
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
                    <td class="text-center"><?php echo $rdkk['awal_pengadaan']; ?></td>
                    <td class="text-center"><?php echo $rdkk['stok_awal']; ?></td>
                    <td class="text-center"><?php echo $rdkk['penambahan']; ?></td>
                    <td class="text-center"><?php echo $rdkk['penyaluran']; ?></td>
                    <td class="text-center"><?php echo $rdkk['stok_awal'] + $rdkk['penambahan'] - $rdkk['penyaluran']; ?></td>
                </tr>
                <?php
            }
            ?>
            <tfoot>
            <tr class="active">
                <td colspan="2" class="text-center">Total</td>
                <td class="text-center"><?php echo $total_stok ?></td>
                <td class="text-center"><?php echo $total_stok_awal; ?></td>
                <td class="text-center"><?php echo $total_penambahan; ?></td>
                <td class="text-center"><?php echo $total_penyaluran; ?></td>
                <td class="text-center"><?php echo $total_stok_awal + $total_penambahan - $total_penyaluran; ?></td>
            </tr>
            </tfoot>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <p class="text-center">
                        Menyetujui,<br>
                        <br><br><br><br><br>
                        <strong></strong>
                    </p>
                </td>
                <td>
                    <p class="text-center">
                        <?php echo $kabupaten; ?>, <?php echo dateformatindo(date('d M Y'),2);?><br>
                        Operator,<br><br><br><br><br><strong><?php echo $penyuluh;?></strong>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>