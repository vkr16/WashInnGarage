<?php
require_once 'admin-only.php';
$activePageLvl = 2;
$query_getTrx = "SELECT * FROM transactions WHERE trx_status = 'completed'";
$execute_getTrx = mysqli_query($link, $query_getTrx);
include 'download-builder/all-trx-download.php';
include 'download-builder/monthly-trx-download.php';
include 'download-builder/daily-trx-download.php';
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
    <link href="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $assets ?>/css/bootstrap-datepicker3.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php require_once 'view-template/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once 'view-template/topbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#generateReportModal"><i class="fas fa-file-export fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12" id="panelUtama">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list fa-fw"></i> Transactions Data</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row col-md-12">
                                        <div class="col-md-12" id="mainPanel">
                                            <div id="tableTransactions">
                                                <table class="table table-hover" id="tableTrx">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Transaction ID</th>
                                                        <th>No. Receipt</th>
                                                        <th>Time of Completion</th>
                                                        <th>Customer</th>
                                                        <th>Operator</th>
                                                        <th>Value</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        while ($trx = mysqli_fetch_assoc($execute_getTrx)) {
                                                            $values = 0;
                                                            $trxID = $trx['id'];
                                                            $mdate = date_create($trx['completedate']);
                                                            $mtime = date_create($trx['completetime']);
                                                            $date = date_format($mdate, "d/m/Y");
                                                            $time = date_format($mtime, "H:i");
                                                            $completiontime =  $date . ' at ' . $time;
                                                            $query_getOrder = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'completed'";
                                                            $execute_getOrder = mysqli_query($link, $query_getOrder);
                                                            while ($order = mysqli_fetch_assoc($execute_getOrder)) {
                                                                $menuID = $order['menu_id'];
                                                                $query_getMenu = "SELECT * FROM menus WHERE id = '$menuID'";
                                                                $execute_getMenu = mysqli_query($link, $query_getMenu);
                                                                $menu = mysqli_fetch_assoc($execute_getMenu);
                                                                $qty = $order['amount'];
                                                                $price = $menu['price'];
                                                                $value = $price * $qty;
                                                                $values = $values + $value;
                                                            }
                                                            $values = 'Rp ' . number_format($values, 0, ',', '.');
                                                        ?>
                                                            <tr onclick="viewCompleteTrxDetail('<?= $trx['invoice_number'] ?>')" role="button">
                                                                <th><?= $i ?></th>
                                                                <td><a href="#" class="text-decoration-none"><?= $trx['invoice_number'] ?></a></td>
                                                                <td><?= $trx['receipt_number'] ?></td>
                                                                <td><?= $completiontime ?></td>
                                                                <td><?= $trx['customer_name'] ?></td>
                                                                <td><?= $trx['operator_name'] ?></td>
                                                                <td><?= $values ?></td>
                                                            </tr>
                                                        <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5" id="completeTrxDetailPanel" hidden>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle fa-fw"></i> Transaction Detail</h5>
                                    <button class="btn btn-outline-danger" onclick="hideCompleteTrxDetailPanel()"><i class="fas fa-times fa-fw "></i></button>
                                </div>
                                <div id="completeTrxDetailPanelJS" hidden></div>
                                <div class="card-body" id="compelteTrxDetailPanel">
                                    <h5 class="text-center text-dark font-weight-bold">Transaction ID</h5>
                                    <h6 class="text-center text-dark font-weight-bold"><u>No : <span id="ctdinvoicenumber"></span> </u></h6>
                                    <br>
                                    <table class="col-md-12">
                                        <tr>
                                            <td width="27%"><small>Name </small></td>
                                            <td><small> : &emsp; </small><small id="ctdcustomername"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>Phone / WA </small></td>
                                            <td><small> : &emsp; </small><small id="ctdcustomerphone"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>Reg. Number </small></td>
                                            <td><small> : &emsp; </small><small id="ctdplatnomor"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>No. Receipt</small></td>
                                            <td><small> : &emsp; </small><small id="ctdreceiptnumber"></small></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table class="table table-sm ">
                                        <thead>
                                            <th>Item / Service</th>
                                            <th class="text-center">Qty</th>
                                            <th class=" text-right">Subtotal</th>
                                        </thead>
                                        <tbody id="completeOrderedMenuActive">

                                        </tbody>
                                    </table>
                                    <div class="col-md-8 offset-md-4 text-right">
                                        <hr>
                                        <p id="containerpoints"><strong> Points Earned :</strong> <span id="ctdearnedpoints">0</span> <i class="fab fa-product-hunt fa-fw fa-sm"></i></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-md- 12 d-flex justify-content-between">
                                        <span hidden id="apiwalink"></span>
                                        <a class="btn btn-success btn-sm" role="button" onclick="call()" id="wacustomer"><i class="fas fa-receipt fa-fw"></i> Generate Customer Receipt</a>
                                        <form action="receipt-pdf-builder/template.php" method="POST" hidden>
                                            <button class="btn btn-info btn-sm" name="invoicenumber" value="" id="ctdinvoicenumber2"><i class="fas fa-receipt fa-fw"></i> Generate Receipt</button>
                                        </form>
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

    <!-- Modal -->
    <div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="generateReportLabel">Generate Report Spreadsheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <h6>Download <span class="text-info font-weight-bold">All</span> Data</h6>
                        <form action="" method="POST">
                            <button name="downloadall" value="true" class="btn btn-sm btn-info" onclick="downloadAll()"><i class="fas fa-file-download fa-fw fa-sm"></i> Download</button>
                        </form>
                        <small>It will download all complete transactions data</small>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h6>Download <span class="text-info font-weight-bold">Monthly</span> Data</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="" method="POST">
                                    <input role="button" type="text" value="<?= date("F Y") ?>" class="form-control form-control-sm" name="monthpicker" id="monthpicker" readonly />
                            </div>
                            <button class="btn btn-sm btn-info" name="downloadmonthly" value="true"><i class="fas fa-file-download fa-fw fa-sm"></i> Download</button>
                            </form>
                        </div>
                        <small class="text-danger" id="notiArea1" hidden></small>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h6>Download <span class="text-info font-weight-bold">Daily</span> Data</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="" method="POST">
                                    <input type="text" value="<?= date("j F Y") ?>" class="form-control form-control-sm" name="datepicker" id="datepicker" readonly />
                            </div>
                            <button name="downloaddaily" value="true" class="btn btn-sm btn-info"><i class="fas fa-file-download fa-fw fa-sm"></i> Download</button>
                            </form>
                        </div>
                        <small class="text-danger" id="notiArea2" hidden></small>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= $assets ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assets ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= $assets ?>/js/sb-admin-2.min.js"></script>
<script src="<?= $assets ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= $assets ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= $assets ?>/js/bootstrap-datepicker.min.js"></script>
<script src="<?= $assets ?>/js/bootstrap-datepicker.id.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tableTrx').DataTable();

        $("#datepicker").datepicker({
            format: "d MM yyyy",
            startView: "days",
            minViewMode: "days"
        });
        $("#monthpicker").datepicker({
            format: "MM yyyy",
            startView: "months",
            minViewMode: "months"
        });
    });

    function viewCompleteTrxDetail(invoice) {
        document.getElementById("panelUtama").className = 'col-md-8';
        document.getElementById("completeTrxDetailPanel").className = 'col-md-4';
        document.getElementById("completeTrxDetailPanel").hidden = false;
        $.post("functions/getcompletetrxdetail.php", {
                completeTrxInvoice: invoice
            },
            function(data) {
                $("#completeTrxDetailPanelJS").html(data);
            });
        getCompleteOrderedMenu(invoice);
    }

    function getCompleteOrderedMenu(invoice) {
        $.post("functions/getcompleteorders.php", {
                invoice_number: invoice
            },
            function(data) {
                $("#completeOrderedMenuActive").html(data);
            });
    }

    function call() {
        document.getElementById('ctdinvoicenumber2').click();
        var url = document.getElementById("apiwalink").innerHTML;
        popup = window.open(url);
        setTimeout(wait, 5000);
    }

    function hideCompleteTrxDetailPanel() {
        document.getElementById("panelUtama").className = 'col-md-12';
        document.getElementById("completeTrxDetailPanel").hidden = true;
    }
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