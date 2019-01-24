<div class="box">
<br>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
               <h3>Ds</h3>
                <p>Rekap Desa/kelurahan</p>
             </div>
             <div class="icon">
                <i class="ion ion-clipboard"></i>
             </div>
                <a href="<?php echo site_url('cms/cpp/cpp_desa')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo site_url('cms/cpp/cpp_kec')?>" class="small-box-footer">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo site_url('cpp/cpp_desa_kab')?>" class="small-box-footer" target="_blank">Rekap Detail <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
<div class="box-header with-border">
<table class="table table-bordered table-striped" id="mytable">
    <thead>
    <tr>
        <th width="50px">No</th>
        <th>Kecamatan</th>
        <th width="200px">Action</th>
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
                <td><a href="<?php echo site_url('cpp/cpp_kec/view/'.$row['id_kec']); ?>" target="_blank" title="<?php echo $row['id_kec'] ?>"><?php echo $row['nama_kec'] ?></a></td>
                <td>
                    <a href="<?php echo site_url('cpp/cpp_kec/view/'.$row['id_kec']); ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Detail</a>
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
</div>
</div>
