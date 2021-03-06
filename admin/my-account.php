<?php
require_once "admin-only.php";
$activePageLvl = 99;
$username = $_SESSION['wig_user'];
$data = getUserByUsername($username);
$fullname = $data['fullname'];
$username = $data['username'];
$email = $data['email'];
$phone = $data['phone'];
$role = $data['role'];
$role = ($role == 'admin') ? 'Administrator' : 'Operator';
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit User Information</title>

	<link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
	<link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
	<link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body class="page-top">
	<div id="wrapper">
		<?php require_once 'view-template/sidebar.php'; ?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php require_once 'view-template/topbar.php'; ?>
				<div class="container-fluid">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Account Management</h1>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6">
							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle fa-fw"></i> Account Information</h5>
								</div>
								<div class="card-body">
									<h5 class="text-dark mb-0"><?= $fullname ?> (<?= $username ?>)</h5>
									<small>System <?= $role ?> &nbsp;<i class="fas fa-user-tag fa-fw fa-sm"></i></small>
									<hr>
									<p><i class="fas fa-envelope fa-fw"></i> <?= $email ?></p>
									<p><i class="fas fa-mobile-alt fa-fw"></i> <?= $phone ?> <small onclick="showeditpane()"><a href="#">(Click to edit)</a></small></p>
								</div>
							</div>

							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-envelope fa-fw"></i> Update Email Address</h5>
								</div>
								<div class="card-body">
									<form action="functions/change-email.php" name="formchangemail" method="post">

										<?php if (isset($_COOKIE['EmChVeCo']) && isset($_COOKIE['NeEmA'])) {
											echo '<div class="form-group">
											    <p>Verification code has been sent to ' . $_COOKIE['NeEmA'] . '. If you can\'t find it please check the spam folder.</p><hr>
				                        		<label>Verification Code</label>
											    <input type="text" class="form-control" id="otpcode" name="otpcode" placeholder="Verification Code" required autocomplete="off">
			                        		</div>
											<div class="form-group mt-3">
											    <input type="text" name="userid" hidden value="' . $data['id'] . '">
												<a href="functions/dropverification.php" class="btn btn-secondary">Cancel</a>
												<input class="btn btn-primary" type="submit" id="btnChangeEmail" required name="btnChangeEmail" value="Submit Verification">
											</div>';
										} else {
											echo '<div class="form-group">
						                        	<label>New Email Address</label>
													<input type="text" class="form-control" id="newemail" name="newemail" placeholder="New Email Address" onkeyup="ValidateEmail(document.formchangemail.newemail)" required autocomplete="off">
			   			                     	</div>
												<div class="form-group mt-3">
													<small class="text-danger" id="mailformatalert" hidden> &emsp;Email Format Incomplete or Invalid <i class="fas fa-exclamation-triangle fa-fw"></i><br><br></small>
												    <input type="text" name="userid" hidden value="' . $data['id'] . '">
													<input class="btn btn-primary" type="submit" id="btnChangeEmail" disabled name="btnChangeEmail" value="Request Verification">
												</div>';
										}
										?>
									</form>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6">
							<div>
								<?php
								if (isset($_COOKIE['returnstatus'])) {
									if ($_COOKIE['returnstatus'] == 'passchanged') {
										echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Password Updated. </strong>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'oldinvalid') {
										echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Failed To Change Password.<br>Error</strong> : Current password incorrect.
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'otpsent') {
										echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
												<strong>Verification Code Sent To ' . $_COOKIE['NeEmA'] . '.<br><i class="far fa-lightbulb fa-fw"></i> </strong> If you can\'t find the email, check your spam folder.
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'otpmismatch') {
										echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Verification Failed.<br>Error : </strong> Verification code incorrect!
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'emailupdatedsuccess') {
										echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Email Updated Successfully.</strong> 
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'phonechanged') {
										echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Phone Number Updated Successfully.</strong> 
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									} elseif ($_COOKIE['returnstatus'] == 'phonechangeerror') {
										echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Phone Number Update Failed!! <br> Error : </strong>Unknown error, please try again. <br><hr>If error continue please contact developer.  [ERR-458]
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>';
									}
								}
								?>
							</div>

							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-key fa-fw"></i> Update Password</h5>
								</div>
								<div class="card-body">
									<form action="functions/change-pass.php" method="post">
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Current Password" required autocomplete="off">
										</div>
										<div class="row">
											<div class="col">
												<label>New Password</label>
												<input type="password" class="form-control" onkeyup="equal_checker()" id="newpass" name="newpass" placeholder="New Password" required autocomplete="off">
											</div>
											<div class="col">
												<label>Confirm New Password</label>
												<input type="password" class="form-control" onkeyup="equal_checker()" id="newpass2" name="newpass2" placeholder="Confirm New Password" required autocomplete="off">
											</div>
										</div>
										<div class="form-group mt-3">
											<small class="text-danger" id="matchalert" hidden>&emsp;New Password Doesn't Match <i class="fas fa-exclamation-triangle fa-fw fa-sm"></i><br><br> </small>
											<input type="text" name="userid" hidden value="<?= $data['id'] ?>">
											<input class="btn btn-primary" type="submit" id="btnChangePass" disabled name="changepass" value="Change Password">
										</div>
									</form>
								</div>
							</div>
							<div class="card shadow mb-4" id="editphonepane" hidden>
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-mobile-alt fa-fw"></i> Update Phone Number</h5>
								</div>
								<div class="card-body">
									<form action="functions/change-phone.php" method="post">
										<div class="form-group">
											<label>New Phone Number</label>
											<input type="text" class="form-control" id="newphone" name="newphone" placeholder="New Phone Number" required autocomplete="off">
										</div>
										<div class="form-group mt-3">
											<input type="text" name="userid" hidden value="<?= $data['id'] ?>">
											<input class="btn btn-primary" type="submit" id="btnChangePhone" name="btnChangePhone" value="Update Phone Number">
										</div>
									</form>
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

<script type="text/javascript">
	function equal_checker() {
		if (document.getElementById("newpass").value == document.getElementById("newpass2").value && document.getElementById("newpass").value != '') {
			document.getElementById("btnChangePass").disabled = false;
			document.getElementById("matchalert").hidden = true;
		} else {
			document.getElementById("btnChangePass").disabled = true;
			document.getElementById("matchalert").hidden = false;
		}
	}

	function ValidateEmail(newemail) {
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (newemail.value.match(mailformat)) {
			document.getElementById("mailformatalert").hidden = true;
			document.getElementById("btnChangeEmail").disabled = false;

			return true;
		} else {
			document.getElementById("mailformatalert").hidden = false;
			document.getElementById("btnChangeEmail").disabled = true;
			return false;
		}
	}

	function showeditpane() {
		document.getElementById("editphonepane").hidden = false;
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