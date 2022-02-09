<?php

require_once '../../core/init.php';
$total = 0;

if (isset($_POST['invoice_number'])) {
    $invoice = $_POST['invoice_number'];

    $query_getTrxData = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData = mysqli_query($link, $query_getTrxData);
    $trxData = mysqli_fetch_assoc($execute_getTrxData);

    $trx_id = $trxData['id'];

    $query_getOrdersData = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status ='active'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);
    $count_ordersData = mysqli_num_rows($execute_getOrdersData);

    while ($ordersData = mysqli_fetch_assoc($execute_getOrdersData)) {

        $menuId = $ordersData['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $menuData = mysqli_fetch_assoc($execute_getOrderedMenu);
        $menuType = $menuData['type'];
        $priceeach = $menuData['price'];
        $subtotal = $priceeach * $ordersData['amount'];
        $total = $total + $subtotal;
?>
        <tr>
            <td style="width: 50%"><small><a role="button"><?php echo ($count_ordersData > 1) ? '<i role="button" class="fas fa-times fa-fw fw-sm" onclick="cancelOrder(\'' . $ordersData['id'] . '\',\'' . $invoice . '\')"> </i>' : ''; ?></a> <?= $menuData['name'] ?></small></td>
            <?php
            if ($menuType == 'promotion') {
            ?>
                <td class="text-center"><small><span id="<?= 'amountof' . $ordersData['id'] ?>"><?= $ordersData['amount'] ?></span></small></td>
            <?php
            } else {
            ?>
                <td class="text-center"><small><a role="button" onclick="minusOrder('<?= $ordersData['id'] ?>','<?= $invoice ?>')"><i class="fas fa-minus-square fa-fw fw-sm"></i>&emsp;</a><span id="<?= 'amountof' . $ordersData['id'] ?>"><?= $ordersData['amount'] ?></span><a role="button" onclick="plusOrder('<?= $ordersData['id'] ?>','<?= $invoice ?>')">&emsp;<i class="fas fa-plus-square fa-fw fw-sm"> </i></a></small></td>
            <?php } ?>
            <td class="text-right"><small><?= 'Rp ' . number_format($subtotal, 0, ',', '.')  ?></small></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td></td>
        <td class="text-center"><strong>Total : </strong></td>
        <td class="text-right"><small><?= 'Rp ' . number_format($total, 0, ',', '.')  ?></small></td>
    </tr>
<?php

} else {
    // ngapain kesini
}
?>