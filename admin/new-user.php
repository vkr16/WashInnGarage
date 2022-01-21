<?php 

require_once "admin-only.php";

$activePageLvl=1;



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Add New User Account</title>

 	<link rel="icon" type="image/png" href="<?=$assets?>/img/logo.png">
	<link rel="stylesheet" type="text/css" href="<?=$assets?>/css/sb-admin-2.min.css">
	<link href="<?=$assets?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                        <!-- <a target="_blank" href="download-builder/user-data-download.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download User Data</a> -->
                    </div>

                    <!-- Content Row -->


                    <!-- User Manager -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h5 class="m-0 font-weight-bold text-primary">Add New User</h5>
                                <!-- <a href="new-user.php" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> New User</a> -->
                                
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                               <form action="functions/add-user.php" method="post">
								  <div class="form-row">
								    <div class="form-group col-md-6">
								      <label for="inputFullname">Nama Lengkap</label>
								      <input autocomplete="off" type="text" class="form-control" id="inputFullname" placeholder="Nama Lengkap" aria-describedby="fullnameHelp" onfocus="fullnameFocus()" onblur="fullnameBlur()" required name="fullname">
								      <small id="fullnameHelp" class="form-text ml-3 text-muted" hidden>
									  <li>Harap isi dengan nama lengkap pengguna</li>
									  </small>
								    </div>
								    <div class="form-group col-md-6">
								      <label for="inputUsername">Username</label>
								      <input autocomplete="off" type="text" class="form-control" id="inputUsername" placeholder="Username" aria-describedby="usernameHelp" onfocus="usernameFocus()" onblur="usernameBlur()" required name="username">
								      <small id="usernameHelp" class="form-text ml-3 text-muted" hidden>
									  <li>Username dapat berupa kombinasi huruf besar maupun kecil dan angka</li>
									  <li>Contoh : johndoe, johndoe123, atau JanneDoe</li>
									  <li>Harap hanya gunakan format yang disarankan</li>
									  </small>
								    </div>
								  </div>
								  <div class="form-row">
								    <div class="form-group  col-md-6">
								    <label for="inputEmail">Email</label>
								    <input autocomplete="off" type="email" class="form-control" id="inputEmail" placeholder="Email" aria-describedby="emailHelp" onfocus="emailFocus()" onblur="emailBlur()" required name="email">
								    <small id="emailHelp" class="form-text ml-3 text-muted" hidden>
									  <li>Harap gunakan alamat email yang valid dan aktif</li>
									  <li>Email akan digunakan untuk mengirimkan password dan keperluan recovery</li>
									</small>
								  </div>
								    <div class="form-group col-md-6">
								      <label for="inputPhoneNumber">No. Telepon / WhatsApp   <small>(Opsional)</small></label>
								      <input autocomplete="off" type="text" class="form-control" id="inputPhoneNumber" placeholder="Nomor Telepon" aria-describedby="phoneHelp" onfocus="phoneFocus()" onblur="phoneBlur()" name="phone">
								    <small id="phoneHelp" class="form-text ml-3 text-muted" hidden>
								      <li>Harap gunakan format internasional, contoh : 6281234567890</li>
									  <li>Atau dapat dikosongkan jika tidak diperlukan</li>
									</small>
								    </div>
								  </div>
								  
								  <div class="form-row">
								    <div class="form-group col-md-4">
								      <label for="inputRole">Role</label>
								      <select id="inputRole" class="form-control" name="role">
								        <option selected value="operator">Operator (Default)</option>
								        <option value="admin">Administrator</option>
								      </select>
								    </div>
								  </div>
								  <br>
								  <div class="form-row">
								  	<div class="form-group">
								  		<a href="manage-user.php" class="btn btn-secondary" style=""><i class="fas fa-chevron-left fa-fw"></i> Kembali </a>
								  	</div>
									  <div class="form-group col-md-2">
										  <button type="submit" name="btnAddUser" class="btn btn-primary" style="width:100%">Simpan <i class="fas fa-save fa-fw"></i></button>
									  </div>
								  </div>
								</form>                                
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



	<!-- Bootstrap core JavaScript-->
    <script src="<?=$assets?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$assets?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$assets?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$assets?>/js/sb-admin-2.min.js"></script>

</body>
</html>

<script type="text/javascript">
	
	function fullnameFocus(){
		document.getElementById("fullnameHelp").hidden = false;
	}

	function fullnameBlur(){
		document.getElementById("fullnameHelp").hidden = true;
	}


	function usernameFocus(){
		document.getElementById("usernameHelp").hidden = false;
	}

	function usernameBlur(){
		document.getElementById("usernameHelp").hidden = true;
	}


	function emailFocus(){
		document.getElementById("emailHelp").hidden = false;
	}

	function emailBlur(){
		document.getElementById("emailHelp").hidden = true;
	}


	function phoneFocus(){
		document.getElementById("phoneHelp").hidden = false;
	}

	function phoneBlur(){
		document.getElementById("phoneHelp").hidden = true;
	}

</script>