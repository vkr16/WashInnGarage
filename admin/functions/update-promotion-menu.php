<?php
require_once "../../core/init.php";



if (isset($_POST['btnUpdateService'])) {
    $servicename = $_POST['servicename'];
    $price       = $_POST['serviceprice'];
    $description = $_POST['servicedesc'];
    $id          = $_POST['serviceidhidden'];
    $poin        = $_POST['poin'];

    if (isset($_POST['activate'])) {
        $status = 'active';
    } else {
        $status = 'inactive';
    }

    $servicename = rm_special_char($servicename);
    mysqli_real_escape_string($link, $servicename);
    $price = rm_special_char_price($price);
    mysqli_real_escape_string($link, $price);
    $description  = rm_some_special_char($description);
    mysqli_real_escape_string($link, $description);
    $poin = rm_special_char_price($poin);
    mysqli_real_escape_string($link, $poin);
    $description = str_replace(array("\r\n", "\n"), '<br>', $description);

    $currentdata = mysqli_query($link, "SELECT * FROM menus WHERE name = '$servicename'");
    $match = mysqli_num_rows($currentdata);

    $query_updateService = "UPDATE menus SET type = 'promotion', name = '$servicename', price = '$price', description = '$description', status = '$status', poin = '$poin'  WHERE id = '$id'";
    if (mysqli_query($link, $query_updateService)) {
        setcookie('returnstatus', 'serviceupdated', time() + (10), "/");
        header("Location: ../promotions-menu.php");
    } else {
        setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
        header("Location: ../promotions-menu.php");
    }
} else {
    header("Location: ../promotions-menu.php");
}
