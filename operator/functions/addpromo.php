<?php
require_once '../../core/init.php';

if (isset($_POST['addPromo'])) {
    $menuID = $_POST['menuID'];
    $invoice = $_POST['invoice'];

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trxID = $trxDetail['id'];

    $query_getOrders = "SELECT * FROM orders WHERE menu_id = '$menuID' AND trx_id = '$trxID' AND order_status = 'active'";
    $execute_getOrders = mysqli_query($link, $query_getOrders);
    $orders = mysqli_fetch_assoc($execute_getOrders);
    $count_orders = mysqli_num_rows($execute_getOrders);

    $query_getOrdersData = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'active'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);
    $orders2 = mysqli_fetch_assoc($execute_getOrdersData);


    $customerID = $orders2['customer_id'];
    $query_getMenu = "SELECT * FROM menus WHERE id ='$menuID'";
    $execute_getMenu = mysqli_query($link, $query_getMenu);
    $menu = mysqli_fetch_assoc($execute_getMenu);
    $menuPoin = $menu['poin'];

    $query_getCustomer = "SELECT * FROM customers WHERE id = '$customerID'";
    $execute_getCustomer = mysqli_query($link, $query_getCustomer);
    $customer = mysqli_fetch_assoc($execute_getCustomer);

    $customerPoin = $customer['membership_point'];

    if ($customerPoin + $menuPoin >= 0) {
        if ($count_orders == 0) {
            $query_getOrders = "SELECT * FROM orders WHERE trx_id = '$trxID'";
            echo $trxID;
            $execute_getOrders = mysqli_query($link, $query_getOrders);
            $orders = mysqli_fetch_assoc($execute_getOrders);
            $customername = $orders['customer_name'];
            $customerphone = $orders['customer_phone'];
            $customeremail = $orders['customer_email'];
            $customerid = $orders['customer_id'];
            $platnomor = $orders['platnomor'];


            $query_addOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, customer_email, customer_id, menu_id, platnomor, order_status)
                                            VALUE ('$trxID','$customername','$customerphone', '$customeremail', '$customerid', '$menuID', '$platnomor', 'active')";

            $execute_addOrder = mysqli_query($link, $query_addOrder);
        }
    } else {
        echo " <script>
            alert('Not Enough Customer Point To Redeem This Promo');
        </script>";
    }
}
