<!-- Default box -->
<div class="box">
    <div class="box-body">
        <div class="row mb30">
            <div class="col-md-12">
                <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
                <h4 class="pull-left ml15">Badan Ketahanan Pangan dan Penyuluhan<br>
                    Pemerintah Provinsi Banten</h4>
            </div>
        </div>
        <hr>
        <h3 class="text-center">RENCANA DEFINITIF KEBUTUHAN KELOMPOK (RDKK)<br> PUPUK BERSUBSIDI</h3>
        <p><strong>Kelompok Tani</strong> : <?php echo $nama_poktan; ?><br>
            <strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>
            <strong>Desa</strong> : <?php echo $desa; ?><br>
            <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>
            <strong>Sub Sektor</strong> : <?php echo $subsektor; ?><br>
            <strong>Komoditas</strong> : <?php echo $komoditas; ?></p>
        <table class="table table-bordered vertical-align">
            <thead>
            <tr>
                <th class="text-center" width="3%" rowspan="3">No</th>
                <th class="text-center" width="10%" rowspan="3">Nama Petani</th>
                <th class="text-center" width="5%" rowspan="3">Luas Tanam (Ha)</th>
                <th class="text-center" colspan="20">Kebutuhan Pupuk Bersubsidi (Kg)</th>
            </tr>
            <tr>
                <th class="text-center" colspan="4">UREA</th>
                <th class="text-center" colspan="4">SP-36</th>
                <th class="text-center" colspan="4">ZA</th>
                <th class="text-center" colspan="4">NPK</th>
                <th class="text-center" colspan="4">ORGANIK</th>
            </tr>
            <tr>
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
            <tr>
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
        <br>
        <div class="row">
            <div class="col-md-6 text-center">
                Mengetahui,<br>
                Penyuluh Pendamping<br><br><br><br><br>

            </div>
            <div class="col-md-6 text-center">
                <?php echo $desa; ?>, ___________________<?php echo date('Y');?><br>
                Ketua Kelompok Tani,<br><br><br><br><br><strong><?php echo $nama_ketua;?></strong>
            </div>
        </div>
        <br>
        <p class="text-center">
            <a href="<?php echo site_url('rekap/index')?>">Kembali</a> | <a href="<?php echo site_url()?>">Print</a> | <a href="<?php echo site_url()?>">Unduh</a>
        </p>
    </div>
</div>