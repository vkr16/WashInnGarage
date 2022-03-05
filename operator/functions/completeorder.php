<?php

require '../../assets/vendor/autoload.php';
require_once '../../core/init.php';
require_once 'autoresetsheet.php';

if (isset($_POST['completeorder'])) {
    $points = 0;
    $stringServices = '';
    $stringmerchs = '';
    $stringfoods = '';
    $stringbeverages = '';
    $stringpromotions = '';
    $totalPrice = 0;
    $today = date("j M Y");
    $today2 = date("Y-m-d");
    $now = date("H:i");
    $updateDate = date("j M Y");
    $lastupdateinfo = "Last updated at " . $now;
    $servicesPrice = 0;
    $merchsPrice = 0;
    $foodsPrice = 0;
    $beveragesPrice = 0;
    $promovalues = 0;


    $invoice = $_POST['invoice_number'];
    $receipt = $_POST['receipt'];
    $receipt = rm_some_special_char($receipt);

    mysqli_real_escape_string($link, $receipt);
    $current_user = $_SESSION['wig_user'];
    $query_getOperator = "SELECT * FROM users WHERE username = '$current_user'";
    $execute_getOperator = mysqli_query($link, $query_getOperator);
    $operatorData = mysqli_fetch_assoc($execute_getOperator);
    $operator = $operatorData['fullname'];

    $query_getTrxDetail = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
    $execute_getTrxDetail = mysqli_query($link, $query_getTrxDetail);
    $trxDetail = mysqli_fetch_assoc($execute_getTrxDetail);

    $trx_id = $trxDetail['id'];

    $query_getOrdersData = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status = 'active'";
    $execute_getOrdersData = mysqli_query($link, $query_getOrdersData);

    while ($ordersData = mysqli_fetch_assoc($execute_getOrdersData)) {
        $menuId = $ordersData['menu_id'];
        $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
        $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
        $menuData = mysqli_fetch_assoc($execute_getOrderedMenu);
        $menupoin = $menuData['poin'];
        $orderqty = $ordersData['amount'];

        $pointpermenu = $menupoin * $orderqty;

        $customername = $ordersData['customer_name'];
        $customerphone = $ordersData['customer_phone'];
        $customeremail = $ordersData['customer_email'];
        $platnomor = $ordersData['platnomor'];
        $customer_id = $ordersData['customer_id'];
        $points = $points + $pointpermenu;
    }


    $query_getVehicle = "SELECT * FROM vehicles WHERE platnomor = '$platnomor'";
    $execute_getvehicle = mysqli_query($link, $query_getVehicle);
    $vehicleData = mysqli_fetch_assoc($execute_getvehicle);
    $vehicleType = $vehicleData['vehicletype'];

    $query_getOrdersForAPI = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status = 'active'";
    $execute_getOrdersForAPI = mysqli_query($link, $query_getOrdersForAPI);

    while ($orders4API = mysqli_fetch_assoc($execute_getOrdersForAPI)) {
        $menu_id = $orders4API['menu_id'];

        $query_getMenus = "SELECT * FROM menus WHERE id = '$menu_id'";
        $execute_getMenus = mysqli_query($link, $query_getMenus);

        $getMenu = mysqli_fetch_assoc($execute_getMenus);
        $qty = $orders4API['amount'];
        $menuname = $getMenu['name'];
        $menutype = $getMenu['type'];
        $menuprice = $getMenu['price'];
        $ordervalue = $menuprice * $qty;
        if ($menutype == 'service') {
            $serviceOrdered = $menuname . '(' . $qty . '), ';
            $stringServices = $stringServices . $serviceOrdered;
            $servicesPrice = $servicesPrice + $ordervalue;
        } elseif ($menutype == 'merchandise') {
            $merchOrdered = $menuname . '(' . $qty . '), ';
            $stringmerchs = $stringmerchs . $merchOrdered;
            $merchsPrice = $merchsPrice + $ordervalue;
        } elseif ($menutype == 'food') {
            $foodOrdered = $menuname . '(' . $qty . '), ';
            $stringfoods = $stringfoods . $foodOrdered;
            $foodsPrice = $foodsPrice + $ordervalue;
        } elseif ($menutype == 'beverage') {
            $beverageOrdered = $menuname . '(' . $qty . '), ';
            $stringbeverages = $stringbeverages . $beverageOrdered;
            $beveragesPrice = $beveragesPrice + $ordervalue;
        } elseif ($menutype == 'promotion') {
            $promoApplied = $menuname . ', ';
            $stringpromotions = $stringpromotions . $promoApplied;
            $promovalues = $promovalues + $ordervalue;
        }

        $menuPrice = $getMenu['price'];
        $subtotal  = $menuPrice * $qty;
        $totalPrice = $totalPrice + $subtotal;
        if ($totalPrice < 0) {
            $totalPrice = 0;
        }
    }

    // 'Car Experss(2)','Express Bike(1)','Lays Classic(3)','Kopi Hitam(1)','Kaos Hitam(1)','Mug Hitam cantik(1)',
    $completedate = $today;
    $completetime = $now;
    $invoice_number = $invoice;
    $receipt_number = $receipt;
    $customername = $customername;
    $customerphone = $customerphone;
    $customeremail = ($customeremail == "") ? "-" : $customeremail;
    $vehicletype = $vehicleType;
    $platnomor = $platnomor;
    $services = ($stringServices != '') ? substr($stringServices, 0, -2) : '';
    $merchandises = ($stringmerchs != '') ? substr($stringmerchs, 0, -2) : '';
    $foods = ($stringfoods != '') ? substr($stringfoods, 0, -2) : '';
    $beverages = ($stringbeverages != '') ? substr($stringbeverages, 0, -2) : '';
    $promotions = ($stringpromotions != '') ? substr($stringpromotions, 0, -2) : '';

    $servicesValue = 'Rp ' . number_format($servicesPrice, 0, ',', '.');
    $merchsValue = 'Rp ' . number_format($merchsPrice, 0, ',', '.');
    $foodsValue = 'Rp ' . number_format($foodsPrice, 0, ',', '.');
    $beveragesValue = 'Rp ' . number_format($beveragesPrice, 0, ',', '.');
    $promoValue = 'Rp ' . number_format($promovalues, 0, ',', '.');

    $trx_value = 'Rp ' . number_format($totalPrice, 0, ',', '.');
    $operatorname = $operator;
    $status_trx = 'Selesai';

    $fma = json_encode(array($completedate, $completetime, $invoice_number, $receipt_number, $customername, $customerphone, $customeremail, $vehicletype, $platnomor, $services, $servicesValue, $merchandises, $merchsValue, $foods, $foodsValue, $beverages, $beveragesValue, $promotions, $promoValue, $trx_value, $operatorname, $status_trx));
    print_r($fma);
?>
    <link rel="stylesheet" href="../../assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../../assets/vendor/fontawesome-free/css/all.min.css">
    <div class="col-md-8 offset-md-2">
        <div class="alert alert-danger mt-5 mb-3">
            <h2 class=""><i class="fas fa-unlink fa-fw"></i>&nbsp;<strong>ERROR:</strong> Unable to resolve Google Sheets API host</h2>
        </div>
        <div class="alert alert-info mb-3">
            <h2 class=""><i class="fas fa-question-circle fa-fw"></i>&nbsp;<strong>WHY? :</strong> No Internet Connection</h2>
        </div>
        <div class="alert alert-success mb-3">
            <h2 class=""><i class="fas fa-info-circle fa-fw"></i>&nbsp;<strong>HOW? :</strong> Follow These Steps</h2>
            <hr>
            <h4>
                <ol>
                    <li>Don't close this page</li>
                    <li>Fix your internet connection</li>
                    <li>Refresh the page by pressing <kbd>F5</kbd> button or <kbd><i class="fas fa-redo-alt fa-fw fa-sm"></i></kbd> on your browser</li>
                    <li>Click <kbd>Continue</kbd> on <strong>Confirm Form Resubmission</strong> alert</li>
                </ol>

                <hr>
            </h4>
        </div>
        <div class="alert alert-warning mb-3 text-center">
            <hr>
            <h5 class=""><i class="fas fa-code"></i> Halo Mas, Ojo lali ngopiiiii.... ben fokusss <i class="fas fa-mug-hot"></i> </h5><br>
            <H2>😁</H2><br> "Salam Sehat Selalu" - Developer (FMA)
            <hr>
        </div>
    </div>
    <div>
        <?php

        $client = new Google_Client();
        $client->setApplicationName('Wash Inn Garage');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig('../../core/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');


        $service = new Google_Service_Sheets($client);

        //For Development
        // $spreadsheetId = '1Wxvo7fuaAFWGMdlh0r9nZEn4wlj0y6u5V2QzrbKvfAc';

        // For Production
        $spreadsheetId = '1RMFQXYWh7bji0imCR9UQOBwZq-ksa1DD0wkCsQ_vxSA';


        $sheetDaily = strval("Tanggal" . date("j"));

        autoreset($spreadsheetId, $sheetDaily);

        // Insert Last Update Untuk Main Sheet
        $values = [
            [
                "Last updated " . $today . " at " . $now
            ],
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];
        $result = $service->spreadsheets_values->update($spreadsheetId,  "All Completed Trx!A1:D1", $body, $params);

        // Insert  date ke Sheet utama
        $values = [
            [
                $completedate, $completetime, $invoice_number, $receipt_number, $customername, $customerphone, $customeremail, $vehicletype, $platnomor, $services, $servicesValue, $merchandises, $merchsValue, $foods, $foodsValue, $beverages, $beveragesValue, $promotions, $promoValue, $trx_value, $operatorname, $status_trx
            ],
            // Additional rows ...
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $result = $service->spreadsheets_values->append($spreadsheetId, "All Completed Trx", $body, $params);














        // Insert Last Update Untuk Daily
        $values = [
            [
                "Last updated at", $now, date("F")
            ],
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];
        $sheetDaily = strval("Tanggal" . date("j") . "!A1:C1");
        // $sheetDaily = strval("Tanggal" . "1");
        $result = $service->spreadsheets_values->update($spreadsheetId,  $sheetDaily, $body, $params);

        // Insert data ke Sheet daily
        $values2 = [
            [
                $completedate, $completetime, $invoice_number, $receipt_number, $customername, $customerphone, $customeremail, $vehicletype, $platnomor, $services, $servicesValue, $merchandises, $merchsValue, $foods, $foodsValue, $beverages, $beveragesValue, $promotions, $promoValue, $trx_value, $operatorname, $status_trx
            ],
        ];
        $body2 = new Google_Service_Sheets_ValueRange([
            'values' => $values2
        ]);

        $params2 = [
            'valueInputOption' => 'RAW'
        ];

        // $sheetDaily = strval("Tanggal" . "1");
        $result2 = $service->spreadsheets_values->append($spreadsheetId, $sheetDaily, $body2, $params2);



        ?>
    </div>
<?php

    $query_completeTrx = "UPDATE transactions SET trx_status = 'completed', completedate = '$today2',completetime = '$now', receipt_number = '$receipt', operator_name = '$operator' WHERE invoice_number = '$invoice'";
    $execute_completeTrx = mysqli_query($link, $query_completeTrx);

    $query_completeOrder = "UPDATE orders SET order_status = 'completed' WHERE trx_id = '$trx_id' AND order_status = 'active'";
    $execute_completeOrder = mysqli_query($link, $query_completeOrder);


    $query_updateMemberPoin = "UPDATE customers SET membership_point = membership_point + '$points' WHERE id = '$customer_id' AND membership ='member'";
    if ($execute_updateMemberPoin = mysqli_query($link, $query_updateMemberPoin)) {
        // echo $points;
        header("Location:../index.php");
    } else {
        echo "gagal update poin";
    }
} else {
    echo base64_decode("TmdhcGFpbiBtYXMga2VzaW5pPz8/");
}
?>