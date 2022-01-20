<?php 

require_once '../../core/init.php';

$query_userData = "SELECT * FROM users";
$execute_userData = mysqli_query($link,$query_userData);




	header("Content-type: application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=Data Pegawai.xls");

	?>
	<table border="1">
	<?php
	while ($res = mysqli_fetch_assoc($execute_userData)) {?>
		 <tr>
		 	<td><?= $res['fullname'] ?></td>
		 </tr>
	<?php };
      
 ?>

</table>