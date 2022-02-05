<?php
require_once '../../core/init.php';

if (isset($_POST['upgradebtn'])) {
    $id = $_POST['upgradebtn'];

    $query_upgrade = "UPDATE customers SET membership = 'member' WHERE id = '$id'";
    $execute_upgrade = mysqli_query($link, $query_upgrade);
    setcookie('returnstatus', 'serviceupdated', time() + (10), "/");

    header("Location:../customer-data.php");
}
