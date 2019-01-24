<ol class="breadcrumb">
    <li><a href="<?php echo site_url()?>">Home</a></li>
    <li>Data</li>
    <li class="active">RDKK Pupuk Bersubsidi Tingkat Kecamatan</li>
</ol>
<h3 class="mb15 text-center">RENCANA DEFINITIF KEBUTUHAN KELOMPOK (RDKK) <br>PUPUK BERSUBSIDI TINGKAT KECAMATAN</h3>
<?php echo form_open('rdkk/kecamatan/set'); ?>
<div class="row mb15 text-center">
    <div class="col-md-2">
        <div class="form-group">
            <select name="tahun" id="tahun" class="form-control select2">
                <option value="0">Tahun</option>
                <?php
                $now = date("Y");
                for($year=2017; $year <= '2021'; $year++)
                {
                    ?>
                    <option value="<?php echo $year?>" <?php echo ($year == $now) ? 'selected' : '';?>><?php echo $year?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_dropdown('id_subsektor', $load_subsektor, '', 'id="id_subsektor" class="form-control select2"'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo form_dropdown('id_kabupaten', $options_cities, '', 'id="id_kabupaten" class="form-control select2"'); ?>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="id_desa" id="id_desa" class="form-control select2">
                <option value="0">Kelurahan / Desa</option>
            </select>
        </div>
    </div>
    <div class="col-md-1 col-xs-12">
        <button class="btn btn-block btn-success" type="button" onclick="this.form.submit();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button>
    </div>
</div>
<?php echo form_close(); ?>
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th width="40%">Kabupaten/Kota</th>
        <th width="40%">Kecamatan</th>
        <th width="15%"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($data_poktan) {
        $start = 0;
        foreach ($data_poktan as $row) {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $row['nama_kab'] ?></td>
                <td><a href="<?php echo site_url('rdkk/kecamatan/view/' . $row['id_kecamatan']); ?>"
                       title="<?php echo $row['nama_kec'] ?>"><?php echo $row['nama_kec'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('rdkk/kecamatan/view/' . $row['id_kecamatan']); ?>"
                       class="btn btn-sm btn-success"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <?php
        }
    }else {
        ?>
        <tr>
            <td colspan="4" class="text-center">Data tidak ditemukan!</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>