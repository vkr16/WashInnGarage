<?php 

require_once '../core/init.php';

if (isset($_SESSION['wig_user'])) {
	$username = $_SESSION['wig_user'];
	if (checkRole($username) != 0) {
		header("Location: ".$home."/operator/");
	}
}else{
	header("Location: ".$home."/login.php");
}

?>