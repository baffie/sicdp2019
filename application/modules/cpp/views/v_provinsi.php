<div class="row hidden-print">
    <div class="col-md-5">
        <?php echo form_open('cpp/bulog/set', array('class' => 'form-inline')); ?>
            <!--<div class="form-group">
                <label>Dari Tahun </label>
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
            </div>-->
               <div class="form-group">
                <label>Tahun </label>
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
<h3 class="text-center">REKAPITULASI DATA CPP PROVINSI BANTEN (BULOG) PER <?php echo date('d M Y');?></h3>
<p>
</br>
    <!--<strong>Provinsi</strong> : Banten<br>
    <!--<strong>Sub Sektor</strong> :
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
        <th class="text-center" width="10%" rowspan="3">Tanggal</th>
        <th class="text-center" colspan="7">(Kg) Beras</th>
        <th class="text-center" width="20%" rowspan="4">Keterangan</th>
    </tr>
    <tr class="active">
        <th class="text-center" colspan="1">Stok Awal</th>
        <th class="text-center" colspan="1">Pengadaan</th>
        <th class="text-center" colspan="1">Penyaluran</th>
        <th class="text-center" colspan="1">Penyusutan</th>
        <th class="text-center" colspan="1">Koordinat Penyaluran</th>
        <th class="text-center" colspan="1">Stok Akhir</th>
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
            <td><?php echo $rdkk['tanggal']; ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['stok_awal'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penambahan'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyaluran'],2,',','.'); ?></td>
            <td class="text-center"><?php echo number_format ($rdkk['penyusutan'],2,',','.'); ?></td>
            <td class="text-center" ><?php echo $rdkk['lokasi'] ?></a></td>
            <!--<td class="text-center"><?php echo $rdkk['lokasi']; ?></td>-->
            <td class="text-center" colspan="2"><?php echo number_format ($rdkk['akhir'],2,',','.'); ?></td>
            <td class="text-center" colspan="1" width="30%"><?php echo $rdkk['keterangan']; ?></td>
        </tr>
        <?php
    }
    ?>
    <tfoot>
    <tr class="active" style="font-weight: 600">
        <td colspan="2" class="text-center">Total</td>
        <td class="text-center">--</td>
        <td class="text-center"><?php echo number_format($total_penambahan,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($total_penyaluran,2,',','.'); ?></td>
        <td class="text-center"><?php echo number_format($total_penyusutan,2,',','.'); ?></td>
        <td class="text center row hidden-print"><?php $total_penyusutn; ?></td>
        <td class="text-center" colspan="2"><?php echo number_format($get_stok_awal + $total_penambahan - $total_penyaluran - $total_penyusutan,2,',','.'); ?></td>
        <td class="text-center" colspan="3"><?php echo $total_penyusutn; ?></td>
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
<div class="row hidden-print">
<p class="text-center">
    <a href="javascript:window.print()">Cetak</a> | <!--<a href="<?php echo site_url('rdkk/provinsi/excel')?>">Unduh</a>--> | <a href="<?php echo site_url()?>">Home</a>
</p>
</div>
