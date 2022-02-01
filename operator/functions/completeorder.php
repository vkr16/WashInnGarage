<?php
require_once '../../core/init.php';

if (isset($_POST['completeorder'])) {

    $invoice = $_POST['invoice_number'];
    $receipt = $_POST['receipt'];
    $current_user = $_SESSION['wig_user'];
    $query_getOperator = "SELECT * FROM users WHERE username = '$current_user'";
    $execute_getOperator = mysqli_query($link, $query_getOperator);
    $operatorData = mysqli_fetch_assoc($execute_getOperator);
    $operator = $operatorData['fullname'];
    echo $operator;
    $today = date("Y-m-d");

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trx_id = $trxDetail['id'];

    $query_completeTrx = "UPDATE transactions SET trx_status = 'completed',completetime = '$today', receipt_number = '$receipt', operator_name = '$operator' WHERE invoice_number = '$invoice'";
    $execute_completeTrx = mysqli_query($link, $query_completeTrx);

    $query_completeOrder = "UPDATE orders SET order_status = 'completed' WHERE trx_id = '$trx_id' AND order_status = 'active'";
    $execute_completeOrder = mysqli_query($link, $query_completeOrder);
} else {
    echo base64_decode("TmdhcGFpbiBtYXMga2VzaW5pPz8/");
}
