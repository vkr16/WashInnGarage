<?php
require_once '../../core/init.php';
if (isset($_POST['activeTrxInvoice'])) {
    $invoice                 = $_POST['activeTrxInvoice'];
    $query_getTrxData        = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData      = mysqli_query($link, $query_getTrxData);
    $trxData                 = mysqli_fetch_assoc($execute_getTrxData);
    $trx_id                  = $trxData['id'];
    $query_getOrdersData     = "SELECT * FROM orders WHERE trx_id = '$trx_id'";
    $execute_getOrdersData   = mysqli_query($link, $query_getOrdersData);
    $ordersData              = mysqli_fetch_assoc($execute_getOrdersData);
    $customer_id             = $ordersData['customer_id'];
    $query_getCustomerData   = "SELECT * FROM customers WHERE id = '$customer_id'";
    $execute_getCustomerData = mysqli_query($link, $query_getCustomerData);
    $customer                = mysqli_fetch_assoc($execute_getCustomerData);
    $customerpoint           = $customer['membership_point'];
    $customername            = $ordersData['customer_name'];
    $customerphone           = $ordersData['customer_phone'];
    $platnomor               = $ordersData['platnomor'];
}
?>

<script>
    document.getElementById("tdcustomername").innerHTML = '<?= $customername ?>';
    document.getElementById("tdcustomerphone").innerHTML = '<?= $customerphone ?>';
    document.getElementById("tdplatnomor").innerHTML = '<?= $platnomor ?>';
    document.getElementById("tdinvoicenumber").innerHTML = '<?= $invoice ?>';
    document.getElementById("tdcustomerpoint").innerHTML = '<?= $customerpoint ?>';
</script>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->