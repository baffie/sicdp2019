<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $total_user ?></h3>

                        <p>Data Operator</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="<?php echo site_url('cms/users')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $total_lpm ?></h3>

                        <p>Data CPM LPM</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/lpm')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $total_ldpm ?></h3>

                        <p>Data CPM LDPM</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/ldpm')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $total_data_cppkab ?></h3>

                        <p>Data CPP Kab/kota</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/data_cppkab')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $total_cbp ?></h3>

                        <p>Data CBP</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/data_cbp')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $total_bulog ?></h3>

                        <p>Data BULOG</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/bulog')?>" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $total_data_cpp_ldpm ?></h3>

                        <p>DATA CPP LDPM</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="<?php echo site_url('cms/data_cpp_ldpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $total_cpp_ldpm ?></h3>

                        <p>CPP LDPM</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="<?php echo site_url('cms/cpp_ldpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $total_poktan ?></h3>

                        <p>CPM LPM</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo site_url('cms/cpm_lpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $total_gapoktan ?></h3>

                        <p>CPM LDPM</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="<?php echo site_url('cms/cpm_ldpm')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
                   <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $total_cpp_kab ?></h3>

                        <p>CPP Kab/kota</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="<?php echo site_url('cms/cpp_kab')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Statistik Operator</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu Input</th>
                                    <th>Nama Operator</th>
                                    <th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $start = 0;
                                foreach ($data_penyuluh as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row['created'])); ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td class="text-center"><?php echo $row['total']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <p class="text-center">
                            <strong>Entry Data per hari</strong>
                        </p>
                        <div class="chart">
                            <canvas id="incomingChart" style="height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Data Cadangan Pangan Provinsi Banten</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="table-responsive">
                            <!--<table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Pupuk/Tahun</th>
                                    <th>Urea</th>
                                    <th>SP-36</th>
                                    <th>ZA</th>
                                    <th>NPK</th>
                                    <th>Organik</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $urea =0;
                                $sp =0;
                                $za =0;
                                $npk =0;
                                $organik =0;
                                foreach ($stat as $row) {
                                    $urea += $row['total_urea'];
                                    $sp += $row['total_sp'];
                                    $za += $row['total_za'];
                                    $npk += $row['total_npk'];
                                    $organik += $row['total_organik'];
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row['tahun']?></td>
                                        <td class="text-center"><?php echo $row['total_urea']?></td>
                                        <td class="text-center"><?php echo $row['total_sp']?></td>
                                        <td class="text-center"><?php echo $row['total_za']?></td>
                                        <td class="text-center"><?php echo $row['total_npk']?></td>
                                        <td class="text-center"><?php echo $row['total_organik']?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">Total</th>
                                    <th class="text-center"><?php echo $urea ?></th>
                                    <th class="text-center"><?php echo $sp ?></th>
                                    <th class="text-center"><?php echo $za ?></th>
                                    <th class="text-center"><?php echo $npk ?></th>
                                    <th class="text-center"><?php echo $organik ?></th>
                                </tr>
                                </tfoot>
                            </table>-->
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="chart">
                            <canvas id="rdkkChart" style="height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>