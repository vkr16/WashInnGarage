<?php

require_once '../../core/init.php';

if (isset($_POST['btnConfirm'])) {
    $customer_name = $_POST['customername'];
    $customer_phone = $_POST['customerphone'];
    $customer_name = rm_special_char($customer_name);
    $customer_phone = rm_special_char($customer_phone);

    if (isset($_POST['customeremail']) && $_POST['customeremail'] == '') {
        $customer_email = NULL;
    } elseif (isset($_POST['customeremail']) && $_POST['customeremail'] != '') {
        $customer_email = $_POST['customeremail'];
    }


    $vehicleType = $_POST['vehicleType'];
    $serviceID = $_POST['serviceID'];
    $total = $_POST['totalPrice'];
    $platNomor = $_POST['platNomor'];
    $platNomor = rm_special_char($platNomor);
    $operator_name = $_SESSION['wig_user'];
    $trx_status = 'unconfirmed';
    $registermember = $_POST['registermembership'];



    if ($registermember == 'yes') {
        // check if member are already registered
        $query_getMembers = "SELECT * FROM customers WHERE phone = '$customer_phone' OR email = '$customer_email'";
        $execute_getMembers = mysqli_query($link, $query_getMembers);
        $countgetMembers = mysqli_num_rows($execute_getMembers);
        if ($countgetMembers == 1) {
            $memberData = mysqli_fetch_assoc($execute_getMembers);
            $member_id = $memberData['id'];

            $query_getVehicles = "SELECT * FROM vehicles WHERE owner_id ='$member_id' AND platnomor = '$platNomor'";
            $execute_getVehicles = mysqli_query($link, $query_getVehicles);
            $count_getVehicles = mysqli_num_rows($execute_getVehicles);

            if ($count_getVehicles == 0) {
                // registering customer's vehicle
                $query_registerVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType', '$platNomor', '$member_id')";
                $execute_registerVehicle = mysqli_query($link, $query_registerVehicle);
            }
        } else {
            // Registering new member
            $query_registerMember = "INSERT INTO customers (fullname, phone, email, membership) VALUE ('$customer_name', '$customer_phone', '$customer_email', 'member')";
            $execute_resgisterMember = mysqli_query($link, $query_registerMember);
            $member_id = mysqli_insert_id($link);

            // registering member's vehicle
            $query_registerVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType', '$platNomor', '$member_id')";
            $execute_registerVehicle = mysqli_query($link, $query_registerVehicle);
        }
    } else {
        // check if member are already registered
        $query_getMembers = "SELECT * FROM customers WHERE phone = '$customer_phone'";
        $execute_getMembers = mysqli_query($link, $query_getMembers);
        $countgetMembers = mysqli_num_rows($execute_getMembers);
        if ($countgetMembers == 1) {
            $memberData = mysqli_fetch_assoc($execute_getMembers);
            $member_id = $memberData['id'];

            $query_getVehicles = "SELECT * FROM vehicles WHERE owner_id ='$member_id' AND platnomor = '$platNomor'";
            $execute_getVehicles = mysqli_query($link, $query_getVehicles);
            $count_getVehicles = mysqli_num_rows($execute_getVehicles);

            if ($count_getVehicles == 0) {
                // registering customer's vehicle
                $query_registerVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType', '$platNomor', '$member_id')";
                $execute_registerVehicle = mysqli_query($link, $query_registerVehicle);
            }
        } else {
            // Registering new member
            $query_registerMember = "INSERT INTO customers (fullname, phone, email, membership) VALUE ('$customer_name', '$customer_phone', '$customer_email', 'customer')";
            $execute_resgisterMember = mysqli_query($link, $query_registerMember);
            $member_id = mysqli_insert_id($link);

            // registering member's vehicle
            $query_registerVehicle = "INSERT INTO vehicles (vehicletype, platnomor, owner_id) VALUE ('$vehicleType', '$platNomor', '$member_id')";
            $execute_registerVehicle = mysqli_query($link, $query_registerVehicle);
        }
    }




    //    var_export($_POST);

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

    // Generating Invoice Number (Formula : TR/ + current year (4 digit) + / + current month (2 digit) + current date (2 digit) + /ID/ + transaction id)
    $invoice_number = 'ID/' . date("y") . '/' . date("md") . '/' . $CurrentTrxId;


    // Escape string 




    //Insert transaction to database
    $query_insertTransaction = "INSERT INTO transactions (invoice_number, customer_name, trx_status) VALUE ('$invoice_number', '$customer_name', '$trx_status')";
    if ($execute_insertTransaction = mysqli_query($link, $query_insertTransaction)) {
        mysqli_real_escape_string($link, $customer_name);
        mysqli_real_escape_string($link, $customer_phone);
        mysqli_real_escape_string($link, $platNomor);

        // Decide which query to use, if email empty "email" field on db will be filled with NULL instead of empty string
        if ($customer_email != '') {
            mysqli_real_escape_string($link, $customer_email);
            $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, platnomor, customer_email, customer_id, menu_id, order_status ) VALUE ('$CurrentTrxId2', '$customer_name', '$customer_phone', '$platNomor', '$customer_email', '$member_id', '$serviceID', 'active' )";
        } else {
            $query_insertOrder = "INSERT INTO orders (trx_id, customer_name, customer_phone, platnomor, customer_email, customer_id, menu_id, order_status ) VALUE ('$CurrentTrxId2', '$customer_name', '$customer_phone', '$platNomor', NULL, '$member_id',  '$serviceID', 'active' )";
        }


        if ($execute_insertOrder = mysqli_query($link, $query_insertOrder)) {
            header("Location:../thanks.php");
        }
    }
}
