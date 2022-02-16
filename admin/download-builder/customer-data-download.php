<?php
require_once '../../core/init.php';
include("../../core/SimpleXLSXGen.php");

$users = [
	['No', 'Nama Lengkap', 'No HP / WA', 'Email', 'Status Member', 'Kendaraan']
];

$query = "SELECT * FROM customers";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
	foreach ($result as $row) {
		$ownerid = $row['id'];
		$query2 = "SELECT * FROM vehicles WHERE owner_id = '$ownerid'";
		$result2 = mysqli_query($link, $query2);
		while ($vehicle = mysqli_fetch_assoc($result2)) {
			$vehicles .= $vehicle['platnomor'] . ', ';
		}
		$id++;
		$users = array_merge(
			$users,
			array(
				array(
					$id,
					$row['fullname'],
					$row['phone'],
					$row['email'],
					$row['membership'],
					substr($vehicles, 0, -2)
				)
			)
		);
		$vehicles = '';
	}
}

$xlsx = SimpleXLSXGen::fromArray($users);
$xlsx->downloadAs('customers.xlsx');
?>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->