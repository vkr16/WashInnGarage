<?php

require_once '../../core/init.php';
$total = 0;

if (isset($_POST['invoice_number'])) {
    $invoice = $_POST['invoice_number'];

    $query_getTrxData = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxData = mysqli_query($link, $query_getTrxData);
    $trxData = mysqli_fetch_assoc($execute_getTrxData);

    $trx_id = $trxData['id'];

    $query_getOrdersData = "SELECT * FROM orders WHERE trx_id = '$trx_id'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);

    while ($ordersData = mysqli_fetch_assoc($execute_getOrdersData)) {

        $menuId = $ordersData['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $menuData = mysqli_fetch_assoc($execute_getOrderedMenu);
        $priceeach = $menuData['price'];
        $subtotal = $priceeach * $ordersData['amount'];
        $total = $total + $subtotal;
?>
        <tr>
            <td><small><a role="button"><i class="fas fa-times fa-fw fw-sm"> </i></a> <?= $menuData['name'] ?></small></td>
            <td class="text-center"><small><a role="button" onclick="minusOrder('<?= $ordersData['id'] ?>','<?= $invoice ?>')"><i class="fas fa-minus-square fa-fw fw-sm"></i>&emsp;</a><span id="<?= 'amountof' . $ordersData['id'] ?>"><?= $ordersData['amount'] ?></span><a role="button" onclick="plusOrder('<?= $ordersData['id'] ?>','<?= $invoice ?>')">&emsp;<i class="fas fa-plus-square fa-fw fw-sm"> </i></a></small></td>
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

<script>
    document.getElementById("totalPriceOfTrx").innerHTML = ' <?= 'Rp ' . number_format($total, 0, ',', '.')  ?> ';
</script>