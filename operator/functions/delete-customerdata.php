<?php
require_once "../../core/init.php";

if (isset($_POST['hiddenServiceID'])) {
    $id = $_POST['hiddenServiceID'];
    $origin = $_POST['origin'];

    $query_getCustomerData = "SELECT * FROM customers WHERE id = '$id'";
    $CustomerData = mysqli_fetch_assoc(mysqli_query($link, $query_getCustomerData));


    $query_deleteItem = "DELETE FROM customers WHERE id = '$id'";

    if (mysqli_query($link, $query_deleteItem)) {
        $query_deleteVehicle = "DELETE FROM vehicles WHERE owner_id = '$id'";
        $execute_deleteVehicle = mysqli_query($link, $query_deleteVehicle);
        header("Location: ../" . $origin);
        setcookie('returnstatus', 'servicedeleted', time() + (10), "/");
    } else {
        setcookie('returnstatus', 'servicenotdeleted', time() + (10), "/");
        header("Location: ../" . $origin);
    }
}
