<?php 
	require_once "../../core/init.php";

	if (isset($_POST['hiddenServiceID'])) {
		$id = $_POST['hiddenServiceID'];

		$query_getServiceInfo = "SELECT * FROM menus WHERE id = $id";
		$service = mysqli_fetch_assoc(mysqli_query($link, $query_getServiceInfo));


		$query_deleteService = "DELETE FROM menus WHERE id = $id";

		if (mysqli_query($link, $query_deleteService)) {
			unlink('../../assets/img/thumbnail/'.$service['image']);
			setcookie('returnstatus', 'servicedeleted', time() + (10), "/");
			header("Location: ../service-menu.php");
		}else{
			setcookie('returnstatus', 'servicenotdeleted', time() + (10), "/");
			header("Location: ../service-menu.php");
		}

	}

 ?>