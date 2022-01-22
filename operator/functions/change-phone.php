<?php 
	
	require_once '../../core/init.php';

	if (isset($_POST['btnChangePhone'])) {
		$id = $_POST['userid'];
		$phone = $_POST['newphone'];
		if (updatePhone($id,$phone)) {
			setcookie('returnstatus', 'phonechanged', time() + (10), "/");
			header("Location: ../my-account.php");
		}else{
			setcookie('returnstatus', 'phonechangeerror', time() + (10), "/");
			header("Location: ../my-account.php");
		}
	}else{
		header("Location: ../my-account.php");
	}
 ?>