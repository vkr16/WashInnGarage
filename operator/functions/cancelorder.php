<?php
require_once '../../core/init.php';

if (isset($_POST['invoice_number']) && isset($_POST['order_id'])) {

    $invoice = $_POST['invoice_number'];
    $orderID = $_POST['order_id'];
    // echo $invoice . $orderID;

    $query_getTrxID = "SELECT id FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxID = mysqli_query($link, $query_getTrxID);
    $trxIdArray = mysqli_fetch_assoc($execute_getTrxID);
    $trxID = $trxIdArray['id'];

    $query_getTrxOrders = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'active'";
    $execute_getTrxOrders = mysqli_query($link, $query_getTrxOrders);
    $TrxOrders = mysqli_fetch_assoc($execute_getTrxOrders);
    $count_trxOrders = mysqli_num_rows($execute_getTrxOrders);

    $query_getOrderDetail = "SELECT * FROM orders WHERE id = '$orderID' AND order_status = 'active'";
    $execute_getOrderDetail = mysqli_query($link, $query_getOrderDetail);
    $OrderDetail = mysqli_fetch_assoc($execute_getOrderDetail);
    // echo $count_trxOrders;

    $menuID = $OrderDetail['menu_id'];
    $query_getMenu = "SELECT * FROM menus WHERE id = '$menuID'";
    $execute_getMenu = mysqli_query($link, $query_getMenu);
    $Menu = mysqli_fetch_assoc($execute_getMenu);
    $stock = $Menu['stock'];
    $orderQty = $OrderDetail['amount'];
    $totalStock = $stock + $orderQty;
    var_dump($Menu);


    if ($count_trxOrders > 1) {
        if ($Menu['type'] != 'service' && $Menu['type'] != 'promotion') {
            $query_setStock = "UPDATE menus SET stock = '$totalStock'  WHERE id = '$menuID'";
            $execute_setStock = mysqli_query($link, $query_setStock);
        }
        echo "sampe ko kesini";
        $query_cancelOrder = "UPDATE orders SET order_status = 'canceled' WHERE id = '$orderID'";
        $execute_cancelOrder = mysqli_query($link, $query_cancelOrder);
    }
}
