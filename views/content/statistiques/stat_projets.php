<?php
/*
 * dev 113
 */
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/utils.js"></script>
<div  style="height: 300px; width: 30%;">
    <canvas  id="canvas_projets"></canvas>
</div>
<div  style="height: 300px; width: 30%;">
    <canvas  id="canvas_projets_finis"></canvas>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.getJSON('<?php echo site_url('Projet_Controller/getStatisticsData'); ?>', function (result) {
            var config = {
                type: 'bar',
                data: {
                    labels: result.data_label,
                    datasets: [{
                            label: "Pourcentage d'accomplissement du projet",
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: result.data_points
                        }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Statistique des projets'
                    },
                    scales: {
                        yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100
                                }
                            }]
                    }
                }
            };
            var ctx = document.getElementById("canvas_projets").getContext("2d");
            window.myLine = new Chart(ctx, config);
        });
    });


</script>
