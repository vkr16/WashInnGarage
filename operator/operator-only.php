<?php 

require_once '../core/init.php';

if (isset($_SESSION['wig_user'])) {
	$username = $_SESSION['wig_user'];
	if (checkRole($username) != 'operator') {
		header("Location: ".$home."/admin/");
	}
}else{
	header("Location: ".$home."/login.php");
}

?>