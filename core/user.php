<?php 

function isExist($username)
{
 	global $link;

 	$username = mysqli_real_escape_string($link, $username);

 	$query = "SELECT * FROM users WHERE username = '$username'";
 	if ($result = mysqli_query($link,$query) ) {
		if (mysqli_num_rows($result) != 0) {
			//User Found
			return true;
		}else {
			//User Not Found
			return false;
		}
	}
}


function isValid($username, $password)
{
	global $link;

	$username = mysqli_real_escape_string($link, $username);
	$password = mysqli_real_escape_string($link, $password);

	$query = "SELECT * FROM users WHERE username =  '$username'";

	$result = mysqli_query($link, $query);
	$hash 	= mysqli_fetch_assoc($result);

	if (password_verify($password, $hash['password'])) {
		return true;
	}else{
		return false;
	}
}

function checkRole($username)
{
	global $link;

	$username = mysqli_real_escape_string($link, $username);

	$query = "SELECT role FROM users WHERE username = '$username'";

	$result = mysqli_query($link, $query);
	$data 	= mysqli_fetch_assoc($result);
	
	return $data['role'];
}

 ?>