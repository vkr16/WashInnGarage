<?php 

require_once '../../core/init.php';

if (isset($_POST['changepass'])) {
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	$id      = $_POST['userid'];

	if (isOldPassValid($id,$oldpass)) {
		if (updatePassword($id, $newpass)) {
			setcookie('returnstatus', 'passchanged', time() + (10), "/");
			header("Location: ../my-account.php");
		}
	}else{
		setcookie('returnstatus', 'oldinvalid', time() + (10), "/");
		header("Location: ../my-account.php");
	}
}else{
	header("Location: ../my-account.php");
}

 ?>