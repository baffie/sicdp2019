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
                <a href="<?php echo site_url('cms/profil/ldpm')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo site_url('cms/profil/desa_ldpm')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo site_url('cms/profil/kec_ldpm')?>" class="small-box-footer">Rekap Detail<i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo site_url('cms/profil/kota_ldpm/view/3601')?>" class="small-box-footer" target="_blank">Rekap Kelompok <i class="fa fa-arrow-circle-right"></i></a>
                <a href="<?php echo site_url('cms/cpm/kabupaten_ldpm')?>" class="small-box-footer" target="_blank">Rekap Wilayah <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div> 
<!--<div class="box-header with-border">
<table class="table table-no-bordered" id="mytable">
    <thead>
    <tr>
        <th width="800px"></th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/ldpm'); ?>" class="btn btn-sm btn-primary" ><i class="fa fa-share"></i> Rekap Kelompok</a>
        </th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/desa_ldpm'); ?>" class="btn btn-sm btn-primary" ><i class="fa fa-share"></i> Rekap Desa</a>
        </th>
        <th width="100px">
            <a href="<?php echo site_url('cms/profil/kota_ldpm/view/3601'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-share"></i> Rekap Kabupaten</a>
        </th>
    </tr>
    </thead>-->
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th >Nama Kelurahan/desa</th>
        <th width="200px">Action</th>
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
                <td align = "left"><a href="<?php echo site_url('cms/profil/desa_ldpm/view/' . $row['id_desa']); ?>"
                       title="<?php echo $row['nama_kel'] ?>" target="_blank"><?php echo $row['nama_kel'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('cms/profil/desa_ldpm/view/' . $row['id_desa']); ?>"
                       class="btn btn-sm btn-primary" title="Detail <?php echo $row['nama_kel'] ?>" target="_blank"><i class="fa fa-share"></i> Detail</a>
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
*Data tidak akan tampil jika belum di validasi <br>
*untuk <strong>Validasi</strong> pilih menu <strong>Master</strong> -> pilih <strong>CPM LPM</strong> -> Pilih Data yang akan di edit -> <strong>Edit</strong> -> pilih opsi validasi -> <strong>Update</strong>
</div>
</div>