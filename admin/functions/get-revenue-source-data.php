<?php
require_once '../core/init.php';


$serviceTotal = 0;
$merchTotal = 0;
$fnbTotal = 0;



$query_getOrders = "SELECT * FROM orders WHERE order_status = 'completed'";
$execute_getOrders = mysqli_query($link, $query_getOrders);

while ($ordersData = mysqli_fetch_assoc($execute_getOrders)) {
    $menuID = $ordersData['menu_id'];

    $query_getMenus = "SELECT * FROM menus WHERE id = '$menuID'";
    $execute_getMenus = mysqli_query($link, $query_getMenus);
    $menusData = mysqli_fetch_assoc($execute_getMenus);
    $qty = $ordersData['amount'];
    $price = $menusData['price'];
    $type = $menusData['type'];
    $ordervalue = $qty * $price;

    if ($type == 'service') {
        $serviceTotal += $ordervalue;
    } elseif ($type == 'merchandise') {
        $merchTotal += $ordervalue;
    } elseif ($type == 'food' || $type == 'beverage') {
        $fnbTotal += $ordervalue;
    }
}



$persenservice = ($serviceTotal / ($serviceTotal + $merchTotal + $fnbTotal)) * 100;
$persenmerch = ($merchTotal / ($serviceTotal + $merchTotal + $fnbTotal)) * 100;
$persenfnb = ($fnbTotal / ($serviceTotal + $merchTotal + $fnbTotal)) * 100;
$a = round($persenservice, 2);
$b = round($persenmerch, 2);
$c = round($persenfnb, 2);

$arrayRevSource = json_encode(array($a, $b, $c));
