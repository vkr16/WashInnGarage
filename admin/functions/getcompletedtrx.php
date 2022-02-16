<?php
require_once '../../core/init.php';
if (isset($_POST['getcompletedtrx'])) {
    $today                  = date("Y-m-d");
    $query_getCompleteTrx   = "SELECT * FROM transactions WHERE trx_status = 'completed' AND completedate = '$today'";
    $execute_getCompleteTrx = mysqli_query($link, $query_getCompleteTrx);
    $countCompleteTrxToday  = mysqli_num_rows($execute_getCompleteTrx);
    if ($countCompleteTrxToday == 0) {
        echo '<tr>
    <td colspan="8" class="text-center font-weight-bold text-lg">- No Transaction Has Been Completed Yet -</td>
</tr>';
    }
    while ($completeTrx = mysqli_fetch_assoc($execute_getCompleteTrx)) {
        $trxID                  = $completeTrx['id'];
        $query_getOrderDetail   = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'completed'";
        $execute_getOrderDetail = mysqli_query($link, $query_getOrderDetail);
        $orderDetail            = mysqli_fetch_assoc($execute_getOrderDetail);
        $menuid                 = $orderDetail['menu_id'];
        $query_getMenuDetail    = "SELECT * FROM menus WHERE id = '$menuid'";
        $execute_getMenuDetail  = mysqli_query($link, $query_getMenuDetail);
        $menuDetail             = mysqli_fetch_assoc($execute_getMenuDetail);
        echo '<tr>
            <td>' . $completeTrx['invoice_number'] . '</td>
            <td>' . $completeTrx['customer_name'] . '</td>
            <td>' . $orderDetail['customer_phone'] . '</td>
            <td>' . $menuDetail['category'] . '</td>
            <td>' . $orderDetail['platnomor'] . '</td>
            <td><button class="btn btn-info btn-sm" onclick="viewCompleteTrxDetail(\'' . $completeTrx['invoice_number'] . '\')">Detail</button></td>
        </tr>';
    }
}
?>

<script>
    document.getElementById("completeTrxCounter").innerHTML = ' <?= $countCompleteTrxToday ?> ';
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