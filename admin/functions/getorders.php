<?php
require_once '../../core/init.php';
$total = 0;
if (isset($_POST['invoice_number'])) {
    $invoice               = $_POST['invoice_number'];
    $query_getTrxData      = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData    = mysqli_query($link, $query_getTrxData);
    $trxData               = mysqli_fetch_assoc($execute_getTrxData);
    $trx_id                = $trxData['id'];
    $query_getOrdersData   = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status ='active'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);
    $count_ordersData      = mysqli_num_rows($execute_getOrdersData);
    while ($ordersData = mysqli_fetch_assoc($execute_getOrdersData)) {
        $menuId                 = $ordersData['menu_id'];
        $query_getOrderedMenu   = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $menuData               = mysqli_fetch_assoc($execute_getOrderedMenu);
        $menuType               = $menuData['type'];
        $priceeach              = $menuData['price'];
        $subtotal               = $priceeach * $ordersData['amount'];
        $total                  = $total + $subtotal;
?>
        <tr>
            <td><small><a role="button"><?php
                                        echo ($count_ordersData > 1) ? '<i role="button" class="fas fa-times fa-fw fw-sm" onclick="cancelOrder(\'' . $ordersData['id'] . '\',\'' . $invoice . '\')"> </i>' : '';
                                        ?></a> <?= $menuData['name'] ?></small></td>
            <?php
            if ($menuType == 'promotion') {
            ?>
                <td class="text-center"><small><span id="<?= 'amountof' . $ordersData['id'] ?>"><?= $ordersData['amount'] ?></span></small></td>
            <?php
            } else {
            ?>
                <td class="text-center"><small><span id="<?= 'amountof' . $ordersData['id'] ?>"><?= $ordersData['amount'] ?></span></small></td>
            <?php
            }
            ?>
            <td class="text-right"><small><?= 'Rp ' . number_format($subtotal, 0, ',', '.') ?></small></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td></td>
        <td class="text-center"><strong>Total : </strong></td>
        <td class="text-right"><small><?= 'Rp ' . number_format($total, 0, ',', '.') ?></small></td>
    </tr>
<?php
} else {
    echo "POST invoice_order NOT SET";
}
?>

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