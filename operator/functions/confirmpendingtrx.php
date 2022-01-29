<?php
require_once '../../core/init.php';

if (isset($_POST['pendingTrxInvoice'])) {
    $invoice = $_POST['pendingTrxInvoice'];

    $query_updateTrxStatus = "UPDATE transactions SET trx_status = 'active' WHERE invoice_number = '$invoice'";
    $execute_updateTrxStatus = mysqli_query($link, $query_updateTrxStatus);
}
