<?php
require_once '../../core/init.php';

if (isset($_POST['completeorder'])) {

    $invoice = $_POST['invoice_number'];

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trx_id = $trxDetail['id'];

    $query_completeTrx = "UPDATE transactions SET trx_status = 'completed' WHERE invoice_number = '$invoice'";
    $execute_completeTrx = mysqli_query($link, $query_completeTrx);

    $query_completeOrder = "UPDATE orders SET order_status = 'completed' WHERE trx_id = '$trx_id'";
    $execute_completeOrder = mysqli_query($link, $query_completeOrder);
} else {
    echo base64_decode("TmdhcGFpbiBtYXMga2VzaW5pPz8/");
}
