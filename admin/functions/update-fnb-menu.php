<?php
require_once "../../core/init.php";
if (isset($_POST['btnUpdateFnB'])) {
    $itemname    = $_POST['fnbname'];
    $stock       = $_POST['fnbstock'];
    $image       = $_POST['thumbnail2'];
    $price       = $_POST['fnbprice'];
    $description = $_POST['fnbdesc'];
    $type        = $_POST['fnbtype'];
    $poin        = $_POST['poin'];
    $id          = $_POST['serviceidhidden'];
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
    var_dump($itemname, $status, $stock, $image, $price, $description);
    if ($_FILES['thumbnail2']['size'] != 0 && $_FILES['thumbnail2']['error'] == 0) {
        $path                 = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
        $path2                = $_FILES['thumbnail2']['name'];
        $ext                  = pathinfo($path2, PATHINFO_EXTENSION);
        $path                 = $path . $itemname . '.' . $ext;
        $query_getMerchInfo   = "SELECT * FROM menus WHERE id = '$id'";
        $execute_getMerchInfo = mysqli_query($link, $query_getMerchInfo);
        $result               = mysqli_fetch_assoc($execute_getMerchInfo);
        $old_img              = $result['image'];
        $filenameondb         = $itemname . '.' . $ext;
        $pathfile             = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/" . $old_img;
        unlink($pathfile);
        $query_updateMerchandise1 = "UPDATE menus SET type = '$type', stock = '$stock', name = '$itemname',image = '$filenameondb', price = '$price', description = '$description', status = '$status', poin = '$poin' WHERE id = '$id'";
        if (mysqli_query($link, $query_updateMerchandise1)) {
            if (move_uploaded_file($_FILES['thumbnail2']['tmp_name'], $path)) {
                setcookie('returnstatus', 'itemupdated', time() + (10), "/");
            } else {
                setcookie('returnstatus', 'itemnotupdated', time() + (10), "/");
            }
            header("Location: ../fnb-menu.php");
        }
    } else {
        $query_updateMerchandise = "UPDATE menus SET type = '$type',  stock = '$stock', name = '$itemname', price = '$price', description = '$description', status = '$status', poin = '$poin' WHERE id = '$id'";
        if (mysqli_query($link, $query_updateMerchandise)) {
            setcookie('returnstatus', 'itemupdated', time() + (10), "/");
            header("Location: ../fnb-menu.php");
        } else {
            setcookie('returnstatus', 'itemnotupdated', time() + (10), "/");
            header("Location: ../fnb-menu.php");
        }
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