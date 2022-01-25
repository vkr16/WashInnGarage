<?php 
	require_once 'admin-only.php';
	$activePageLvl=1;

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
                        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                        

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

                        <a target="_blank" href="download-builder/user-data-download.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Download User Data</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- User Manager -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">

                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">Registered User List</h5>
                                    <a href="new-user.php" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> New User</a>    
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-striped " id="usersTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($result_getUser = mysqli_fetch_assoc($execute_getUser)) { ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $result_getUser['fullname'] ?></td>
                                                    <td><?= $result_getUser['email'] ?></td>
                                                    <td><?= $result_getUser['username'] ?></td>
                                                    <td><?php if ($result_getUser['role']=='admin') {
                                                        echo "Admin";
                                                    }elseif ($result_getUser['role']=='operator') {
                                                        echo "Operator";
                                                    }else{echo "";};  ?></td>
                                                    <td class="row">
                                                        <form action="edit-user.php" method="post">
                                                            <button class="btn btn-primary" type="submit" name="btnEditUser" value="<?= $result_getUser['id'] ?>"><i class="fas fa-edit fa-fw"></i>
                                                            </button>
                                                        </form>&emsp;
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
                </div>
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

    <!-- dataTable js -->
    <script src="<?=$assets?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=$assets?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#usersTable').DataTable();
        });
    </script>
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