<?php

require '../../assets/vendor/autoload.php';
require_once '../../core/init.php';
if (isset($_POST['completeorder'])) {
    $points = 0;

    $invoice = $_POST['invoice_number'];
    $receipt = $_POST['receipt'];
    $current_user = $_SESSION['wig_user'];
    $query_getOperator = "SELECT * FROM users WHERE username = '$current_user'";
    $execute_getOperator = mysqli_query($link, $query_getOperator);
    $operatorData = mysqli_fetch_assoc($execute_getOperator);
    $operator = $operatorData['fullname'];
    $today = date("Y-m-d");
    $now = date("H:i");

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
        $platnomor = $ordersData['platnomor'];
        $customer_id = $ordersData['customer_id'];
        $points = $points + $pointpermenu;
    }

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
    <div hidden>
        <?php

        $client = new Google_Client();
        $client->setApplicationName('Wash Inn Garage');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig('../../core/credentials.json');
        $client->setAccessType('online');
        $client->setPrompt('select_account consent');


        $service = new Google_Service_Sheets($client);

        $spreadsheetId = '1Y8BZYB2fqc6ANI1bAoVV5baPOUain-8_WUnrob_JHcI';
        $range  = "DataNama";

        $values = [
            [
                $customername, $customerphone, $platnomor
            ],
            // Additional rows ...
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $insert = [
            'InsertDataOption' => "INSERT_ROWS"
        ];
        $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params, $insert);
        // printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());

        ?>
    </div>
<?php

    $query_completeTrx = "UPDATE transactions SET trx_status = 'completed', completedate = '$today',completetime = '$now', receipt_number = '$receipt', operator_name = '$operator' WHERE invoice_number = '$invoice'";
    $execute_completeTrx = mysqli_query($link, $query_completeTrx);

    $query_completeOrder = "UPDATE orders SET order_status = 'completed' WHERE trx_id = '$trx_id' AND order_status = 'active'";
    $execute_completeOrder = mysqli_query($link, $query_completeOrder);

    $query_updateMemberPoin = "UPDATE customers SET membership_point = membership_point + '$points' WHERE id = '$customer_id'";
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