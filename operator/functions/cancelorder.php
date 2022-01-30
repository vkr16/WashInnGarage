<?php
require_once '../../core/init.php';

if (isset($_POST['invoice_number']) && isset($_POST['order_id'])) {

    $invoice = $_POST['invoice_number'];
    $orderID = $_POST['order_id'];
    echo $invoice . $orderID;

    $query_getTrxID = "SELECT id FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxID = mysqli_query($link, $query_getTrxID);
    $trxIdArray = mysqli_fetch_assoc($execute_getTrxID);
    $trxID = $trxIdArray['id'];

    $query_getTrxOrders = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'active'";
    $execute_getTrxOrders = mysqli_query($link, $query_getTrxOrders);
    $count_trxOrders = mysqli_num_rows($execute_getTrxOrders);
    echo $count_trxOrders;

    if ($count_trxOrders > 1) {
        $query_cancelOrder = "UPDATE orders SET order_status = 'canceled' WHERE id = '$orderID'";
        $execute_cancelOrder = mysqli_query($link, $query_cancelOrder);
    }
}
