<?php
require_once '../../core/init.php';

if (isset($_POST['addorder'])) {
    $menuID = $_POST['menuID'];
    $invoice = $_POST['invoice'];

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trxID = $trxDetail['id'];

    $query_getOrders = "SELECT * FROM orders WHERE menu_id = '$menuID' AND trx_id = '$trxID' AND order_status = 'active'";
    $execute_getOrders = mysqli_query($link, $query_getOrders);
    $orders = mysqli_fetch_assoc($execute_getOrders);

    $count_orders = mysqli_num_rows($execute_getOrders);
    if ($count_orders > 0) {
        $orderID = $orders['id'];
        $currentAmount = $orders['amount'];
        $newAmount = $currentAmount + 1;
        $query_updateAmount = "UPDATE orders SET amount = '$newAmount' WHERE id = '$orderID'";
        $execute_updateAmount = mysqli_query($link, $query_updateAmount);
    } else {
        $query_getOrders = "SELECT * FROM orders WHERE trx_id = '$trxID'";
        echo $trxID;
        $execute_getOrders = mysqli_query($link, $query_getOrders);
        $orders = mysqli_fetch_assoc($execute_getOrders);
        $customername = $orders['customer_name'];
        $customerphone = $orders['customer_phone'];
        $customeremail = $orders['customer_email'];
        $customerid = $orders['customer_id'];
        $platnomor = $orders['platnomor'];


        $query_addOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, customer_email, customer_id, menu_id, platnomor, order_status)
                                        VALUE ('$trxID','$customername','$customerphone', '$customeremail', '$customerid', '$menuID', '$platnomor', 'active')";

        $execute_addOrder = mysqli_query($link, $query_addOrder);
    }
}
