<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js') ?>"></script>
<script>
    $(function () {
        <?php
        //$incoming = json_encode($incoming);
        $labels = array();
        $values = array();
        $i = 0;
        foreach ($incoming as $row){ //loop through data
            $labels[] = date('d/m/Y',strtotime($row['label'])); //pull dates and format
            $values[] = $row['value']; //pull prices
        }
        $labels = array_reverse($labels); //reverse the data for ASC
        $values = array_reverse($values); //reverse the data for ASC
        $labels = implode('","', $labels); //comma sep
        $values = implode(", ", $values); //comma sep
        ?>
        var salesChartData = {
            labels: [<?php echo '"'.$labels.'"'; ?>],
            datasets: [
                {
                    label: "Total",
                    fill: true,
                    lineTension: 0.1,
                    backgroundColor: "rgba(60,141,188,0.5)",
                    borderColor: "rgba(60,141,188,0.8)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'round',
                    pointBorderColor: "rgba(60,141,188,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(60,141,188,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 10,
                    data: [<?php echo $values; ?>]
                }
            ]
        };

        var LineChart = new Chart(document.getElementById('incomingChart'), {
            type: 'line',
            data: salesChartData,
            options: {
                responsive: true,
                legend: {
                    display: false
                }
            }
        });

    });
</script>
<script>
    $(function () {
        <?php
        $current_year = date('Y');
        $date_range = range($current_year-2, $current_year+2);
        $urea = array();
        $sp = array();
        $za = array();
        $npk = array();
        $organik = array();
        foreach ($date_range as $year) {
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
            labels: <?php echo json_encode($date_range);?>,
            datasets: [
                {
                    label: "",
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
                    label: "",
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
                    label: "",
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
                    label: "",
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
                    label: "",
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

        var LineChart = new Chart(document.getElementById('rdkkChart'), {
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