<?php
require_once '../../core/init.php';

if (isset($_POST['getPendingorder'])) {
    // ambil data dari table transactions
    $query_getPendingTrx = "SELECT * FROM transactions WHERE trx_status = 'unconfirmed'";
    $execute_getPendingTrx = mysqli_query($link, $query_getPendingTrx);
    $pendingTrxCounter = mysqli_num_rows($execute_getPendingTrx);
    if ($pendingTrxCounter == 0) {
        echo '<tr>
    <td colspan="4" class="text-center">No Pending Request</td>
</tr>';
    }


    while ($pendingTrx = mysqli_fetch_assoc($execute_getPendingTrx)) {

        // ambil data dari table orders
        $pendingTrxId = $pendingTrx['id'];
        $query_getPendingOrder = "SELECT * FROM orders WHERE trx_id = '$pendingTrxId'";
        $execute_getPendingOrder = mysqli_query($link, $query_getPendingOrder);
        $pendingOrder = mysqli_fetch_assoc($execute_getPendingOrder);


        // ambil data dari table menus
        $menuId = $pendingOrder['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $orderedMenu = mysqli_fetch_assoc($execute_getOrderedMenu);

        echo '<tr>
            <th scope="row">' . $pendingTrx['invoice_number'] . '</th>
            <td>' . $pendingTrx['customer_name'] . '</td>
            <td>' . $orderedMenu['category'] . '</td>
            <td>' . $pendingOrder['platnomor'] . '</td>
            <td><button class="btn btn-primary btn-sm">Check</button></td>
        </tr>';
    }
} else {
    header("Location:../index.php");
}
?>

<script>
    document.getElementById("pendingTrxCounter").innerHTML = ' <?= $pendingTrxCounter ?> ';
</script>