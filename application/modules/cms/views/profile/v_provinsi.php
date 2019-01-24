<div class="row hidden-print">
    <div class="col-md-5">
        <?php echo form_open('rdkk/provinsi/set', array('class' => 'form-inline')); ?>
            <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" id="tahun" class="form-control select2">
                    <option value="0">Semua</option>
                    <?php
                    $now = date("Y");
                    for($year=2016; $year <= '2021'; $year++)
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
<h3 class="text-center">REKAPITULASI RDKK PUPUK BERSUBSIDI<br> TINGKAT PROVINSI</h3>
<p>
    <strong>Provinsi</strong> : Banten<br>
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
        <th class="text-center" width="10%" rowspan="3">Kab / Kota</th>
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
            <td><?php echo $rdkk['nama_kab']; ?></td>
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
</table>
<table width="100%" class="mb15">
    <tr>
        <td>
            <p class="text-center">
                Diketahui,<br>
                Kepala Sekretariat Bakorluh/<br>
                Kelembagaan Penyuluhan<br>
                Provinsi Banten<br><br><br><br><br>
                _____________________________
            </p>
        </td>
        <td>
            <p class="text-center">
                Provinsi Banten, <?php echo dateformatindo(date('d M Y'),2);?><br>
                Kepala Dinas Tanaman Pangan/Perkebunan/<br>
                Peternakan/ Perikanan *)<br>Provinsi Banten,<br><br><br><br><br>
                _____________________________
            </p>
        </td>
    </tr>
</table>
<p class="text-center">
    <a href="javascript:window.print()">Cetak</a> | <a href="<?php echo site_url('rdkk/provinsi/excel')?>">Unduh</a> | <a href="<?php echo site_url()?>">Home</a>
</p>
