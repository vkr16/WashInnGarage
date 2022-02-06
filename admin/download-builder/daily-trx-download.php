<?php
// require_once '../core/init.php';
// include("../core/SimpleXLSXGen.php");

if (isset($_POST['downloaddaily'])) {
    $users = [
        ['No', 'Tanggal', 'Jam', 'No Invoice', 'No Nota', 'Nama Pelanggan', 'No HP / WhatsApp', 'Email', 'jenis Kendaraan', 'Plat Nomor', 'Layanan', 'Merchandise', 'Makanan', 'Minuman', 'Nilai Total Transaksi', 'Operator / Kasir']
    ];

    $day2download = $_POST['datepicker'];
    $date2download = date_create($day2download);
    $date2download = date_format($date2download, "Y-m-d");

    $query = "SELECT * FROM transactions WHERE trx_status = 'completed' AND completedate = '$date2download'";
    $result = mysqli_query($link, $query);



    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $stringServices = '';
            $stringmerchs = '';
            $stringfoods = '';
            $stringbeverages = '';
            $totalPrice = 0;
            $trxID = $data['id'];
            $tanggal = date_format(date_create($data['completedate']), "j M Y");
            $jam = $data['completetime'];
            $invoice = $data['invoice_number'];
            $receipt = $data['receipt_number'];
            $customername = $data['customer_name'];
            $operatorname = $data['operator_name'];


            $query2 = "SELECT * FROM orders WHERE trx_id = '$trxID' AND order_status = 'completed'";
            $result2 = mysqli_query($link, $query2);
            while ($data2 = mysqli_fetch_assoc($result2)) {
                $customerphone = $data2['customer_phone'];
                $customeremail = $data2['customer_email'];
                $platnomor = $data2['platnomor'];

                $menu_id = $data2['menu_id'];

                $query_getMenus = "SELECT * FROM menus WHERE id = '$menu_id'";
                $execute_getMenus = mysqli_query($link, $query_getMenus);

                $getMenu = mysqli_fetch_assoc($execute_getMenus);
                $qty = $data2['amount'];
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
                } elseif ($menutype == 'food') {
                    $foodOrdered = $menuname . '(' . $qty . '), ';
                    $stringfoods = $stringfoods . $foodOrdered;
                } elseif ($menutype == 'beverage') {
                    $beverageOrdered = $menuname . '(' . $qty . '), ';
                    $stringbeverages = $stringbeverages . $beverageOrdered;
                }

                $menuPrice = $getMenu['price'];
                $subtotal  = $menuPrice * $qty;
                $totalPrice = $totalPrice + $subtotal;
            }

            $services = ($stringServices != '') ? substr($stringServices, 0, -2) : '';
            $merchandises = ($stringmerchs != '') ? substr($stringmerchs, 0, -2) : '';
            $foods = ($stringfoods != '') ? substr($stringfoods, 0, -2) : '';
            $beverages = ($stringbeverages != '') ? substr($stringbeverages, 0, -2) : '';

            $query3 = "SELECT * FROM vehicles WHERE platnomor = '$platnomor'";
            $result3 = mysqli_query($link, $query3);
            $data3 = mysqli_fetch_assoc($result3);

            $jeniskendaraan = $data3['vehicletype'];

            $trx_value = 'Rp ' . number_format($totalPrice, 0, ',', '.');
            $id++;
            $users = array_merge(
                $users,
                array(
                    array(
                        $id,
                        $tanggal,
                        $jam,
                        $invoice,
                        $receipt,
                        $customername,
                        $customerphone,
                        $customeremail,
                        $jeniskendaraan,
                        $platnomor,
                        $services,
                        $merchandises,
                        $foods,
                        $beverages,
                        $trx_value,
                        $operatorname

                    )
                )
            );
        }
        // $today = date("dMY");
        $xlsx = SimpleXLSXGen::fromArray($users);
        $xlsx->downloadAs('Daily Transactions - ' . $day2download . '.xlsx');
    } else {
        echo "<script>alert('No Data Found on " . $day2download . "');
        window.location.replace('transactions.php');
        </script>";
    }
}
