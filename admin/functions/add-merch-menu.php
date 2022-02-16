<?php
require_once "../../core/init.php";

if (isset($_POST['btnAddMerch'])) {
    $itemname    = $_POST['merchname'];
    $stock       = $_POST['merchstock'];
    $image       = $_POST['thumbnail'];
    $price       = $_POST['merchprice'];
    $description = $_POST['merchdesc'];
    $poin        = $_POST['poin'];

    if (isset($_POST['activate'])) {
        $status = 'active';
    } else {
        $status = 'inactive';
    }

    $itemname = rm_special_char($itemname);
    mysqli_real_escape_string($link, $itemname);
    $stock = rm_special_char($stock);
    mysqli_real_escape_string($link, $stock);
    $description = rm_some_special_char($description);
    mysqli_real_escape_string($link, $description);
    $price = rm_special_char($price);
    mysqli_real_escape_string($link, $price);
    $poin = rm_special_char($poin);
    mysqli_real_escape_string($link, $poin);

    $description = str_replace(array(
        "\r\n",
        "\n"
    ), '<br>', $description);

    $query_getMerchandise = "SELECT * FROM menus WHERE name = '$itemname'";
    $match                = mysqli_num_rows(mysqli_query($link, $query_getMerchandise));
    if ($match == 0) {
        if ($_FILES['thumbnail']['size'] != 0 && $_FILES['thumbnail']['error'] == 0) {
            $path  = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
            $path2 = $_FILES['thumbnail']['name'];
            $ext   = pathinfo($path2, PATHINFO_EXTENSION);
            $path  = $path . $itemname . '.' . $ext;

            $filenameondb = $itemname . '.' . $ext;

            $query_addMerchandise1 = "INSERT INTO menus (type , name, price, image, description, status, stock,poin) 
                                        VALUES ('merchandise', '$itemname', '$price', '$filenameondb', '$description', '$status', '$stock','$poin')";

            if (mysqli_query($link, $query_addMerchandise1)) {
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
                    setcookie('returnstatus', 'itemadded', time() + (10), "/");
                } else {
                    setcookie('returnstatus', 'itemnotadded', time() + (10), "/");
                }
                header("Location: ../merch-menu.php");
            }
        } else {
            $query_addMerchandise = "INSERT INTO menus (type , name, price, description, status, stock,poin) 
                                        VALUES ('merchandise', '$itemname', '$price', '$description', '$status', '$stock','$poin')";
            if (mysqli_query($link, $query_addMerchandise)) {
                setcookie('returnstatus', 'itemadded', time() + (10), "/");
                header("Location: ../merch-menu.php");
            } else {
                setcookie('returnstatus', 'itemnotadded', time() + (10), "/");
                header("Location: ../merch-menu.php");
            }
        }
    } else {
        setcookie('returnstatus', 'itemexist', time() + (10), "/");
        header("Location: ../merch-menu.php");
    }
} else {
    header("Location: ../merch-menu.php");
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