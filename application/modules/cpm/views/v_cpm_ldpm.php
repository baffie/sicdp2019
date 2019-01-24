<ol class="breadcrumb mb30">
    <li><a href="<?php echo site_url()?>">Home</a></li>
    <li>Data</li>
    <li class="active">DATA CPM LDPM</li>
</ol>
<h3 class="mb15 text-center">DATA CADANGAN PANGAN MASYARAKAT (LDPM) PROVINSI BANTEN</h3>
<?php echo form_open('cpm/cpm_ldpm/set'); ?>
<div class="row mb15">
    <div class="col-md-2">
        <div class="form-group">
            <select name="tahun_pengadaan" id="tahun_pengadaan" class="form-control select2">
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
        <!--<div class="form-group">
            <?php echo form_dropdown('id_subsektor', $load_subsektor, '', 'id="id_subsektor" class="form-control select2"'); ?>
        </div>-->
         <div class="form-group">
            <?php echo form_dropdown('id_kabupaten', $options_cities, '', 'id="id_kabupaten" class="form-control select2"'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="form-group">
            <?php echo form_dropdown('id_kabupaten', $options_cities, '', 'id="id_kabupaten" class="form-control select2"'); ?>
        </div>-->
        <div class="form-group">
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <!--<div class="form-group">
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>-->
         <div class="form-group">
            <select name="id_desa" id="id_desa" class="form-control select2">
                <option value="0">Kelurahan / Desa</option>
            </select>
        </div>
    </div>
    <!--<div class="col-md-2">
        <div class="form-group">
            <select name="id_desa" id="id_desa" class="form-control select2">
                <option value="0">Kelurahan / Desa</option>
            </select>
        </div>
    </div>-->
    <div class="col-md-1 col-xs-12">
        <button class="btn btn-block btn-success" type="button" onclick="this.form.submit();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button>
    </div>
</div>
<?php echo form_close(); ?>
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Gapoktan</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Stok Awal</th>
        <th>penambahan</th>
        <th>Penyaluran</th>
        <th>Penyusutan</th>
        <th>Stok Akhir</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($data_poktan) {
        $start = 0;
        foreach ($data_poktan as $row)
        {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><a href="<?php echo site_url('cpm/cpm_ldpm/'.$row['slug']); ?>" title="<?php echo $row['nama_gapoktan'] ?>"><?php echo $row['nama_gapoktan'] ?></a></td>
                <td><?php echo $row['bulan'] ?></td>
                <td><?php echo $row['tahun'] ?></td>
                <td><?php echo $row['stok_awal'] ?></td>
                <td><?php echo $row['penambahan'] ?></td>
                <td><?php echo $row['penyaluran'] ?></td>
                <td><?php echo $row['penyusutan'] ?></td>
                <td><?php echo $row['akhir']?></td>
                <td>
                    <a href="<?php echo site_url('cpm/cpm_ldpm/'.$row['slug']); ?>" class="btn btn-sm btn-success"><i class="fa fa-share"></i> Detail</a>
                </td>
            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td colspan="6" class="text-center">Data tidak ditemukan!</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>