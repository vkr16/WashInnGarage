<?php 
		
	setcookie('EmChVeCo', $verif_string_encoded, time() - (300), "/");
	setcookie('NeEmA', $newemail, time() - (300), "/");

	header("Location: ../my-account.php");
 ?>