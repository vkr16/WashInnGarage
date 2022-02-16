<?php
require_once '../../core/init.php';
if (isset($_POST['completeTrxInvoice'])) {
    $points                = 0;
    $invoice               = $_POST['completeTrxInvoice'];
    $query_getTrxData      = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData    = mysqli_query($link, $query_getTrxData);
    $trxData               = mysqli_fetch_assoc($execute_getTrxData);
    $trx_id                = $trxData['id'];
    $receiptnumber         = $trxData['receipt_number'];
    $query_getOrdersData   = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status = 'completed'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);
    while ($ordersData = mysqli_fetch_assoc($execute_getOrdersData)) {
        $menuId                 = $ordersData['menu_id'];
        $query_getOrderedMenu   = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $menuData               = mysqli_fetch_assoc($execute_getOrderedMenu);
        $menupoin               = $menuData['poin'];
        $orderqty               = $ordersData['amount'];
        $pointpermenu           = $menupoin * $orderqty;
        $customername           = $ordersData['customer_name'];
        $customerphone          = $ordersData['customer_phone'];
        $platnomor              = $ordersData['platnomor'];
        $customer_id            = $ordersData['customer_id'];
        $points                 = $points + $pointpermenu;
    }
    $query_getMembershipStatus   = "SELECT * FROM customers WHERE id = '$customer_id'";
    $execute_getMembershipStatus = mysqli_query($link, $query_getMembershipStatus);
    $membershipStatus            = mysqli_fetch_assoc($execute_getMembershipStatus);
    $customerStatus              = $membershipStatus['membership'];
    if ($customerStatus == 'member') {
?>
        <script>
            document.getElementById("containerpoints").hidden = false;
            document.getElementById("ctdearnedpoints").innerHTML = <?= $points ?>;
        </script>';
    <?php
    } else {
    ?>
        <script>
            document.getElementById("containerpoints").hidden = true;
            document.getElementById("ctdearnedpoints").innerHTML = "";
        </script>';
<?php
    }
}
?>

<script>
    document.getElementById("ctdcustomername").innerHTML = '<?= $customername ?>';
    document.getElementById("ctdcustomerphone").innerHTML = '<?= $customerphone ?>';
    document.getElementById("ctdplatnomor").innerHTML = '<?= $platnomor ?>';
    document.getElementById("ctdinvoicenumber").innerHTML = '<?= $invoice ?>';
    document.getElementById("ctdinvoicenumber2").value = '<?= $invoice ?>';
    document.getElementById("ctdreceiptnumber").innerHTML = '<?= $receiptnumber ?>';
    document.getElementById("apiwalink").innerHTML = 'https://wa.me/' + <?= $customerphone ?>;
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