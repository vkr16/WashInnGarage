<?php
require_once '../../core/init.php';


if (isset($_POST['invoice2cancel'])) {
    $invoice2cancel = $_POST['invoice2cancel'];

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice2cancel'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trx_id = $trxDetail['id'];
    $query_getTrxOrder = "SELECT * FROM orders WHERE trx_id = '$trx_id'";
    $execute_getTrxOrder = mysqli_query($link, $query_getTrxOrder);
    $trxOrder = mysqli_fetch_assoc($execute_getTrxOrder);

    $query_updateTrx = "UPDATE transactions SET trx_status = 'canceled' WHERE id = '$trx_id'";
    $execute_updateTrx = mysqli_query($link, $query_updateTrx);

    $query_updateTrxOrder = "UPDATE orders SET order_status = 'canceled' WHERE trx_id = '$trx_id'";
    $execute_updateTrxOrder = mysqli_query($link, $query_updateTrxOrder);

    // header("Location:../index.php");
} else {
    header('HTTP/1.0 403 Forbidden');

    echo '<h1>403 FORBIDDEN!</h1>';
}
