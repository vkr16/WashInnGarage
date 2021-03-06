<?php
require_once '../../core/init.php';

if (isset($_POST['getActiveTrx'])) {
    // ambil data dari table transactions
    $query_getActiveTrx = "SELECT * FROM transactions WHERE trx_status = 'active'";
    $execute_getActiveTrx = mysqli_query($link, $query_getActiveTrx);
    $activeTrxCounter = mysqli_num_rows($execute_getActiveTrx);
    if ($activeTrxCounter == 0) {
        echo '<tr>
    <td colspan="8" class="text-center font-weight-bold text-lg">- No Active Transaction -</td>
</tr>';
    }


    while ($activeTrx = mysqli_fetch_assoc($execute_getActiveTrx)) {

        // ambil data dari table orders
        $activeTrxId = $activeTrx['id'];
        $query_getActiveOrder = "SELECT * FROM orders WHERE trx_id = '$activeTrxId'";
        $execute_getActiveOrder = mysqli_query($link, $query_getActiveOrder);
        $activeOrder = mysqli_fetch_assoc($execute_getActiveOrder);

        // ambil data dari table menus
        $menuId = $activeOrder['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $orderedMenu = mysqli_fetch_assoc($execute_getOrderedMenu);
        $progress = $activeTrx['progress'];
        $worker = $activeTrx['crew'];

        if ($progress == 'waiting') {
            $progressindicator = 'fa-hourglass-half text-primary';
        } elseif ($progress == 'working') {
            $progressindicator = 'fa-cog text-primary fa-spin';
        } elseif ($progress == 'finished') {
            $progressindicator = 'fa-check-circle text-success';
        }

        echo '<tr>
            <td>' . $activeTrx['invoice_number'] . '</td>
            <td>' . $activeTrx['customer_name'] . '</td>
            <td>' . $activeOrder['customer_phone'] . '</td>
            <td>' . $orderedMenu['category'] . '</td>
            <td>' . $activeOrder['platnomor'] . '</td>
            <td><i class="fas ' . $progressindicator . ' fa-fw"></i>&emsp;<button class="btn btn-info btn-sm" onclick="viewActiveTrxDetail(\'' . $activeTrx['invoice_number'] . '\')">Detail</button></td>
        </tr>';
    }
} else {
    header("Location:../index.php");
}
?>

<script>
    document.getElementById("activeTrxCounter").innerHTML = ' <?= $activeTrxCounter ?> ';
</script>