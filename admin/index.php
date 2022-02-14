<?php
require_once 'admin-only.php';
$activePageLvl = 0;
include 'functions/get-all-trx-stats-data.php';
include 'functions/get-revenue-source-data.php';
include 'functions/get-vehicle-stats-data.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Dashboard</title>

    <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
    <link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
    <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php require_once 'view-template/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once 'view-template/topbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"> <i class="fas fa-chart-line fa-fw"></i> Earnings Overview (Last 30 days)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="ini-chart ">
                                        <canvas id="chartOverallStats"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-search-dollar fa-fw"></i> Revenue Sources</h5>
                                </div>
                                <div class="card-body">
                                    <div class="ini-chart">
                                        <canvas id="myPieChart" width=""></canvas>
                                        <hr>
                                        <canvas id="myPieChart2" width=""></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once "view-template/footer.php" ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

</html>

<script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= $assets ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assets ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= $assets ?>/js/sb-admin-2.min.js"></script>
<script src="<?= $assets ?>/vendor/chart.js/Chart.min.js"></script>

<script>
    const ctx = document.getElementById('chartOverallStats');
    const chartOverallStats = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $arraydatesjson ?>,
            datasets: [{
                label: 'Income ',
                data: <?= $array30daysjson ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        responsive: true,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString("id-ID", {
                                style: "currency",
                                currency: "IDR",
                                maximumSignificantDigits: 2
                            });
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += tooltipItem.yLabel.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            maximumSignificantDigits: 2
                        });

                        return label;
                    }
                }
            }
        }
    });

    const ctx2 = document.getElementById('myPieChart');
    const myPieChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: [
                'Service',
                'Merchandise',
                'Food & Beverage'
            ],
            datasets: [{
                label: 'Revenue Source',
                data: <?= $arrayRevSource ?>,
                backgroundColor: [
                    '#4E73DF',
                    '#FFBC4A',
                    '#F77565'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.round((currentValue / total) * 100);

                        return percentage + "%";
                    }
                }
            }
        }
    });

    const ctx3 = document.getElementById('myPieChart2');
    const myPieChart2 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: [
                'Car',
                'Motorcycle'
            ],
            datasets: [{
                label: 'Revenue Source',
                data: <?= $arraymomo ?>,
                backgroundColor: [
                    '#36b9cc',
                    '#e74a3b'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.round((currentValue / total) * 100);

                        return percentage + "%";
                    }
                }
            }
        }
    });
</script>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->