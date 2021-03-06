<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php echo anchor(site_url('auth/gapoktan/cetak/'.$id_gapoktan), '<i class="fa fa-print"></i> Cetak', 'class="btn btn-danger hidden-print" title="Tambah"'); ?>
            <?php echo anchor(site_url('auth/gapoktan/excel/'.$id_gapoktan), '<i class="fa fa-download"></i> Excel', 'class="btn btn-primary hidden-print" title="Unduh Excel"'); ?>
        </h3>
        <div class="box-tools pull-right hidden-print">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <h3 class="text-center">REKAPITULASI RDKK PUPUK BERSUBSIDI<br> TINGKAT GAPOKTAN / DESA</h3>
        <p>
            <strong>Gapoktan</strong> : <?php echo $nama_gapoktan; ?><br>
            <strong>Kelurahan / Desa</strong> : <?php echo $desa; ?><br>
            <strong>Kecamatan</strong> : <?php echo $kecamatan; ?><br>
            <strong>Kabupaten / Kota</strong> : <?php echo $kabupaten; ?><br>
            <strong>Sub Sektor</strong> :
            <?php
            $sub = '';
            if ($subsektor)
            {
                foreach ($subsektor as $row) {
                    $sub .= $row['name'] . ' / ';
                }
                echo trim($sub, ' / ');
            }
            ?>
        </p>
        <table class="table table-bordered vertical-align">
            <thead>
            <tr class="active">
                <th class="text-center" width="3%" rowspan="3">No</th>
                <th class="text-center" width="10%" rowspan="3">Kelompok Tani</th>
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
            if($rdkk_data) {
                $start = 0;
                foreach ($rdkk_data as $rdkk) {
                    ?>
                    <tr>
                        <td><?php echo ++$start; ?></td>
                        <td><?php echo $rdkk['nama_poktan']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_luas']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_urea_1']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_urea_2']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_urea_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_urea_1'] + $rdkk['total_urea_2'] + $rdkk['total_urea_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_sp_1']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_sp_2']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_sp_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_sp_1'] + $rdkk['total_sp_2'] + $rdkk['total_sp_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_za_1']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_za_2']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_za_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_za_1'] + $rdkk['total_za_2'] + $rdkk['total_za_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_npk_1']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_npk_2']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_npk_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_npk_1'] + $rdkk['total_npk_2'] + $rdkk['total_npk_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_organik_1']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_organik_2']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_organik_3']; ?></td>
                        <td class="text-center"><?php echo $rdkk['total_organik_1'] + $rdkk['total_organik_2'] + $rdkk['total_organik_3']; ?></td>
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
            <?php }else{ ?>
                <tr><td colspan="23" class="text-center">Data Belum Tersedia</td></tr>
            <?php } ?>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <p class="text-center">
                        Mengetahui,<br>
                        Kepala Desa/Lurah <?php echo $desa; ?><br><br><br><br><br>
                        _____________________________
                    </p>
                </td>
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
                        Ketua Gapoktan,<br><br><br><br><br><strong><?php echo $nama_ketua;?></strong>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>