<ol class="breadcrumb">
    <li><a href="<?php echo site_url()?>">Home</a></li>
    <li class="active">Perkembangan</li>
</ol>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo form_open('rdkk/perkembangan/set'); ?>
                <div class="form-group">
                    <label>Rentang Tahun</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="form-control" name="start" value="<?php if(isset($start)) echo $start; ?>" />
                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        <input type="text" class="form-control" name="end" value="<?php echo $end ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Sub Sektor</label>
                    <?php echo form_dropdown('id_subsektor', $load_subsektor, $subsektor, 'id="id_subsektor" class="form-control select2"'); ?>
                </div>
                <div class="form-group">
                    <label>Kabupaten / Kota</label>
                    <?php echo form_dropdown('id_kabupaten', $options_cities, $kabupaten, 'id="id_kabupaten" class="form-control select2"'); ?>
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                        <option value="0">-- Kecamatan --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kelurahan / Desa</label>
                    <select name="id_desa" id="id_desa" class="form-control select2">
                        <option value="0">-- Desa --</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-success" type="button" onclick="this.form.submit();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tampilkan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <?php
        $years = array("2016", "2017", "2018", "2019", "2020");
        $urea = array();
        $sp = array();
        $za = array();
        $npk = array();
        $organik = array();
        foreach ($years as $year) {
            $urea[$year] = 0;
            $sp[$year] = 0;
            $za[$year] = 0;
            $npk[$year] = 0;
            $organik[$year] = 0;
        }

        foreach ($stat as $row) {
            $urea[$row['tahun']] = (int)$row['total_urea'];
            $sp[$row['tahun']] = (int)$row['total_sp'];
            $za[$row['tahun']] = (int)$row['total_za'];
            $npk[$row['tahun']] = (int)$row['total_npk'];
            $organik[$row['tahun']] = (int)$row['total_organik'];
        }

        ?>
        <div class="chart">
            <canvas id="chart" style="height: 250px;"></canvas>
        </div>
    </div>
</div>