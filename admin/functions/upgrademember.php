<?php
require_once '../../core/init.php';

if (isset($_POST['custmail'])) {
    $id = $_POST['upgradebtn'];
    $email = $_POST['custmail'];

    $query_upgrade = "UPDATE customers SET membership = 'member' , email = '$email' WHERE id = '$id'";
    $execute_upgrade = mysqli_query($link, $query_upgrade);
    setcookie('returnstatus', 'serviceupdated', time() + (10), "/");

    header("Location:../customer-basic.php");
}
