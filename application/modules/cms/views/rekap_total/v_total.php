<div class="box">
<div class="box-header with-border">
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Sumber Cadangan Pangan</th>
        <th>Stok Akhir</th>
        <th>Keterangan</th>
        <th width="200px"></th>
    </tr>
    </thead>
    <tbody>
            <tr>
                <td>1.</td>
                <td><a href="<?php echo site_url('cms/cpm_lpm'); ?>"  title="CPM LPM">CPM LPM</a></td>
                <td><?php echo number_format ($totall_stok_awal + $totall_penambahan - $totall_penyaluran,2,',','.'); ?></td>
                <td>GABAH</td>
                <td>
                    <a href="<?php echo site_url('cms/cpm/kabupaten_lpm'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td><a href="<?php echo site_url('cms/cpm_ldpm'); ?>"  title="CPM LDPM">CPM LDPM</a></td>
                <td><?php echo number_format ($tota_stok_awal + $tota_penambahan - $tota_penyaluran,2,',','.'); ?></td>
                <td>GABAH</td>
                <td>
                    <a href="<?php echo site_url('cms/cpm/kabupaten_ldpm'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td><a href="<?php echo site_url('cms/cpp_desa'); ?>"  title="CPP DESA">CPP DESA</a></td>
                <td><?php echo number_format ($tot_stok_awal + $tot_penambahan - $tot_penyaluran - $tot_penyusutan,2,',','.'); ?></td>
                <td>GABAH/BERAS</td>
                <td>
                    <a href="<?php echo site_url('cpp/cpp_desa_kab'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td><a href="<?php echo site_url('cms/cpp_kab'); ?>"  title="CPP Kabupaten">CPP Kabupaten</a></td>
                <td><?php echo number_format ($to_stok_awal + $to_penambahan - $to_penyaluran - $to_penyusutan,2,',','.'); ?></td>
                <td>BERAS</td>
                <td>
                    <a href="<?php echo site_url('cms/cpp/cpp_kab_detail'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <tr>
                <td>5.</td>
                <td><a href="<?php echo site_url('cms/cbp_kab'); ?>"  title="CBP">CBP</a></td>
                <td><?php echo number_format($get_stok_awal_cbp + $t_penambahan - $t_penyaluran - $t_penyusutan,2,',','.'); ?></td>
                <td>BERAS</td>
                <td>
                    <a href="<?php echo site_url('cpp/cbp'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <tr>
                <td>6.</td>
                <td><a href="<?php echo site_url('cms/cp_lainnya'); ?>"  title="CP Lainnya">CP Lainnya</a></td>
                <td><?php echo number_format($get_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan,2,',','.'); ?></td>
                <td>BERAS</td>
                <td>
                    <a href="<?php echo site_url('cpp/cp_lainnya'); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
        <tr>
        <td colspan="5"> *TOTAL CADANGAN PANGAN KABUPATEN PANDEGLANG <?php echo number_format ($tot_stok_awal + $tot_penambahan - $tot_penyaluran - $tot_penyusutan + $tota_stok_awal + $tota_penambahan - $tota_penyaluran +$totall_stok_awal + $totall_penambahan - $totall_penyaluran,2,',','.'); ?> Kg Gabah & <?php echo number_format($get_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan +$get_stok_awal_cbp + $t_penambahan - $t_penyaluran - $t_penyusutan + $to_stok_awal + $to_penambahan - $to_penyaluran - $to_penyusutan,2,',','.'); ?> Kg Beras</td>
        </tr>
    </tbody>
</table>
</div>
</div>