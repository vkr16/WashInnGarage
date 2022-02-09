<?php

require_once '../../core/init.php';

if (isset($_POST['btnConfirm'])) {
    $customer_name = $_POST['customername'];
    $customer_phone = $_POST['customerphone'];
    $memberid = $_POST['memberid'];
    $customer_email = $_POST['customeremail'];

    var_dump($memberid);


    $vehicleType = $_POST['vehicleType'];
    $serviceID = $_POST['serviceID'];
    $total = $_POST['totalPrice'];
    $platNomor = $_POST['platNomor'];
    $operator_name = $_SESSION['wig_user'];
    $trx_status = 'unconfirmed';

    $query_getVehicleNumber = "SELECT * FROM vehicles WHERE platnomor = '$platNomor'";
    $execute_getVehicleNumber = mysqli_query($link, $query_getVehicleNumber);
    $count_getVehicleNumber = mysqli_num_rows($execute_getVehicleNumber);

    if ($count_getVehicleNumber == 0) {
        $query_insertVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType','$platNomor','$memberid')";
        $execute_insertVehicle = mysqli_query($link, $query_insertVehicle);
    }






    $invoice_format = 'ID/' . date("y") . '/' . date("md") . '/';
    // Getting Prevoius Transaction "id" for Generating Invoice Number
    $query_getPrevTrxId = "SELECT * FROM transactions WHERE invoice_number LIKE '$invoice_format%'";
    $execute_getPrevTrxId = mysqli_query($link, $query_getPrevTrxId);
    $result = mysqli_fetch_assoc($execute_getPrevTrxId);
    $PreviousTrxId = mysqli_num_rows($execute_getPrevTrxId);
    $CurrentTrxId = $PreviousTrxId + 1;




    $query_getPrevTrxId2 = "SELECT MAX(id) AS PreviousTrxId2 FROM transactions";
    $execute_getPrevTrxId2 = mysqli_query($link, $query_getPrevTrxId2);
    $result2 = mysqli_fetch_assoc($execute_getPrevTrxId2);
    $PreviousTrxId2 = $result2['PreviousTrxId2'];
    $CurrentTrxId2 = $PreviousTrxId2 + 1;


    $invoice_number = 'ID/' . date("y") . '/' . date("md") . '/' . $CurrentTrxId;


    //Insert transaction to database
    $query_insertTransaction = "INSERT INTO transactions (invoice_number, customer_name,trx_status) VALUE ('$invoice_number', '$customer_name', '$trx_status')";
    if ($execute_insertTransaction = mysqli_query($link, $query_insertTransaction)) {

        // Decide which query to use, if email empty "email" field on db will be filled with NULL instead of empty string
        mysqli_real_escape_string($link, $platNomor);
        $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, platnomor, customer_email, customer_id, menu_id, order_status ) VALUE ('$CurrentTrxId2', '$customer_name', '$customer_phone','$platNomor', '$customer_email', '$memberid',  '$serviceID', 'active' )";


        if ($execute_insertOrder = mysqli_query($link, $query_insertOrder)) {
            header("Location:../thanks.php");
        }
    } else {
        echo "gagal disini";
    }
}
