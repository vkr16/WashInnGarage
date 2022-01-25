<?php 
	require_once 'admin-only.php';
	$activePageLvl=3;

    $query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
    $execute_getUser = mysqli_query($link,$query_getUser);
    $i = 1;
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Account Management</title>

	<link rel="icon" type="image/png" href="<?=$assets?>/img/logo.png">
	<link rel="stylesheet" type="text/css" href="<?=$assets?>/css/sb-admin-2.min.css">
	<link href="<?=$assets?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- dataTable css -->
    <link href="<?=$assets?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Manage Menu </h1>
                        
                        <?php 
                            if (isset($_COOKIE['returnstatus'])) {
                                if ($_COOKIE['returnstatus'] == 'userexist') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Registration failed!, Username already exist in database
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'success') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Registration successful!</strong><br>Password sent to user\'s email, please ask user to check their spam folder!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'usernameconflict') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Update failed!</strong>, new username conflict with another user in database
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'updatesuccess') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Update successful!</strong><br>Information update sent to user\'s email, please ask user to check their spam folder!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'deletesuccess') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>User Deletion Successful!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'offlinewarning') {
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Update Successful With an Error!</strong><br>
                                        Failed send email notification to user!!
                                        Update saved to database but user got no notification!
                                        <br>It may caused by invalid email address or there is no internet connection.<br><hr>
                                        If you just reset user password, please try again with internet connection!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'offlineFailed') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Add New User Failed!!</strong><br>
                                        Can not send email confirmation to user, 
                                        <br>It may caused by invalid email address or there is no internet connection.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }
                            }
                         ?>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- User Manager -->
                        <div class="col-xl-8 col-lg-8">
                            <div class="card shadow mb-4">

                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-toolbox fa-fw"></i> Services</h5>
                                    <a data-toggle="modal" data-target="#addMenuModal" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> Add Menu</a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-striped" id="services">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Service Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@mdo</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@mdo</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select id="inputCategory" class="form-control">
                                    <option selected value="Car">Car</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputServiceName">Service Name</label>
                                <input type="text" class="form-control" id="inputServiceName" placeholder="Service Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputServicePrice">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="inputServicePrice" placeholder="50.000">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputFileImage">Thumbnail Image (Optional)</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" onchange="imageSelected()" id="inputFileImage" accept=".jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="inputFileImage" id="inputFileImageLabel">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="inputServiceDesc">Service Description (Optional)</label>
                                <textarea class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this service"></textarea>
                            </div>
                        </div>
                  
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="setActiveCheck">
                                <label class="custom-control-label" for="setActiveCheck">Set as Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                    <button type="button" class="btn btn-primary">Save <i class="fas fa-save fa-fw"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New Menu  END-->

	<!-- Bootstrap core JavaScript-->
    <script src="<?=$assets?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$assets?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$assets?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$assets?>/js/sb-admin-2.min.js"></script>

    <!-- dataTable js -->
    <script src="<?=$assets?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=$assets?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#services').DataTable();
        });


        function imageSelected(){
            if (document.getElementById("inputFileImage").value != '') {
                var input =  document.getElementById("inputFileImage");
                document.getElementById("inputFileImageLabel").innerHTML = input.files.item(0).name;
            }
        }
    </script>
</body>
</html>