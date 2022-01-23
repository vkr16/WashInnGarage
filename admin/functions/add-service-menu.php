<?php 

	require_once "../../core/init.php";

	if (isset($_POST['btnAddServiceMenu'])) {
		$servicename = $_POST['servicename'];
		$category = $_POST['category'];
		$price = $_POST['serviceprice'];
		$description = $_POST['servicedesc'];
		if (isset($_POST['activate'])) {
			$status = $_POST['activate'];
		}else{
			$status = 'off';
		}

		var_dump($servicename,$category,$price,$description,$status);




		if (!empty($_FILES['thumbnail'])) {
			$path = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
			$path2 = $_FILES['thumbnail']['name'];
			$ext = pathinfo($path2, PATHINFO_EXTENSION);
			$path = $path . $servicename . '.' . $ext;
			echo $path;

			if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
				echo "dah nih";
			} else {
				echo "There was an error uploading the file, please try again!";
			}
		}else{
			echo "kosong tuh?";
		}
	}

 ?>