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
                <img class="pull-left" src="<?php echo base_url('assets/img/logo-pandeglang.png'); ?>" width="80" alt="Logo Pandeglang">
                <h4 class="pull-left ml15"><br>Badan Ketahanan Pangan<br>
                    Pemerintah Kabupaten Pandeglang</h4>
            </div>
        </div>
        <h3 class="text-center">REKAPITULASI DATA CPM LDPM KELOMPOK TANI</h3>
        <p><strong>Kelompok Tani</strong> : <?php echo $nama_gapoktan; ?><br>
            <!--<strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>-->
            <strong>Kelurahan/Desa</strong> : <?php echo $desa; ?><br>
            <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>
            <strong>Kabupaten / Kota</strong> : <?php echo $kabupaten; ?><br>
            <!--<strong>Sub Sektor</strong> : <?php echo $subsektor; ?><br>
            <strong>Komoditas</strong> : <?php echo $komoditas; ?></p>-->
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
                    <td class="text-center"><?php echo number_format ($rdkk['awal_pengadaan'],2,',','.'); ?></td>
                    <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
                    <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
                    <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
                    <td class="text-center"><?php echo number_format ($rdkk['stok_awal'] + $rdkk['penambahan'] - $rdkk['penyaluran'],2,',','.'); ?></td>
                </tr>
                <?php
            }
            ?>
            <tfoot>
            <tr class="active">
                <td colspan="2" class="text-center">Total</td>
                <td class="text-center"><?php echo number_format ($total_stok,2,',','.') ?></td>
                <td class="text-center"><?php echo number_format ($total_stok_awal,2,',','.'); ?></td>
                <td class="text-center"><?php echo number_format ($total_penambahan,2,',','.'); ?></td>
                <td class="text-center"><?php echo number_format ($total_penyaluran,2,',','.'); ?></td>
                <td class="text-center"><?php echo number_format ($total_stok_awal + $total_penambahan - $total_penyaluran,2,',','.'); ?></td>
            </tr>
            </tfoot>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <p class="text-center">
                        Menyetujui,<br>
                        Penyuluh Pendamping<br><br><br><br><br>
                        <strong><?php echo $penyuluh;?></strong>
                    </p>
                </td>
                <td>
                    <p class="text-center">
                        <?php echo $desa; ?>, <?php echo dateformatindo(date('d M Y'),2);?><br>
                        Ketua Kelompok Tani,<br><br><br><br><br><strong><?php echo $nama_ketua;?></strong>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>