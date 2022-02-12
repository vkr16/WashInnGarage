<?php
require_once '../../core/init.php';

if (isset($_POST['getqueue'])) {


    $current_user = $_SESSION['wig_user'];
    $query_getActiveTrx = "SELECT * FROM transactions WHERE trx_status = 'active' AND progress = 'waiting'";
    $execute_getActiveTrx = mysqli_query($link, $query_getActiveTrx);
    $activeTrxCounter = mysqli_num_rows($execute_getActiveTrx);
    if ($activeTrxCounter == 0) {
        echo '<tr>
    <td colspan="8" class="text-center font-weight-bold text-lg">- No Active Queue -</td>
</tr>';
    }


    while ($activeTrx = mysqli_fetch_assoc($execute_getActiveTrx)) {

        // ambil data dari table orders
        $activeTrxId = $activeTrx['id'];
        $query_getActiveOrder = "SELECT * FROM orders WHERE trx_id = '$activeTrxId' AND order_status = 'active'";
        $execute_getActiveOrder = mysqli_query($link, $query_getActiveOrder);
        $activeOrder = mysqli_fetch_assoc($execute_getActiveOrder);

        // ambil data dari table menus
        $menuId = $activeOrder['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $orderedMenu = mysqli_fetch_assoc($execute_getOrderedMenu);
        $progress = $activeTrx['progress'];
        $worker = $activeTrx['crew'];

        if ($orderedMenu['category'] == 'Car') {
            $iconvehi = 'fas fa-car fa-fw  text-primary';
        } else {
            $iconvehi = 'fas fa-motorcycle fa-fw  text-primary';
        }

        if ($progress == 'waiting') {
            $progressindicator = 'fas fa-hourglass-half text-primary';
        } elseif ($progress == 'working') {
            $progressindicator = 'fas fa-cog text-primary fa-spin';
        } elseif ($progress == 'finished') {
            $progressindicator = 'fas fa-check-circle text-success';
        }

        echo '<tr role="button">
            <td class="text-dark font-weight-bold" onclick="openAction(\'' . $activeTrx['invoice_number'] . '\')"><i class="' . $iconvehi . '"></i>&nbsp;<i class="' . $progressindicator . ' text-primary"></i>&emsp;' . $activeOrder['platnomor'] . '' . '</td>
        </tr>';
    }
} else {
    header("Location:../index.php");
}
?>

<script>
    // document.getElementById("activeTrxCounter").innerHTML = ' <?= $activeTrxCounter ?> ';
</script>