<?php
require_once "../../core/init.php";



if (isset($_POST['btnUpdateService'])) {
    $fullname = $_POST['customername'];
    $phone = $_POST['customerphone'];
    $email = $_POST['customeremail'];
    $points = $_POST['memberpoint'];
    $id          = $_POST['serviceidhidden'];

    $fullname = rm_special_char($fullname);
    $phone = rm_special_char($phone);
    $points = rm_special_char($points);
    $email = rm_some_special_char($email);

    $currentdata = mysqli_query($link, "SELECT * FROM customers WHERE id = '$id'");
    $match = mysqli_num_rows($currentdata);

    $query_updateCustomer = "UPDATE customers SET fullname = '$fullname', phone = '$phone', email = '$email', membership_point = '$points'  WHERE id = '$id'";
    if (mysqli_query($link, $query_updateCustomer)) {
        setcookie('returnstatus', 'serviceupdated', time() + (10), "/");
        header("Location: ../customer-data.php");
    } else {
        setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
        header("Location: ../customer-data.php");
    }
} else {
    header("Location: ../customer-data.php");
}
