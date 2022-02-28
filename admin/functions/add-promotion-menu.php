<?php
require_once "../../core/init.php";
if (isset($_POST['btnAddServiceMenu'])) {
    $servicename = $_POST['servicename'];
    $price       = $_POST['serviceprice'];
    $description = $_POST['servicedesc'];
    $poin        = $_POST['poin'];

    if ($price > 0) {
        $converter = $price * 2;
        $price = $price - $converter;
    }
    if ($poin > 0) {
        $converter = $poin * 2;
        $poin = $poin - $converter;
    }

    if (isset($_POST['activate'])) {
        $status = 'active';
    } else {
        $status = 'inactive';
    }
    $servicename = rm_special_char($servicename);
    mysqli_real_escape_string($link, $servicename);
    $price = rm_special_char_price($price);
    mysqli_real_escape_string($link, $price);
    $description = rm_some_special_char($description);
    mysqli_real_escape_string($link, $description);
    $poin = rm_special_char_price($poin);
    mysqli_real_escape_string($link, $poin);
    $description       = str_replace(array(
        "\r\n",
        "\n"
    ), '<br>', $description);
    $query_getServices = "SELECT * FROM menus WHERE name = '$servicename'";
    $match             = mysqli_num_rows(mysqli_query($link, $query_getServices));
    if ($match == 0) {
        $query_addService = "INSERT INTO menus (type , name, price, description, status, poin) 
                                        VALUES ('promotion', '$servicename', '$price', '$description', '$status', '$poin')";
        if (mysqli_query($link, $query_addService)) {
            setcookie('returnstatus', 'serviceadded', time() + (10), "/");
            header("Location: ../promotions-menu.php");
        } else {
            setcookie('returnstatus', 'servicenotadded', time() + (10), "/");
            header("Location: ../promotions-menu.php");
        }
    } else {
        setcookie('returnstatus', 'serviceexist', time() + (10), "/");
        header("Location: ../promotions-menu.php");
    }
} else {
    header("Location: ../promotions-menu.php");
}
?>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->