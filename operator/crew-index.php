<?php
require_once 'operator-only.php';
$activePageLvl = 3;

// Get Data From DB For User List
$query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
$execute_getUser = mysqli_query($link, $query_getUser);

$query_getServices = "SELECT * FROM menus WHERE type = 'service' AND status = 'active'";
$execute_getServices = mysqli_query($link, $query_getServices);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Menu</title>

    <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
    <link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
    <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- dataTable css -->
    <link href="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>

<body class="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar Attach -->
        <?php #require_once 'view-template/sidebar.php'; 
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar Attach -->
                <?php require_once 'view-template/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="col-md-12">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Queue </h1>
                        <?php
                        if (isset($_COOKIE['returnstatus'])) {
                            if ($_COOKIE['returnstatus'] == 'ok') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>OK,</strong> The task assigned to you.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'conflict') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Oops!</strong><br> The task already taken by someone else.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'conflictfinish') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Oops!</strong><br> This task seems like already finished or not assigned to you.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'okfinish') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Done,</strong> One of your task has been marked as finish.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            }
                        }
                        ?>

                    </div>

                    <!-- Content Row -->
                    <div class="col-md-12 mx-0">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list fa-fw"></i> Your Active Task</h5>
                                <button class="btn btn-outline-primary" id="refreshactivetrx"><i class="fas fa-sync-alt shadow"></i></button>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="activeOrdersTbl">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th scope="col">Your Task</th>
                                            </tr>
                                        </thead>
                                        <tbody id="queue2">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mx-0">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list fa-fw"></i> Active Transaction Queue</h5>
                                <button class="btn btn-outline-primary" id="refreshactivetrx"><i class="fas fa-sync-alt shadow"></i></button>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="activeOrdersTbl">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th scope="col">Active Queue</th>
                                            </tr>
                                        </thead>
                                        <tbody id="queue">

                                        </tbody>
                                    </table>
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

        <div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalActionLabel">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Transaction ID : <span id="showInv" class="font-weight-bold"></span></h5><br>

                        <div id="modalActionData">

                        </div>


                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAction2" tabindex="-1" aria-labelledby="modalAction2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAction2Label">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Transaction ID : <span id="showInv" class="font-weight-bold"></span></h5><br>

                        <div id="modalAction2Data">

                        </div>


                    </div>

                </div>
            </div>
        </div>

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
                getActiveQueue();
                getActiveQueue2();
            });

            function getActiveQueue() {
                $.post("functions/getqueue.php", {
                        getqueue: true
                    },
                    function(data) {
                        $("#queue").html(data);
                    });
                setTimeout('getActiveQueue()', 5000);
            }

            function getActiveQueue2() {
                $.post("functions/getqueue2.php", {
                        getqueue2: true
                    },
                    function(data) {
                        $("#queue2").html(data);
                    });
                setTimeout('getActiveQueue2()', 5000);
            }

            function openAction(invoice) {
                $.post("functions/getqueuedetail.php", {
                        getqueue: true,
                        invoice: invoice
                    },
                    function(data) {
                        $("#modalActionData").html(data);
                    });
                $('#modalAction').modal('show');
                document.getElementById("showInv").innerHTML = invoice;
            }
        </script>
</body>

</html>