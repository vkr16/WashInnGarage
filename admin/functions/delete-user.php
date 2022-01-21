<?php 
	require_once "../../core/init.php";

	if (isset($_POST['btnDelete'])) {
		$user2delete = $_POST['btnDelete'];
		$query_deleteUser = "DELETE FROM users WHERE id = $user2delete";
		if ($execute_deleteUser = mysqli_query($link,$query_deleteUser)) {
            setcookie('returnstatus', 'deletesuccess', time() + (10), "/");
			header("Location: ../manage-user.php");
		}
	}else{
			header("Location: ../manage-user.php");
	}
 ?>