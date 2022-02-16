<?php
require_once "../../core/init.php";
if (isset($_POST['hiddenServiceID'])) {
	$id                    = $_POST['hiddenServiceID'];
	$origin                = $_POST['origin'];
	$query_getMenuItemInfo = "SELECT * FROM menus WHERE id = $id";
	$item                  = mysqli_fetch_assoc(mysqli_query($link, $query_getMenuItemInfo));
	$query_deleteItem      = "DELETE FROM menus WHERE id = $id";
	if (mysqli_query($link, $query_deleteItem)) {
		unlink('../../assets/img/thumbnail/' . $item['image']);
		setcookie('returnstatus', 'servicedeleted', time() + (10), "/");
		header("Location: ../" . $origin);
	} else {
		setcookie('returnstatus', 'servicenotdeleted', time() + (10), "/");
		header("Location: ../" . $origin);
	}
}
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