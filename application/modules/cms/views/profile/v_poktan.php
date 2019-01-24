<!--<?php echo form_open('profil/lpm/set'); ?>
<div class="row mb15">
   <!-- <div class="col-md-2">
        <div class="form-group">
            <!--<select name="tahun_pengadaan" id="tahun_pengadaan" class="form-control select2">
                <option value="0">Tahun</option>
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
    </div>
    <div class="col-md-3">
        <!--<div class="form-group">
            <?php echo form_dropdown('id_subsektor', $load_subsektor, '', 'id="id_subsektor" class="form-control select2"'); ?>
        </div>
         <div class="form-group">
            <?php echo form_dropdown('id_kab', $options_cities, '', 'id="id_kabupaten" class="form-control select2"'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="form-group">
            <?php echo form_dropdown('id_subsektor', $load_subsektor, '', 'id="id_subsektor" class="form-control select2"'); ?>
        </div>
         <div class="form-group">
             <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <!--<div class="form-group">
            <?php echo form_dropdown('id_kabupaten', $options_cities, '', 'id="id_kabupaten" class="form-control select2"'); ?>
        </div>
        <div class="form-group">
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                <option value="0">Kecamatan</option>
            </select>
        </div>
         <div class="form-group">
            <!--<select name="id_desa" id="id_desa" class="form-control select2">
                <option value="0">Kelurahan / Desa</option>
            </select>
        </div>
         <div class="col-md-1 col-xs-12">
        <button class="btn btn-block btn-success" type="button" onclick="this.form.submit();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button>
    </div>
    </div>
    <!--<div class="col-md-2">
        <div class="form-group">
            <select name="id_desa" id="id_desa" class="form-control select2">
                <option value="0">Kelurahan / Desa</option>
            </select>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <button class="btn btn-block btn-success" type="button" onclick="this.form.submit();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button>
    </div>
</div>
<?php echo form_close(); ?>-->           
<div class="box">
<br>    
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
               <h3>Kl</h3>
                <p>Rekap Kelompok</p>
             </div>
             <div class="icon">
                <i class="ion ion-clipboard"></i>
             </div>
                <a href="<?php echo site_url('cms/profil/lpm')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
               <h3>Ds</h3>
                <p>Rekap Desa</p>
             </div>
             <div class="icon">
                <i class="ion ion-clipboard"></i>
             </div>
                <a href="<?php echo site_url('cms/profil/desa_lpm')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
               <h3>Kec</h3>
                <p>Rekap Kecamatan</p>
             </div>
             <div class="icon">
                <i class="ion ion-clipboard"></i>
             </div>
                <a href="<?php echo site_url('cms/profil/kecamatan_lpm')?>" class="small-box-footer">Rekap Detail<i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
               <h3>Kab</h3>
                <p>Rekap Kabupaten</p>
             </div>
             <div class="icon">
                <i class="ion ion-clipboard"></i>
             </div>
                <a href="<?php echo site_url('cms/profil/kota_lpm/view/3601')?>" class="small-box-footer" target="_blank">Rekap Kelompok <i class="fa fa-arrow-circle-right"></i></a>
                <a href="<?php echo site_url('cms/cpm/kabupaten_lpm')?>" class="small-box-footer" target="_blank">Rekap Wilayah <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>                                              
<!--<table class="table table-no-bordered" id="mytable">
    <thead>
    <tr>
        <th width="800px"></th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/desa_lpm'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Rekap Desa</a>
        </th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/kecamatan_lpm'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Rekap Kecamatan</a>
        </th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/kota_lpm/view/3601'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> Rekap Kabupaten</a>
        </th>
    </tr>
    </thead>-->
    <div class="box-header with-border">
<table class="table table-striped table-bordered dt-responsive" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Kelompok Tani</th>
        <th>Alamat</th>
        <th>Anggota</th>
        <th>Luas Lahan</th>
        <th>Action</th>
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
                <td><a href="<?php echo site_url('cms/profil/lpm/data/'.$row['slug']); ?>" title="<?php echo $row['nama_poktan'] ?>" target="_blank"><?php echo $row['nama_poktan'] ?></a></td>
                <td><?php echo $row['alamat'] ?></td>
                <td><?php echo $row['jumlah_anggota'] ?></td>
                <td><?php echo number_format ($row['luas_lahan'],2,',','.'); ?></td>
                <td>
                    <a href="<?php echo site_url('cms/profil/lpm/data/'.$row['slug']); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> Profil</a>    
                    <a href="<?php echo site_url('cms/profil/lpm/view/'.$row['slug']); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> Detail</a>
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
*Data <strong>CPM LPM</strong> tidak akan tampil jika belum di validasi<br>
*untuk <strong>Validasi</strong> pilih menu <strong>Master</strong> -> pilih <strong>CPM LPM</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</div>
</div>