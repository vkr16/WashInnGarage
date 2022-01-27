<?php

require_once '../core/init.php';

if (isset($_POST['btnConfirm'])) {
    $customer_name = $_POST['customername'];
    $customer_phone = $_POST['customerphone'];

    if (isset($_POST['customeremail']) && $_POST['customeremail'] == '') {
        $customer_email = NULL;
    } elseif (isset($_POST['customeremail']) && $_POST['customeremail'] != '') {
        $customer_email = $_POST['customeremail'];
    }


    $vehicleType = $_POST['vehicleType'];
    $serviceID = $_POST['serviceID'];
    $total = $_POST['totalPrice'];
    $platNomor = $_POST['platNomor'];
    $operator_name = $_SESSION['wig_user'];
    $trx_status = 'unconfirmed';
    $registermember = $_POST['registermembership'];

    if ($registermember == 'yes') {
        // check if member are already registered
        $query_getMembers = "SELECT * FROM members WHERE phone = '$customer_phone' OR email = '$customer_email'";
        $execute_getMembers = mysqli_query($link, $query_getMembers);
        $countgetMembers = mysqli_num_rows($execute_getMembers);
        if ($countgetMembers == 1) {
            $memberData = mysqli_fetch_assoc($execute_getMembers);
            $member_id = $memberData['id'];
        } else {
            // Registering new member
            $query_registerMember = "INSERT INTO members (fullname, phone, email) VALUE ('$customer_name', '$customer_phone', '$customer_email')";
            $execute_resgisterMember = mysqli_query($link, $query_registerMember);
            $member_id = mysqli_insert_id($link);

            // registering member's vehicle
            $query_registerVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType', '$platNomor', '$member_id')";
            $execute_registerVehicle = mysqli_query($link, $query_registerVehicle);
        }
    }




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
    $query_insertTransaction = "INSERT INTO transactions (invoice_number, operator_name, customer_name, total, trx_status) VALUE ('$invoice_number', '$operator_name', '$customer_name', '$total', '$trx_status')";
    if ($execute_insertTransaction = mysqli_query($link, $query_insertTransaction)) {

        // Decide which query to use, if email empty "email" field on db will be filled with NULL instead of empty string
        if ($customer_email != '') {
            $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, customer_email, member_id, menu_id, order_status ) VALUE ('$CurrentTrxId', '$customer_name', '$customer_phone', '$customer_email', '$member_id', '$serviceID', 'active' )";
        } else {
            $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, customer_email, member_id, menu_id, order_status ) VALUE ('$CurrentTrxId', '$customer_name', '$customer_phone', NULL, '$member_id',  '$serviceID', 'active' )";
        }


        if ($execute_insertOrder = mysqli_query($link, $query_insertOrder)) {
            header("Location:thanks.php");
        }
    }
}
