<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php echo anchor(site_url('auth/data_cppdesa/cetak/'.$id_kabupaten), '<i class="fa fa-print"></i> Cetak', 'class="btn btn-danger" title="Tambah"'); ?>
            <?php echo anchor(site_url('auth/data_cppdesa/excel/'.$id_kabupaten), '<i class="fa fa-download"></i> Excel', 'class="btn btn-primary" title="Unduh Excel"'); ?>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
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
                <th class="text-center" colspan="5">Rekapitulasi Cadangan pangan Tingkat Kabupaten/kota (Kg)</th>
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
                    <td class="text-center"><?php echo $rdkk['penyusutan']; ?></td>
                    <td class="text-center"><?php echo $rdkk['akhir']; ?></td>
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
                <td class="text-center"><?php echo $total_penyusutan; ?></td>
                <td class="text-center"><?php echo $total_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan; ?></td>
            </tr>
            </tfoot>
        </table>
        <div class="row" style="margin-top: 30px">
            <div class="col-md-6 text-center">
                Menyetujui,<br>
                <br><br><br><br><br>
                <strong></strong>
            </div>
            <div class="col-md-6 text-center">
                <?php echo $kabupaten; ?>, <?php echo dateformatindo(date('d M Y'),2);?><br>
                Operator ,<br><br><br><br><br><strong><?php echo $penyuluh;?></strong>
            </div>
        </div>
    </div>
</div>