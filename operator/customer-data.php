<?php
require_once 'operator-only.php';
$activePageLvl = 1;

// Get Data From DB For User List
$query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
$execute_getUser = mysqli_query($link, $query_getUser);
$i = 1;

$query_getCustomers = "SELECT * FROM customers";
$execute_getCustomers = mysqli_query($link, $query_getCustomers);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Menu</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Customer Basic Information </h1>
                        <?php
                        if (isset($_COOKIE['returnstatus'])) {
                            if ($_COOKIE['returnstatus'] == 'serviceadded') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>New Service Added To The Menu</strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'servicenotadded') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Failed!</strong><br>Something abnormal happen, please try again.<hr>If error continues please contact developer.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'serviceaddednotuploaded') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                          <strong>New Service Added To The Menu With An Error. <br></strong>Thumbnail image not uploaded, unknown reason. [ERR-998]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'servicedeleted') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>A Customer Data Has Been Deleted.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'servicenotdeleted') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Service Deletion Failed. <br>Error : </strong>Service not found.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'serviceupdated') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>A Customer Data Has Been Updated.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'servicenotupdated') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Service Update Failed. <br>Error : </strong>Service redundant or id not found. [ERR-274]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'serviceexist') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Add New Service Failed. <br> Error :</strong> Service Already Exist In Menu 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            } elseif ($_COOKIE['returnstatus'] == 'serviceredundant') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Update Service Failed. <br> Error :</strong> A Service With The Same Name Already Exist On The Menu
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                            }
                        }
                        ?>

                        <!-- <a target="_blank" href="download-builder/user-data-download.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download User Data</a> -->
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- User Manager -->
                        <div class="col-xl-12 col-lg-12" id="panelUtama">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-smile fa-fw"></i> Customers Information</h5>
                                    <!-- <a data-toggle="modal" data-target="#addMenuModal" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> Add Menu</a> -->
                                    <!-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-striped" id="services">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Membership</th>
                                                <th scope="col">Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($customer = mysqli_fetch_assoc($execute_getCustomers)) {
                                                $fullname = $customer['fullname'];
                                                $phone = $customer['phone'];
                                                $email = $customer['email'];
                                                $membership = ($customer['membership'] == 'member') ? 'Member' : 'Customer';
                                                $points = $customer['membership_point'];
                                            ?>
                                                <tr onclick="openDetail('<?= $customer['id'] . '\',\'' . $fullname . '\',\'' . $phone . '\',\'' . $email . '\',\'' . $membership . '\',\'' . $points ?>')">
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $fullname ?></td>
                                                    <td><?= $phone ?></td>
                                                    <td><?= $membership ?></td>
                                                    <td><?= $points ?></td>
                                                </tr>
                                            <?php $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-xl-4 col-lg-4" hidden id="detailPanel">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary" id="rightPaneTitle"><i class="fas fa-id-card fa-fw"></i> Customer Detail</h5>
                                    <a class="btn btn-danger" onclick="closeDetailPanel()"><i class="fas fa-times fa-fw"></i></a>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" id="modeView">
                                    <div class="row col-md-12">
                                        <!-- <div class="col-xl-5">
                                            <div class="d-flex justify-content-center">
                                                <img id="thumbnailShow" src="" class="rounded-lg border border-white shadow" width=100%>
                                            </div>
                                        </div> -->
                                        <div class="col-xl-12">
                                            <h5 class="mb-0 text-dark font-weight-bolder" id="servicenameShow"></h5>
                                            <p class="mb-0"><i class="fas fa-envelope fa-fw"></i> <span id="typeShow"></span></p>
                                            <p class="mb-2"><i class="fas fa-mobile-alt fa-fw "></i> <span id="priceShow"></span></p>
                                            <p class="mb-2">Membership Points : <span id="poinShow"></span> <i class="fab fa-product-hunt fa-fw fa-sm"></i></p>
                                            <p class="mb-2 font-weight-bolder" id="statusShow"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- <br> -->
                                    <div class="col-xl-12 col-lg-12 text-dark">
                                        <p class="font-weight-bolder"><i class="fas fa-star fa-fw"></i> Membership Status : <span id="descriptionShow" class="text-info"></span></p>
                                        <!-- <p class="text-justify" id="descriptionShow"></p> -->
                                    </div>
                                    <div class="form-group col-md-12" id="btnupgrade" hidden>
                                        <form action="functions/upgrademember.php" method="post">
                                            <button class="btn btn-success btn-block" name="upgradebtn" value="" id="upgradebtn"><i class="fas fa-star"></i> Upgrade To Member <i class="fas fa-star"></i></button>
                                        </form>
                                    </div>
                                    <hr>
                                    <div class="row mx-2 d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary" onclick="changeMode()">
                                            <i class="fas fa-edit fa-fw fa-sm"></i> Edit </a>
                                        &emsp;
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteservice">
                                            <i class="fas fa-trash-alt fa-fw fa-sm"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="card-body" id="modeEdit" hidden>
                                    <form action="functions/update-customer-data.php" method="post" enctype="multipart/form-data">
                                        <div class="form-row">

                                            <div class="form-group col-md-7">
                                                <label for="updateFullname">Customer Name</label>
                                                <input required autocomplete="off" type="text" class="form-control" id="updateFullname" placeholder="Customer Name" name="customername">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="updatePhone">Customer Phone</label>
                                                <input required autocomplete="off" type="text" class="form-control" id="updatePhone" placeholder="Customer Phone" name="customerphone">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="updateEmail">Customer Email</label>
                                                <input required autocomplete="off" type="text" class="form-control" id="updateEmail" placeholder="Customer Email" name="customeremail">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="updatePoint">Point</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fab fa-product-hunt fa-fw"></i></span>
                                                    </div>
                                                    <input required autocomplete="off" type="text" class="form-control" id="updatePoint" placeholder="123" name="memberpoint">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="btn btn-secondary" onclick="changeMode()">Cancel</a> &emsp;
                                                <input type="text" name="serviceidhidden" id="serviceidhidden" hidden>
                                                <button type="submit" name="btnUpdateService" class="btn btn-primary">Save <i class="fas fa-save fa-fw fa-sm"></i></button>
                                            </div>
                                        </div>
                                    </form>
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





    <!-- Modal Add New Menu -->
    <div class="modal fade " data-backdrop="static" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">Add New Service To Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/add-service-menu.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select id="inputCategory" class="form-control" name="category">
                                    <option selected value="Car">Car</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputServiceName">Service Name</label>
                                <input required autocomplete="off" type="text" class="form-control" id="inputServiceName" placeholder="Service Name" name="servicename">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputServicePrice">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input required autocomplete="off" type="text" class="form-control" id="inputServicePrice" placeholder="50000" name="serviceprice">
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputFileImage">Thumbnail Image (Optional) </label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" onchange="imageSelected()" id="inputFileImage" accept=".jpg" name="thumbnail">
                                        <label class="custom-file-label" for="inputFileImage" id="inputFileImageLabel">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPoin">Poin</label>
                                <input required autocomplete="off" type="number" class="form-control" id="inputPoin" placeholder="Poin" name="poin">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="inputServiceDesc">Service Description (Optional)</label>
                                <textarea autocomplete="off" class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this service" name="servicedesc"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="setActiveCheck" name="activate">
                                <label class="custom-control-label" for="setActiveCheck">Set as Active</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                    <button type="submit" name="btnAddServiceMenu" class="btn btn-primary">Save <i class="fas fa-save fa-fw"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New Menu  END-->


    <!-- Modal confirm delete service -->
    <div class="modal fade" id="deleteservice" tabindex="-1" aria-labelledby="deleteserviceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm To Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bolder text-dark" id="deleteTitle">[ Express Plus ]</h4>
                    Are you sure want to delete this customer data?
                </div>
                <div class="modal-footer">
                    <form action="functions/delete-customerdata.php" method="post">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="password" name="hiddenServiceID" id="hiddenServiceID" hidden readonly>
                        <input type="password" name="origin" id="origin" hidden readonly value="customer-data.php">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt fa-fw fa-sm"></i> Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal confirm delete service END-->







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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#services').DataTable();
        });





        function imageSelected() {
            if (document.getElementById("inputFileImage").value != '') {
                var input = document.getElementById("inputFileImage");
                document.getElementById("inputFileImageLabel").innerHTML = input.files.item(0).name;
            }
        }

        function imageSelected2() {
            if (document.getElementById("updateImage").value != '') {
                var input = document.getElementById("updateImage");
                document.getElementById("updateImageLabel").innerHTML = input.files.item(0).name;
            }
        }

        function openDetail(id, fullname, phone, email, membership, points) {
            document.getElementById('detailPanel').hidden = false;
            document.getElementById('modeView').hidden = false;
            document.getElementById('modeEdit').hidden = true;
            document.getElementById('rightPaneTitle').innerHTML = '<i class="fas fa-id-card fa-fw"></i> Customer Detail';


            console.log(id);

            // document.getElementById('thumbnailShow').src = '../assets/img/thumbnail/' + thumbnail;
            document.getElementById('servicenameShow').innerHTML = fullname;
            document.getElementById('typeShow').innerHTML = email;
            document.getElementById('priceShow').innerHTML = phone;
            document.getElementById('poinShow').innerHTML = points;
            document.getElementById('hiddenServiceID').value = id;
            document.getElementById('serviceidhidden').value = id;
            document.getElementById('deleteTitle').innerHTML = '[ ' + fullname + ' ]';
            document.getElementById('descriptionShow').innerHTML = membership;

            document.getElementById('updateFullname').value = fullname;
            document.getElementById('updatePhone').value = phone;
            document.getElementById('updateEmail').value = email;
            document.getElementById('updatePoint').value = points;

            if (membership == 'Customer') {
                document.getElementById("btnupgrade").hidden = false;
                document.getElementById("upgradebtn").value = id;
            } else {
                document.getElementById("btnupgrade").hidden = true;
            }




            document.getElementById('panelUtama').className = 'col-xl-8 col-lg-8';
            if (status == 'Active') {
                document.getElementById('statusShow').innerHTML = '<i class="fas fa-dot-circle text-info"></i> Active';
            } else if (status == 'Inactive') {
                document.getElementById('statusShow').innerHTML = '<i class="far fa-dot-circle text-danger"></i> Inactive';
            }



        }

        function closeDetailPanel() {
            document.getElementById('detailPanel').hidden = true;
            document.getElementById('panelUtama').className = 'col-xl-12 col-lg-12';
        }

        function changeMode() {
            if (document.getElementById('modeView').hidden == false) {
                document.getElementById('modeView').hidden = true;
                document.getElementById('modeEdit').hidden = false;
            } else {
                document.getElementById('modeView').hidden = false;
                document.getElementById('modeEdit').hidden = true;
            }
        }
    </script>

</body>

</html>