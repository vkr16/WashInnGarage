<?php
require_once "../../core/init.php";

if (isset($_POST['btnAddFnB'])) {
    $itemname    = $_POST['fnbname'];
    $stock       = $_POST['fnbstock'];
    $image       = $_POST['thumbnail'];
    $price       = $_POST['fnbprice'];
    $description = $_POST['fnbdesc'];
    $type        = $_POST['fnbtype'];
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


    $query_getFnB = "SELECT * FROM menus WHERE name = '$itemname'";
    $match        = mysqli_num_rows(mysqli_query($link, $query_getFnB));
    if ($match == 0) {


        if ($_FILES['thumbnail']['size'] != 0 && $_FILES['thumbnail']['error'] == 0) {
            $path  = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
            $path2 = $_FILES['thumbnail']['name'];
            $ext   = pathinfo($path2, PATHINFO_EXTENSION);
            $path  = $path . $itemname . '.' . $ext;

            $filenameondb = $itemname . '.' . $ext;

            $query_addFnB1 = "INSERT INTO menus (type , name, price, image, description, status, stock, poin) 
                                        VALUES ('$type', '$itemname', '$price', '$filenameondb', '$description', '$status', '$stock', '$poin')";

            if (mysqli_query($link, $query_addFnB1)) {
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
                    setcookie('returnstatus', 'itemadded', time() + (10), "/");
                } else {
                    setcookie('returnstatus', 'itemnotadded', time() + (10), "/");
                }
                header("Location: ../fnb-menu.php");
            }
        } else {
            $query_addFnB = "INSERT INTO menus (type , name, price, description, status, stock, poin) 
                                        VALUES ('$type', '$itemname', '$price', '$description', '$status', '$stock', '$poin')";
            if (mysqli_query($link, $query_addFnB)) {
                setcookie('returnstatus', 'itemadded', time() + (10), "/");
                header("Location: ../fnb-menu.php");
            } else {
                setcookie('returnstatus', 'itemnotadded', time() + (10), "/");
                header("Location: ../fnb-menu.php");
            }
        }
    } else {
        setcookie('returnstatus', 'itemexist', time() + (10), "/");
        header("Location: ../fnb-menu.php");
    }
} else {
    header("Location: ../fnb-menu.php");
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