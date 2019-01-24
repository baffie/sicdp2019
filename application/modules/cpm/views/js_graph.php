<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script>
    $(function () {
        <?php
        $start_year = (isset($start) ? $start : date('Y'));
        $end_year = (isset($end) ? $end : date('Y', strtotime('+2 years')));
        $years = range($start_year, $end_year);
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
        var ChartData = {
            labels: <?php echo json_encode($years);?>,
            datasets: [
                {
                    label: "Urea",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(255,192,203,0.5)",
                    borderColor: "rgba(255,192,203,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(255,192,203,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,192,203,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: <?php echo json_encode(array_values($urea));?>
                },
                {
                    label: "SP 36",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(255,255,0,0.5)",
                    borderColor: "rgba(255,255,0,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(255,255,0,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,255,0,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: <?php echo json_encode(array_values($sp));?>
                },
                {
                    label: "ZA",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(255,165,0,0.5)",
                    borderColor: "rgba(255,165,0,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(255,165,0,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,165,0,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: <?php echo json_encode(array_values($za));?>
                },
                {
                    label: "NPK",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(0,100,0,0.6)",
                    borderColor: "rgba(0,128,0,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(0,128,0,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(0,128,0,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: <?php echo json_encode(array_values($npk));?>
                },
                {
                    label: "Organik",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(255,0,0,0.5)",
                    borderColor: "rgba(255,0,0,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(255,0,0,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,0,0,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: <?php echo json_encode(array_values($organik));?>
                }

            ]
        };

        var LineChart = new Chart(document.getElementById('chart'), {
            type: 'line',
            data: ChartData,
            options: {
                responsive: true,
                legend: {
                    display: true
                }
            }
        });
    });
</script>

<script>
    $('.input-daterange').datepicker({
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
    $("#id_kabupaten").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_kecamatan')?>",{'id_kabupaten' : id},
            function(data){
                var option = "<option value='0'>-- Kecamatan --</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kec']+"'>"+data[i]['nama_kec']+"</option>";
                }

                $("#id_kecamatan").html(option);
            },'json');
    });

    $("#id_kecamatan").change(function(){
        var id = $(this).val();

        $.post("<?php echo base_url('ajax/get_json_desa')?>",{'id_kecamatan' : id},
            function(data){
                var option = "<option value='0'>-- Desa --</option>";
                for(var i=0;i<data.length;i++){
                    option += "<option value='"+data[i]['id_kel']+"'>"+data[i]['nama_kel']+"</option>";
                }

                $("#id_desa").html(option);
            },'json');
    });
</script>