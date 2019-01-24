<div class="row hidden-print">
    <div class="col-md-5">
        <?php echo form_open('cpp/cbp/set', array('class' => 'form-inline')); ?>
            <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" id="tahun" class="form-control select2">
                    <option value="0">Semua</option>
                    <?php
                    $now = date("Y");
                    for($year=2011; $year <= '2020'; $year++)
                    {
                        ?>
                        <option value="<?php echo $year?>" <?php echo ($year == $now) ? 'selected' : '';?>><?php echo $year?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Tampilkan</button>
        <?php echo form_close();?>
    </div>
</div>
</br>
<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-banten.png'); ?>" width="80" alt="Logo Banten">
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Provinsi Banten</h4>
    </div>
</div>
<h3 class="text-center">REKAPITULASI CADANGAN PANGAN (CBP) DI PROVINSI BANTEN</h3>
<p>
</br>    
    <!--<strong>Provinsi</strong> : Banten<br>
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
</p>-->
<table class="table table-bordered vertical-align">
    <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="7%" rowspan="3">Sumber CBP</th>
        <th class="text-center" width="5%" rowspan="3">Tahun</th>
        <!--<th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>-->
        <th class="text-center" colspan="7">Rekapitulasi CBP Provinsi (Kg)</th>
        <th class="text-center" width="20%" rowspan="4">Keterangan</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text center hidden-print" colspan="1">Koordinat Penyaluran</th>
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
            <td>Provinsi</td>
            <td><?php echo $rdkk['tahun']; ?></td>
            <!--<td class="text-center"><?php echo number_format ($rdkk['stok'],2,',','.'); ?></td>-->
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyusutan'],2,',','.'); ?></td>
            <td class="text center row hidden-print"><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rdkk['lokasi'] ?></a></td>
            <td class="text-center"  colspan="2"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
            <td class="text-center" colspan="3"><?php echo $rdkk['keterangan']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="3" class="text-center">Total CBP Provinsi</td>
        <!--<td class="text-center"><?php echo number_format ($total_stok,2,',','.') ?></td>-->
        <td class="text-center"><?php echo number_format($total_stok_awal,2,',','.'); ?></td>        
        <td class="text-center"><?php echo number_format($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($total_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($total_penyusutan,2,',','.'); ?></td>
        <td class="text center hidden-print" colspan="1"><?php echo $total_penyusutn; ?></td>
        <td class="text-center" colspan="2"><?php echo number_format($total_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan,2,',','.'); ?></td>
        <td class="text-center" colspan="3"><?php echo $total_penyusutn; ?></td>
    </tr>
    </tfoot>
</table>
<table class="table table-bordered vertical-align">
       <thead>
    <tr class="active">
        <th class="text-center" width="3%" rowspan="3">No</th>
        <th class="text-center" width="7%" rowspan="3">Sumber CBP</th>
        <th class="text-center" width="5%" rowspan="3">Tahun</th>
        <!--<th class="text-center" width="5%" rowspan="3">Awal Pengadaan</th>-->
        <th class="text-center" colspan="7">Rekapitulasi CBP Kab/Kota (Kg)</th>
        <th class="text-center" width="20%" rowspan="4">Keterangan</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Penambahan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text center hidden-print" colspan="1">Koordinat Penyaluran</th>
        <th class="text-center" colspan="2">Stok Akhir</th>
    </tr>
    <tr class="active">
    </tr>
    </thead>
    <?php
    $start = 0;
    foreach ($rdkk_data2 as $rd)
    {
        ?>
        <tr>
            <td><?php echo ++$start; ?></td>
            <td><?php echo $rd['nama_kab']; ?></td>
            <td><?php echo $rd['tahun']; ?></td>
            <!--<td class="text-center"><?php echo number_format ($rd['stok'],2,',','.'); ?></td>-->
            <td class="text-center"><?php echo number_format ($rd['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rd['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rd['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rd['penyusutan'],2,',','.'); ?></td>
            <td class="text center row hidden-print"><a href="<?php echo ('https://www.google.co.id/maps/place/'.$rdkk['lokasi']); ?>"  target="_blank" title="<?php echo $row['lokasi'] ?>"><?php echo $rd['lokasi'] ?></a></td>
            <td class="text-center"  colspan="2"><?php echo number_format ($rd['akhir'],2,',','.'); ?></td>
            <td class="text-center" colspan="3"><?php echo $rd['keterangan']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="3" class="text-center">Total Keseluruhan</td>
        <!--<td class="text-center"><?php echo number_format ($total_stok + $tot_stok,2,',','.') ?></td>-->
        <td class="text-center"><?php echo number_format($tot_stok_awal + total_stok_awal,2,',','.'); ?></td>        
        <td class="text-center"><?php echo number_format($tot_penambahan + $total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($tot_penyaluran + $total_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($tot_penyusutan + $total_penyusutan,2,',','.'); ?></td>
        <td class="text center hidden-print" colspan="1"><?php echo $total_penyusutn; ?></td>
        <td class="text-center" colspan="2"><?php echo number_format($total_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan + $tot_stok_awal + $tot_penambahan - $tot_penyaluran - $tot_penyusutan,2,',','.'); ?></td>
        <td class="text-center" colspan="3"><?php echo $total_penyusutn; ?></td>
    </tr>
    </tfoot>
        
        <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="3" class="text-center">Total CBP Kabupaten</td>
        <!--<td class="text-center"><?php echo number_format ($tot_stok,2,',','.') ?></td>-->
        <td class="text-center"><?php echo number_format($tot_stok_awal,2,',','.'); ?></td>        
        <td class="text-center"><?php echo number_format($tot_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($tot_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($tot_penyusutan,2,',','.'); ?></td>
        <td class="text center hidden-print" colspan="1"><?php echo $tot_penyusutn; ?></td>
        <td class="text-center" colspan="2"><?php echo number_format($tot_stok_awal + $tot_penambahan - $tot_penyaluran - $tot_penyusutan,2,',','.'); ?></td>
        <td class="text-center" colspan="3"><?php echo $total_penyusutn; ?></td>
    </tr>
    </tfoot>
    <td class="text-center" colspan="3"></td>
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                <br><br><br>Mengetahui, <br>
                Kepala Dinas Ketahanan Pangan<br>
                Provinsi Banten<br>
                <br><br><br><br>
                _____________________________
            </p>
        </td>
        <td>
            <p class="text-center">
                <br><br>Serang, <?php echo dateformatindo(date('d M Y'),2);?><br>
                <br>Operator,<br>
                <br><br><br><br><br>
                _____________________________
            </p>
        </td>
    </tr>
</table>
<div class="row hidden-print">
<p class="text-center">
    <a href="javascript:window.print()">Cetak</a> | <!--<a href="<?php echo site_url('rdkk/provinsi/excel')?>">Unduh</a>--> | <a href="<?php echo site_url()?>">Home</a>
</p>
</div>