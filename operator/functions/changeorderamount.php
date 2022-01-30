<?php
require_once '../../core/init.php';

if (isset($_POST['doMinus'])) {
    if (isset($_POST['order_id'])) {
        $orderID = $_POST['order_id'];

        $query_getOrder = "SELECT * FROM orders WHERE id = '$orderID'";
        $execute_getOrder = mysqli_query($link, $query_getOrder);
        $getOrder = mysqli_fetch_assoc($execute_getOrder);
        $oldAmount = $getOrder['amount'];
        if ($oldAmount > 1) {
            $newAmount =  $getOrder['amount'] - 1;

            $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
            $execute_updateAmount = mysqli_query($link, $query_updateAmount);

            $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
            $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
            $getOrder = mysqli_fetch_assoc($execute_getOrder2);
            $amount = $getOrder['amount'];
            echo $amount;
        } else {
            echo $oldAmount;
        }
    }
} elseif (isset($_POST['doPlus'])) {
    if (isset($_POST['order_id'])) {
        $orderID = $_POST['order_id'];

        $query_getOrder = "SELECT * FROM orders WHERE id = '$orderID'";
        $execute_getOrder = mysqli_query($link, $query_getOrder);
        $getOrder = mysqli_fetch_assoc($execute_getOrder);
        $oldAmount = $getOrder['amount'];
        $newAmount =  $getOrder['amount'] + 1;

        $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
        $execute_updateAmount = mysqli_query($link, $query_updateAmount);

        $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
        $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
        $getOrder = mysqli_fetch_assoc($execute_getOrder2);
        $amount = $getOrder['amount'];
        echo $amount;
    }
}
