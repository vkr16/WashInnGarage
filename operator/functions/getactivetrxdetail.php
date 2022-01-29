<?php

require_once '../../core/init.php';
if (isset($_POST['activeTrxInvoice'])) {

    $invoice = $_POST['activeTrxInvoice'];

    $query_getTrxData = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData = mysqli_query($link, $query_getTrxData);
    $trxData = mysqli_fetch_assoc($execute_getTrxData);

    $trx_id = $trxData['id'];

    $query_getOrdersData = "SELECT * FROM orders WHERE trx_id = '$trx_id'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);

    $ordersData = mysqli_fetch_assoc($execute_getOrdersData);
    $customername = $ordersData['customer_name'];
    $customerphone = $ordersData['customer_phone'];
    $platnomor = $ordersData['platnomor'];

    # code...
}


?>

<script>
    document.getElementById("tdcustomername").innerHTML = '<?= $customername ?>';
    document.getElementById("tdcustomerphone").innerHTML = '<?= $customerphone ?>';
    document.getElementById("tdplatnomor").innerHTML = '<?= $platnomor ?>';
    document.getElementById("tdinvoicenumber").innerHTML = '<?= $invoice ?>';
</script>