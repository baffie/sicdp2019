<p class="pull-right"><strong>Tanggal</strong> : <?php echo date('d M Y');?></p>
<div class="row mb30">
    <div class="col-md-12">
        <img class="pull-left" src="<?php echo base_url('assets/img/logo-pandeglang.png'); ?>" width="80" alt="Logo pandeglang"><br>
        <h4 class="pull-left ml15">Dinas Ketahanan Pangan<br>
            Pemerintah Kabupaten Pandeglang</h4>
    </div>
</div>
<h3 class="text-center">DATA CPP LDPM KELOMPOK TANI</h3></br>
<div class="form-group"> 
<img itemprop="image" class="img-responsive"  align="right" src="<?php echo base_url('uploads/'.$foto); ?>" alt="" style="height:200px" >
<table border="0">
    <tr>
        <td class="text-left" width="30%"><strong><h4>Nama Kelompok Tani</h4></strong></td><td width="5%">:</td><td></td><td></td>
        <td class="text-left" width="65%"><strong><h4><?php echo $nama_gapoktan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="100px"><strong><h4>Ketua Kelompok Tani</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $ketua_gapoktan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="100px"><strong><h4>Alamat</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $alamat; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="100px"><strong><h4>Kabupaten</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $kabupaten; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
     <tr>
        <td class="text-left" width="100px"><strong><h4>Kecamatan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $kecamatan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Kelurahan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $desa; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Tahun Berdiri</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $tahun_berdiri; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Jumlah Anggota</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $jumlah_anggota; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Luas Lahan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $luas_lahan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Lokasi</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $lokasi; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Awal Pengadaan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo number_format ($awal_pengadaan,2,',','.'); ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Tahun Pengadaan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $tahun_pengadaan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <!--<tr>
        <td class="text-left" width="200px"><strong><h4>Foto</h4></strong></td><td>:</td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $foto; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>-->
    <tr>
        <td class="text-left" width="100px"><strong><h4>Keterangan</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo $keterangan; ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4>Stok Akhir</h4></strong></td><td>:</td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4><?php echo number_format ($total_stok_awal + $total_penambahan - $total_penyaluran,2,',','.'); ?></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
    <tr>
        <td class="text-left" width="200px"><strong><h4></h4></strong></td><td></td><td></td>
        <td class="text-left" width="200px"><strong><h4></h4></strong></td>
    </tr>
    <tr><td></br></td></tr>
</table>
<p class="text-center hidden-print">
    <a href="javascript:window.print()">Cetak</a> | | <a href="<?php echo site_url()?>">Home</a>
</p>
