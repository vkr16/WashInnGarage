<?php
require_once '../core/init.php';
if (isset($_SESSION['wig_user'])) {
    $username = $_SESSION['wig_user'];
    if (checkRole($username) != 'admin') {
        header("Location: " . $home . "/operator/");
    }
} else {
    header("Location: " . $home . "/login.php");
}
$current_user = $_SESSION['wig_user']
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