<?php
require_once '../core/init.php';

$array30days = array();
$arraydates = array();
for ($i = 1; $i <= 30; $i++) {
    $thedate = date("Y-m-d", strtotime("- " . $i . " day"));
    $thedatedate = date_create($thedate);
    $shortdate = date_format($thedatedate, "j M");
    $todayValue = 0;
    $queryTrx  =  "SELECT * FROM transactions WHERE completedate = '$thedate' AND trx_status ='completed'";
    $executeTrx = mysqli_query($link, $queryTrx);
    if (mysqli_num_rows($executeTrx) > 0) {
        while ($resultTrx = mysqli_fetch_assoc($executeTrx)) {
            $trxValue = 0;
            $trxID = $resultTrx['id'];
            $queryOrder = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status='completed'";
            $executeOrder = mysqli_query($link, $queryOrder);

            while ($resultOrder = mysqli_fetch_assoc($executeOrder)) {
                $menuID = $resultOrder['menu_id'];
                $queryMenu = "SELECT * FROM menus WHERE id = '$menuID'";
                $executeMenu = mysqli_query($link, $queryMenu);
                $resultMenu = mysqli_fetch_assoc($executeMenu);

                $qty = $resultOrder['amount'];
                $price = $resultMenu['price'];
                $orderValue = $qty * $price;
                $trxValue += $orderValue;
            }
            $todayValue += $trxValue;
        }
    }
    $arraydates[] = $shortdate;
    $array30days[] = $todayValue;
}
$array30daysjson = json_encode(array_reverse($array30days));
$arraydatesjson = json_encode(array_reverse($arraydates));
