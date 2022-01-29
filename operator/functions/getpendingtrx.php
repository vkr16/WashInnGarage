<?php
require_once '../../core/init.php';

if (isset($_POST['getPendingTrx'])) {
    // ambil data dari table transactions
    $query_getPendingTrx = "SELECT * FROM transactions WHERE trx_status = 'unconfirmed'";
    $execute_getPendingTrx = mysqli_query($link, $query_getPendingTrx);
    $pendingTrxCounter = mysqli_num_rows($execute_getPendingTrx);
    if ($pendingTrxCounter == 0) {
        echo '<tr>
    <td colspan="8" class="text-center font-weight-bold text-lg">- No Pending Request -</td>
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
            <td>' . $pendingTrx['invoice_number'] . '</td>
            <td>' . $pendingTrx['customer_name'] . '</td>
            <td>' . $pendingOrder['customer_phone'] . '</td>
            <td>' . $orderedMenu['category'] . '</td>
            <td>' . $pendingOrder['platnomor'] . '</td>
            <td>' . $orderedMenu['name'] . '</td>
            <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelPendingTrxModal" onclick="deletePendingTrxCopyInv(\'' . $pendingTrx['invoice_number'] . '\',\'' . $pendingOrder['customer_name'] . '\')">Cancel</button></td>
            <td><button class="btn btn-primary btn-sm" onclick="confirmPendingTrx(\'' . $pendingTrx['invoice_number'] . '\')">Confirm</button></td>
        </tr>';
    }
} else {
    header("Location:../index.php");
}
?>

<script>
    document.getElementById("pendingTrxCounter").innerHTML = ' <?= $pendingTrxCounter ?> ';
</script>