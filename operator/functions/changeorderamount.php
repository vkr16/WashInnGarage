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

            $menuID = $getOrder['menu_id'];
            $query_getMenu = "SELECT * FROM menus WHERE id = '$menuID'";
            $execute_getMenu = mysqli_query($link, $query_getMenu);
            $Menu = mysqli_fetch_assoc($execute_getMenu);

            if ($Menu['type'] != 'service' && $Menu['type'] != 'promotion') {
                $query_setStock = "UPDATE menus SET stock = stock + 1 WHERE id = '$menuID'";
                $execute_setStock = mysqli_query($link, $query_setStock);

                $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
                $execute_updateAmount = mysqli_query($link, $query_updateAmount);

                $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
                $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
                $getOrder = mysqli_fetch_assoc($execute_getOrder2);
                $amount = $getOrder['amount'];
                echo $amount;
            } else {
                $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
                $execute_updateAmount = mysqli_query($link, $query_updateAmount);

                $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
                $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
                $getOrder = mysqli_fetch_assoc($execute_getOrder2);
                $amount = $getOrder['amount'];
                echo $amount;
            }
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


        $menuID = $getOrder['menu_id'];
        $query_getMenu = "SELECT * FROM menus WHERE id = '$menuID'";
        $execute_getMenu = mysqli_query($link, $query_getMenu);
        $Menu = mysqli_fetch_assoc($execute_getMenu);

        if ($Menu['type'] != 'service' && $Menu['type'] != 'promotion') {
            if ($Menu['stock'] > 0) {
                $query_setStock = "UPDATE menus SET stock = stock - 1 WHERE id = '$menuID'";
                $execute_setStock = mysqli_query($link, $query_setStock);

                $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
                $execute_updateAmount = mysqli_query($link, $query_updateAmount);

                $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
                $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
                $getOrder = mysqli_fetch_assoc($execute_getOrder2);
                $amount = $getOrder['amount'];
                echo $amount;
            } else {
                echo "<script>alert('Out Of Stock!!, That\'s the last one')</script>";
                echo $oldAmount;
            }
        } else {
            $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
            $execute_updateAmount = mysqli_query($link, $query_updateAmount);

            $query_getOrder2 = "SELECT * FROM orders WHERE id = '$orderID'";
            $execute_getOrder2 = mysqli_query($link, $query_getOrder2);
            $getOrder = mysqli_fetch_assoc($execute_getOrder2);
            $amount = $getOrder['amount'];
            echo $amount;
        }
    }
}
