<?php
require_once "../../core/init.php";



if (isset($_POST['btnUpdateService'])) {
    $category = $_POST['category'];
    $platnomor = $_POST['platnomor'];
    $id          = $_POST['serviceidhidden'];

    $query_updateVehicle = "UPDATE vehicles SET vehicletype = '$category', platnomor = '$platnomor'  WHERE id = '$id'";
    if (mysqli_query($link, $query_updateVehicle)) {
        setcookie('returnstatus', 'serviceupdated', time() + (10), "/");
        header("Location: ../customer-vehicle.php");
    } else {
        setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
        header("Location: ../customer-vehicle.php");
    }
} elseif (isset($_POST['btnDeleteService'])) {
    $id          = $_POST['serviceidhidden'];
    $query_deleteVehicle = "DELETE FROM vehicles WHERE id = '$id'";

    if (mysqli_query($link, $query_deleteVehicle)) {
        setcookie('returnstatus', 'servicedeleted', time() + (10), "/");
        header("Location: ../customer-vehicle.php");
    } else {
        setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
        header("Location: ../customer-vehicle.php");
    }
} else {
    header("Location: ../customer-vehicle.php");
}
