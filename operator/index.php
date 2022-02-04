<?php

require_once 'operator-only.php';

$activePageLvl = 0;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Dashboard</title>

    <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
    <link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
    <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <script src="../assets/js/html2pdf/dist/html2pdf.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar Attach -->
        <?php require_once 'view-template/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar Attach -->
                <?php require_once 'view-template/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" onclick="switchView('pendingRequestPanel')" role="button">
                            <div class="card border-left-danger shadow h-100 py-2" id="bor1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" id="tex1">
                                                Pending Request</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pendingTrxCounter"><i class="fas fa-sync fa-spin"></i></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-danger" id="ic1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Transactions Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" onclick="switchView('activeTransactionPanel')" role="button">
                            <div class="card border-left-primary shadow h-100 py-2" id="bor2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="tex2">Active Transaction
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="activeTrxCounter"><i class="fas fa-sync fa-spin"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300" id="ic2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="receiptbody">

                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" onclick="switchView('completeTransactionPanel')" role="button">
                            <div class="card border-left-primary shadow h-100 py-2" id="bor3">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="tex3">
                                                Complete Order (Today)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="completeTrxCounter"><i class="fas fa-sync fa-spin"></i></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-check fa-2x text-gray-300" id="ic3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Today)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="earningsTodayCounter"><i class="fas fa-sync fa-spin"></i></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300" id="ic4"></i> -->
                                            <h3 class="text-gray-400"><strong>Rp</strong></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row opPanel" id="pendingRequestPanel">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clock fa-fw"></i> Pending Request</h5>
                                    <button class="btn btn-outline-primary" id="refreshpendingtrx"><i class="fas fa-sync-alt shadow"></i></button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="pendingTrxTbl">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th scope="col">Inv. Number</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Phone / WA</th>
                                                    <th scope="col">Vehicle</th>
                                                    <th scope="col">Reg. Number</th>
                                                    <th scope="col">Service</th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="pendingTrx">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row opPanel" id="activeTransactionPanel" hidden>

                        <!-- Area Chart -->
                        <div class="col-md-12" id="activeTrxPanel">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list fa-fw"></i> Active Transaction</h5>
                                    <button class="btn btn-outline-primary" id="refreshactivetrx"><i class="fas fa-sync-alt shadow"></i></button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="activeOrdersTbl">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th scope="col">Inv. Number</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Phone / WA</th>
                                                    <th scope="col">Vehicle</th>
                                                    <th scope="col">Reg. Number</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="activeTrx">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5" id="trxDetailPanel" hidden>
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle fa-fw"></i> Transaction Detail</h5>
                                    <button class="btn btn-outline-danger" onclick="hideTrxDetailPanel()"><i class="fas fa-times fa-fw "></i></button>
                                </div>
                                <!-- Card Body -->
                                <div id="trxDetailPanelJS" hidden></div>
                                <div class="card-body" id="trxDetailPanel">
                                    <h5 class="text-center text-dark font-weight-bold">INVOICE</h5>
                                    <h6 class="text-center text-dark font-weight-bold"><u>No : <span id="tdinvoicenumber"></span> </u></h6>
                                    <br>
                                    <p class="mb-0"><strong>Customer</strong></p>
                                    <table class="col-md-12">
                                        <tr>
                                            <td width="33%"><small>Name </small></td>
                                            <td><small> : &emsp; </small><small id="tdcustomername"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>Phone / WA </small></td>
                                            <td><small> : &emsp; </small><small id="tdcustomerphone"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>Reg. Number </small></td>
                                            <td><small> : &emsp; </small><small id="tdplatnomor"> </small></td>
                                        </tr>
                                        <tr>
                                            <td><small>Customer Points </small></td>
                                            <td><small> : &emsp; </small><small id="tdcustomerpoint"> </small><small>&nbsp;<i class="fab fa-product-hunt fa-fw"></i></small></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table class="table table-sm ">
                                        <thead>
                                            <th>Item / Service</th>
                                            <th class="text-center">Qty</th>
                                            <th class=" text-right">Subtotal</th>
                                        </thead>
                                        <tbody id="orderedMenuActive">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="col-md- 12 d-flex justify-content-between">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelPendingTrxModal" onclick="deleteTrxCopyInv()">Cancel</button>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" id="getactivemenus" data-target="#addOrder">Add Order</button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" id="getactivepromos" data-target="#addPromo">Apply Promo</button>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#completeModal" onclick="copyinv2complete()">Complete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row opPanel" id="completeTransactionPanel" hidden>

                        <!-- Area Chart -->
                        <div class="col-md-12" id="completeTrxPanel">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-check fa-fw"></i> Complete Transaction</h5>
                                    <button class="btn btn-outline-primary" id="refreshcompletetrx"><i class="fas fa-sync-alt shadow"></i></button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="completeTrxTbl">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th scope="col">Inv. Number</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Phone / WA</th>
                                                    <th scope="col">Vehicle</th>
                                                    <th scope="col">Reg. Number</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="completeTrx">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5" id="completeTrxDetailPanel" hidden>
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle fa-fw"></i> Transaction Detail</h5>
                                    <button class="btn btn-outline-danger" onclick="hideCompleteTrxDetailPanel()"><i class="fas fa-times fa-fw "></i></button>
                                </div>
                                <!-- Card Body -->
                                <div id="completeTrxDetailPanelJS" hidden></div>
                                <div class="card-body" id="compelteTrxDetailPanel">
                                    <h5 class="text-center text-dark font-weight-bold">INVOICE</h5>
                                    <h6 class="text-center text-dark font-weight-bold"><u>No : <span id="ctdinvoicenumber"></span> </u></h6>
                                    <br>
                                    <!-- <p class="mb-0"><strong>Customer</strong></p> -->
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
                                        <a class="btn btn-success btn-sm" role="button" onclick="call()" id="wacustomer"><i class="fab fa-whatsapp fa-fw"></i> Chat Customer</a>
                                        <!-- <button class="btn btn-primary btn-sm">Add Order</button> -->
                                        <form action="receipt-pdf-builder/template.php" method="POST">
                                            <button class="btn btn-info btn-sm" name="invoicenumber" value="" id="ctdinvoicenumber2"><i class="fas fa-receipt fa-fw"></i> Generate Receipt</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer Attach -->
            <?php require_once "view-template/footer.php" ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Delete Pending Transactions -->
    <div class="modal fade" id="cancelPendingTrxModal" tabindex="-1" aria-labelledby="cancelPendingTrxModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Transaction</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Invoice Number</dt>
                        <dd class="col-sm-8"><mark id="invoice2cancel"></mark></dd>

                        <dt class="col-sm-4">Customer Name</dt>
                        <dd class="col-sm-8" id="customer2cancel"></dd>
                    </dl>

                    <p>To avoid canceling transaction by accident, you have to re-type invoice number above and click <kbd style="background-color: #e74a3b !important;">Cancel Transaction</kbd> button below</p>
                    <input name="invoice2cancel" type="text" onkeyup="isdeleteconfirmed(value)" onchange="isdeleteconfirmed(value)" class="form-control form-control-sm text-danger" placeholder="" id="inputinvoice2cancel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" name="btnCancelOrder" class="btn btn-danger btn-sm" id="btnCancelOrder" disabled>Cancel Transaction</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete Pending Transactions  END-->
    <div id="hujiko" hidden></div>
    <div id="hujiko2" hidden></div>


    <!-- Modal add order to trx -->
    <div class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="addOrderLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderLabel">Add Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="activeMenu">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Done</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add order to trx  end-->

    <!-- Modal add promo to trx -->
    <div class="modal fade" id="addPromo" tabindex="-1" aria-labelledby="addPromoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPromoLabel">Add Promo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="activePromo">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Done</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add promo to trx  end-->


    <!-- Modal complete order input receipt number -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Mark Transaction as Complete and Paid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-dark">To mark the transaction as complete you have to <u>assign a receipt number</u> to this transaction. </h6>
                    <br>
                    <form action="functions/completeorder.php" method="POST">
                        <label for="receiptnumber">Receipt Number</label>
                        <input required class="form-control" type="text" name="receipt" id="receiptnumber" placeholder="Receipt Number">
                        <input type="text" name="invoice_number" id="inv2complete" hidden>
                        <div class="custom-control custom-checkbox mt-2">
                            <input required type="checkbox" class="custom-control-input" id="paidCheck">
                            <label class="custom-control-label" for="paidCheck">This transaction already paid by customer</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" name="completeorder">Complete Transaction</button></form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal complete order input receipt number  END-->





    <!-- Bootstrap core JavaScript-->
    <script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $assets ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $assets ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $assets ?>/js/sb-admin-2.min.js"></script>

    <!-- dataTable js -->
    <script src="<?= $assets ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            reloadAllData();
        });

        function reloadAllData() {
            getActiveTrx();
            getPendingTrx();
            getCompleteTrx();
            getEarnings();
        }

        function generateReceipt() {
            var invoice = document.getElementById("ctdinvoicenumber").innerHTML;
            var receipt = document.getElementById("ctdreceiptnumber").innerHTML;
            $.post("receipt-pdf-builder/template.php", {
                    generatereceipt: true,
                    invoicenumber: invoice
                },
                function(data) {});
        }


        $("#getactivemenus").click(function() {
            getActiveMenus();
        });
        $("#getactivepromos").click(function() {
            getActivePromos();
        });

        $("#refreshcompletetrx").click(function() {
            reloadAllData();
        });

        $("#refreshpendingtrx").click(function() {
            reloadAllData();

        });

        $("#refreshactivetrx").click(function() {
            reloadAllData();
        });

        $("#btnCancelOrder").click(function() {
            var invoice = document.getElementById("inputinvoice2cancel").value;
            $('#cancelPendingTrxModal').modal('hide');
            cancelPendingTrx(invoice);
        });

        function getEarnings() {
            $.post("functions/getearnings.php", {
                    getearnings: true
                },
                function(data) {
                    $("#earningsTodayCounter").html(data);
                });
        }

        function getPendingTrx() {
            $.post("functions/getpendingtrx.php", {
                    getPendingTrx: true
                },
                function(data) {
                    $("#pendingTrx").html(data);
                    //        $('#cancelPendingTrxModal').modal('hide');
                });
            getActiveTrx();
            setTimeout('getPendingTrx()', 5000);
        }

        function getActiveTrx() {
            $.post("functions/getactivetrx.php", {
                    getActiveTrx: true
                },
                function(data) {
                    $("#activeTrx").html(data);
                });
            getCompleteTrx();
        }

        function getCompleteTrx() {
            $.post("functions/getcompletedtrx.php", {
                    getcompletedtrx: true
                },
                function(data) {
                    $("#completeTrx").html(data);
                });
        }

        function completeOrder() {
            var invoice = document.getElementById("tdinvoicenumber").innerHTML;
            $.post("functions/completeorder.php", {
                    completeorder: true,
                    invoice_number: invoice
                },
                function(data) {});
        }


        function cancelPendingTrx(invoice) {
            $.post("functions/cancelpendingtrx.php", {
                    invoice2cancel: invoice
                },
                function(data) {});
            reloadAllData();
            hideTrxDetailPanel();
        }

        function getActiveMenus() {
            var invoice = document.getElementById("tdinvoicenumber").innerHTML;
            $.post("functions/getactivemenus.php", {
                    getactivemenus: true
                },
                function(data) {
                    $("#activeMenu").html(data);
                });
            // viewActiveTrxDetail(invoice)
        }

        function getActivePromos() {
            var invoice = document.getElementById("tdinvoicenumber").innerHTML;
            $.post("functions/getactivepromos.php", {
                    getactivepromos: true
                },
                function(data) {
                    $("#activePromo").html(data);
                });
            // viewActiveTrxDetail(invoice)
        }

        function addOrderToActiveTrx(menuID) {
            var invoice = document.getElementById("tdinvoicenumber").innerHTML;
            $.post("functions/addorder.php", {
                    addorder: true,
                    menuID: menuID,
                    invoice: invoice
                },
                function(data) {
                    $("#hujiko").html(data);
                });
            viewActiveTrxDetail(invoice);
        }

        function addPromoToActiveTrx(menuID) {
            var invoice = document.getElementById("tdinvoicenumber").innerHTML;
            $.post("functions/addpromo.php", {
                    addPromo: true,
                    menuID: menuID,
                    invoice: invoice
                },
                function(data) {
                    $("#hujiko").html(data);
                });
            viewActiveTrxDetail(invoice);
        }

        function confirmPendingTrx(invoice) {
            $.post("functions/confirmpendingtrx.php", {
                    pendingTrxInvoice: invoice
                },
                function(data) {});
            reloadAllData();
        }


        function viewActiveTrxDetail(invoice) {
            document.getElementById("activeTrxPanel").className = 'col-md-8';
            document.getElementById("trxDetailPanel").className = 'col-md-4';
            document.getElementById("trxDetailPanel").hidden = false;
            $.post("functions/getactivetrxdetail.php", {
                    activeTrxInvoice: invoice
                },
                function(data) {
                    $("#trxDetailPanelJS").html(data);
                });
            getOrderedMenu(invoice);
        }

        function viewCompleteTrxDetail(invoice) {
            document.getElementById("completeTrxPanel").className = 'col-md-8';
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


        function cancelOrder(orderID, invoice) {
            $.post("functions/cancelorder.php", {
                    invoice_number: invoice,
                    order_id: orderID
                },
                function(data) {
                    $("#hujiko2").html(data);

                });
            viewActiveTrxDetail(invoice);
        }

        function getOrderedMenu(invoice) {
            $.post("functions/getorders.php", {
                    invoice_number: invoice
                },
                function(data) {
                    $("#orderedMenuActive").html(data);
                });
        }

        function getCompleteOrderedMenu(invoice) {
            $.post("functions/getcompleteorders.php", {
                    invoice_number: invoice
                },
                function(data) {
                    $("#completeOrderedMenuActive").html(data);
                });
        }

        function minusOrder(orderID, invoice) {
            $.post("functions/changeorderamount.php", {
                    order_id: orderID,
                    doMinus: true
                },
                function(data) {
                    $("#amountof" + orderID).html(data);
                });
            viewActiveTrxDetail(invoice);
        }

        function plusOrder(orderID, invoice) {
            $.post("functions/changeorderamount.php", {
                    order_id: orderID,
                    doPlus: true
                },
                function(data) {
                    $("#amountof" + orderID).html(data);
                });
            viewActiveTrxDetail(invoice);
        }

        // function assignReceiptAndCompleteTrx() {
        //     var invoice = document.getElementById("tdinvoicenumber").innerHTML;
        //     var receipt = document.getElementById("receiptnumber").value;
        //     $.post("functions/completeorder.php", {
        //             invoice_number: invoice,
        //             receipt: receipt,
        //             completeorder: true
        //         },
        //         function(data) {
        //             $("#hujiko").html(data);

        //         });
        //     reloadAllData();
        //     setTimeout($('#completeModal').modal('hide'), 1000)
        //     hideTrxDetailPanel();
        //     // viewActiveTrxDetail(invoice);

        //     document.getElementById("receiptnumber").value = '';
        //     document.getElementById("paidCheck").checked = false;
        //     document.getElementById("submitReceiptNumber").disabled = true;

        // }


        function switchView(show) {
            document.getElementById('pendingRequestPanel').hidden = true;
            document.getElementById('activeTransactionPanel').hidden = true;
            document.getElementById('completeTransactionPanel').hidden = true;
            document.getElementById(show).hidden = false;

            if (document.getElementById('pendingRequestPanel').hidden == false) {
                document.getElementById("ic1").classList.remove('text-gray-300');
                document.getElementById("ic1").classList.add('text-danger');

                document.getElementById("bor1").classList.remove('border-left-primary');
                document.getElementById("bor1").classList.add('border-left-danger');

                document.getElementById("tex1").classList.remove('text-primary');
                document.getElementById("tex1").classList.add('text-danger');
            } else {
                document.getElementById("ic1").classList.remove('text-danger');
                document.getElementById("ic1").classList.add('text-gray-300');

                document.getElementById("bor1").classList.remove('border-left-danger');
                document.getElementById("bor1").classList.add('border-left-primary');

                document.getElementById("tex1").classList.remove('text-danger');
                document.getElementById("tex1").classList.add('text-primary');
            }



            if (document.getElementById('activeTransactionPanel').hidden == false) {
                document.getElementById("ic2").classList.remove('text-gray-300');
                document.getElementById("ic2").classList.add('text-danger');

                document.getElementById("bor2").classList.remove('border-left-primary');
                document.getElementById("bor2").classList.add('border-left-danger');

                document.getElementById("tex2").classList.remove('text-primary');
                document.getElementById("tex2").classList.add('text-danger');
            } else {
                document.getElementById("ic2").classList.remove('text-danger');
                document.getElementById("ic2").classList.add('text-gray-300');

                document.getElementById("bor2").classList.remove('border-left-danger');
                document.getElementById("bor2").classList.add('border-left-primary');

                document.getElementById("tex2").classList.remove('text-danger');
                document.getElementById("tex2").classList.add('text-primary');
            }



            if (document.getElementById('completeTransactionPanel').hidden == false) {
                document.getElementById("ic3").classList.remove('text-gray-300');
                document.getElementById("ic3").classList.add('text-danger');

                document.getElementById("bor3").classList.remove('border-left-primary');
                document.getElementById("bor3").classList.add('border-left-danger');

                document.getElementById("tex3").classList.remove('text-primary');
                document.getElementById("tex3").classList.add('text-danger');

            } else {
                document.getElementById("ic3").classList.remove('text-danger');
                document.getElementById("ic3").classList.add('text-gray-300');

                document.getElementById("bor3").classList.remove('border-left-danger');
                document.getElementById("bor3").classList.add('border-left-primary');

                document.getElementById("tex3").classList.remove('text-danger');
                document.getElementById("tex3").classList.add('text-primary');
            }
        }

        function deletePendingTrxCopyInv(inv, name) {
            document.getElementById("invoice2cancel").innerHTML = inv;
            document.getElementById("customer2cancel").innerHTML = name;
            document.getElementById("inputinvoice2cancel").placeholder = inv;
            document.getElementById("inputinvoice2cancel").value = '';
            document.getElementById("btnCancelOrder").disabled = true;

        }

        function deleteTrxCopyInv() {
            var inv = document.getElementById("tdinvoicenumber").innerHTML;
            var name = document.getElementById("tdcustomername").innerHTML;
            document.getElementById("invoice2cancel").innerHTML = inv;
            document.getElementById("customer2cancel").innerHTML = name;
            document.getElementById("inputinvoice2cancel").placeholder = inv;
            document.getElementById("inputinvoice2cancel").value = '';
            document.getElementById("btnCancelOrder").disabled = true;
        }

        function isdeleteconfirmed(value) {
            if (document.getElementById("invoice2cancel").innerHTML == value) {
                document.getElementById("btnCancelOrder").disabled = false;
            } else {
                document.getElementById("btnCancelOrder").disabled = true;
            }
        }

        function hideTrxDetailPanel() {
            document.getElementById("activeTrxPanel").className = 'col-md-12';
            document.getElementById("trxDetailPanel").hidden = true;
        }

        function hideCompleteTrxDetailPanel() {
            document.getElementById("completeTrxPanel").className = 'col-md-12';
            document.getElementById("completeTrxDetailPanel").hidden = true;
        }

        function copyinv2complete() {
            var inv = document.getElementById("tdinvoicenumber").innerHTML;
            document.getElementById("inv2complete").value = inv;
        }

        // function paidCheck() {
        //     if (document.getElementById("paidCheck").checked == true && document.getElementById("receiptnumber").value != '') {
        //         document.getElementById("submitReceiptNumber").disabled = false;
        //     } else {
        //         document.getElementById("submitReceiptNumber").disabled = true;
        //     }
        // }

        function call() {
            var url = document.getElementById("apiwalink").innerHTML;
            popup = window.open(url);
            setTimeout(wait, 5000);
        }

        function wait() {
            popup.close();
        }
    </script>

</body>

</html>



<!-- CUSTOM CSS CLASS FOR THIS PAGE ONLY -->
<style>
    table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }

    table tr:first-child th:first-child {
        border-top-left-radius: 0.4rem !important;
    }

    table tr:first-child th:last-child {
        border-top-right-radius: 0.4rem !important;
    }

    table tr:first-child td:first-child {
        border-top-left-radius: 0.1rem !important;
    }

    table tr:first-child td:last-child {
        border-top-right-radius: 0.1rem !important;
    }
</style>