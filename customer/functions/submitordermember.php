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


    // check if member are already registered






    var_export($_POST);

    // Getting Prevoius Transaction "id" for Generating Invoice Number
    $query_getPrevTrxId = "SELECT MAX(id) AS PreviousTrxId FROM transactions";
    $execute_getPrevTrxId = mysqli_query($link, $query_getPrevTrxId);
    $result = mysqli_fetch_assoc($execute_getPrevTrxId);
    $PreviousTrxId = $result['PreviousTrxId'];
    $CurrentTrxId = $PreviousTrxId + 1;

    // Generating Invoice Number (Formula : INV/ + current year (4 digit) + / + current month (2 digit) + current date (2 digit) + / + transaction id)
    $invoice_number = 'INV/' . date("Y") . '/' . date("md") . '/' . $CurrentTrxId;

    //Insert transaction to database
    $query_insertTransaction = "INSERT INTO transactions (invoice_number, customer_name, total, trx_status) VALUE ('$invoice_number', '$customer_name', '$total', '$trx_status')";
    if ($execute_insertTransaction = mysqli_query($link, $query_insertTransaction)) {

        // Decide which query to use, if email empty "email" field on db will be filled with NULL instead of empty string

        $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, platnomor, customer_email, member_id, menu_id, order_status ) VALUE ('$CurrentTrxId', '$customer_name', '$customer_phone','$platNomor', '$customer_email', '$memberid',  '$serviceID', 'active' )";


        if ($execute_insertOrder = mysqli_query($link, $query_insertOrder)) {
            header("Location:../thanks.php");
        }
    }
}
