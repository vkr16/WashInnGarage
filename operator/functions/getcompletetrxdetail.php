<?php

require_once '../../core/init.php';
if (isset($_POST['completeTrxInvoice'])) {

    $invoice = $_POST['completeTrxInvoice'];

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
    document.getElementById("ctdcustomername").innerHTML = '<?= $customername ?>';
    document.getElementById("ctdcustomerphone").innerHTML = '<?= $customerphone ?>';
    document.getElementById("ctdplatnomor").innerHTML = '<?= $platnomor ?>';
    document.getElementById("ctdinvoicenumber").innerHTML = '<?= $invoice ?>';
    document.getElementById("wacustomer").href = 'https://wa.me/' + <?= $customerphone ?>;
</script>