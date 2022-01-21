<?php 
	require_once 'admin-only.php';
	$activePageLvl=1;

    // Get Data From DB For User List
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

	 <!-- Custom styles for this page -->
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
                        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                        <a target="_blank" href="download-builder/user-data-download.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Download User Data</a>
                    </div>

                    <!-- Content Row -->


                    <!-- User Manager -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Registered User List</h6>
                                <div class="dropdown no-arrow">
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
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div> -->

                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">No</th>
                                      <th scope="col">Nama</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Username</th>
                                      <th scope="col">Role</th>
                                      <th colspan="2" class="text-center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php while ($result_getUser = mysqli_fetch_assoc($execute_getUser)) { ?>
                                    <tr>
                                      <th scope="row"><?= $i ?></th>
                                      <td><?= $result_getUser['fullname'] ?></td>
                                      <td><?= $result_getUser['email'] ?></td>
                                      <td><?= $result_getUser['username'] ?></td>
                                      <td><?php echo $result_getUser['role']=='admin'?"Admin":"Operator";  ?></td>
                                      <td class="text-center"><a href="#edit<?= $result_getUser['id'] ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a></td>
                                      <td class="text-center">
                                        <button class="btn btn-danger" data-toggle="modal" onclick="del_conf('<?= $result_getUser['username'] ?>','<?= $result_getUser['id'] ?>')" data-target="#modalDeleteUser">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </button>
                                      </td>
                                    </tr>
                                    <?php $i++;} ?>

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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>










    <!-- MODAL DELETE USER -->
    <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteUserLabel">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="disable-select">Please type <strong class="text-danger">DELETE/<span id="usernametodelete"></span></strong> to confirm.</h5>
            <input type="text" autocomplete="off" onkeyup="equal_checker()" onchange="equal_checker()" name="deleteUser" class="form-control" id="usernameinputtodelete" placeholder="DELETE/ibrahim23">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form action="functions/delete-user.php" method="post">
            <button disabled="true" type="submit" value="" name="btnDelete" class="btn btn-danger" id="btnDelete"><i class="fas fa-trash-alt fa-fw"></i>&nbsp; Delete User</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL DETELE USER END -->


    <script type="text/javascript">
            
        function del_conf(username, id){
            document.getElementById("usernametodelete").innerHTML = username;
            document.getElementById("usernameinputtodelete").placeholder = "DELETE/"+username;
            document.getElementById("btnDelete").value = id;
        }

        function equal_checker(){
            if (document.getElementById("usernameinputtodelete").value == "DELETE/"+document.getElementById("usernametodelete").innerHTML) {
                document.getElementById("btnDelete").disabled = false;
            }else{
                document.getElementById("btnDelete").disabled = true;
            }
        }

    </script>


	<!-- Bootstrap core JavaScript-->
    <script src="<?=$assets?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$assets?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$assets?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$assets?>/js/sb-admin-2.min.js"></script>

</body>
</html>

<!-- =================================== -->
<!--         CUSTOM CLASS CSS            -->
<!-- =================================== -->

<style type="text/css">
.disable-select {
    user-select: none; /* supported by Chrome and Opera */
   -webkit-user-select: none; /* Safari */
   -khtml-user-select: none; /* Konqueror HTML */
   -moz-user-select: none; /* Firefox */
   -ms-user-select: none; /* Internet Explorer/Edge */
}
</style>