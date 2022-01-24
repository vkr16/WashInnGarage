<?php 
	require_once '../../core/init.php';
	include("../../core/SimpleXLSXGen.php");

	$users = [
	    ['No', 'Nama Lengkap', 'Email', 'Phone', 'Username', 'Role' ]
	];

	$query = "SELECT * FROM users";
	$result = mysqli_query($link, $query);

	if (mysqli_num_rows($result) > 0) {
		foreach($result as $row){
			$id++;
			$users = array_merge
							($users, 
								array(
									array(
										$id, 
										$row['fullname'], 
										$row['email'], 
										$row['phone'], 
										$row['username'], 
										$row['role']
									)
								)
							);
		}
	}

	$xlsx = SimpleXLSXGen::fromArray( $users );
	$xlsx->downloadAs('users.xlsx');
?>