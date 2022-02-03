<?php

require_once '../../core/init.php';

if (isset($_POST['getearnings'])) {
    $today = date("Y-m-d");
    $total = 0;

    $query_getTrx = "SELECT * FROM transactions WHERE completedate = '$today'";
    $execute_getTrx = mysqli_query($link, $query_getTrx);

    while ($Trx = mysqli_fetch_assoc($execute_getTrx)) {
        $trxID = $Trx['id'];
        $query_getOrders = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'completed'";
        $execute_getOrders = mysqli_query($link, $query_getOrders);

        while ($Orders = mysqli_fetch_assoc($execute_getOrders)) {
            $qty = $Orders['amount'];
            $menuID = $Orders['menu_id'];

            $query_getMenu = "SELECT * FROM menus WHERE id = '$menuID'";
            $execute_getMenu = mysqli_query($link, $query_getMenu);
            $Menu = mysqli_fetch_assoc($execute_getMenu);
            $price = $Menu['price'];

            $thisOrderSubtotal = $price * $qty;
            $total = $total + $thisOrderSubtotal;
        }
    }
    echo 'Rp ' . number_format($total, 0, ',', '.');
}
