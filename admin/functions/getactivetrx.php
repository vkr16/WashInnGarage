<?php
require_once '../../core/init.php';
if (isset($_POST['getActiveTrx'])) {
    $query_getActiveTrx   = "SELECT * FROM transactions WHERE trx_status = 'active'";
    $execute_getActiveTrx = mysqli_query($link, $query_getActiveTrx);
    $activeTrxCounter     = mysqli_num_rows($execute_getActiveTrx);
    if ($activeTrxCounter == 0) {
        echo '<tr>
    <td colspan="8" class="text-center font-weight-bold text-lg">- No Active Transaction -</td>
</tr>';
    }
    while ($activeTrx = mysqli_fetch_assoc($execute_getActiveTrx)) {
        $activeTrxId            = $activeTrx['id'];
        $query_getActiveOrder   = "SELECT * FROM orders WHERE trx_id = '$activeTrxId'";
        $execute_getActiveOrder = mysqli_query($link, $query_getActiveOrder);
        $activeOrder            = mysqli_fetch_assoc($execute_getActiveOrder);
        $menuId                 = $activeOrder['menu_id'];
        $query_getOrderedMenu   = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $orderedMenu            = mysqli_fetch_assoc($execute_getOrderedMenu);
        echo '<tr>
            <td>' . $activeTrx['invoice_number'] . '</td>
            <td>' . $activeTrx['customer_name'] . '</td>
            <td>' . $activeOrder['customer_phone'] . '</td>
            <td>' . $orderedMenu['category'] . '</td>
            <td>' . $activeOrder['platnomor'] . '</td>
            <td><button class="btn btn-info btn-sm" onclick="viewActiveTrxDetail(\'' . $activeTrx['invoice_number'] . '\')">Detail</button></td>
        </tr>';
    }
} else {
    header("Location:../index.php");
}
?>

<script>
    document.getElementById("activeTrxCounter").innerHTML = ' <?= $activeTrxCounter ?> ';
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