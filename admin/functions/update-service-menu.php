<?php
require_once "../../core/init.php";
if (isset($_POST['btnUpdateService'])) {
    $servicename = $_POST['servicename'];
    $category    = $_POST['category'];
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
    $price = rm_special_char($price);
    mysqli_real_escape_string($link, $price);
    $description = rm_some_special_char($description);
    mysqli_real_escape_string($link, $description);
    $poin = rm_special_char($poin);
    mysqli_real_escape_string($link, $poin);
    $description = str_replace(array(
        "\r\n",
        "\n"
    ), '<br>', $description);
    $currentdata = mysqli_query($link, "SELECT * FROM menus WHERE name = '$servicename'");
    $match       = mysqli_num_rows($currentdata);
    if ($_FILES['thumbnail2']['size'] != 0 && $_FILES['thumbnail2']['error'] == 0) {
        $path                   = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
        $path2                  = $_FILES['thumbnail2']['name'];
        $ext                    = pathinfo($path2, PATHINFO_EXTENSION);
        $path                   = $path . $servicename . '.' . $ext;
        $query_getServiceInfo   = "SELECT * FROM menus WHERE id = '$id'";
        $execute_getServiceInfo = mysqli_query($link, $query_getServiceInfo);
        $result                 = mysqli_fetch_assoc($execute_getServiceInfo);
        $old_img                = $result['image'];
        $old_name               = $result['name'];
        $filenameondb           = $servicename . '.' . $ext;
        $pathfile               = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/" . $old_img;
        unlink($pathfile);
        $query_updateService1 = "UPDATE menus SET type = 'service', category = '$category', name = '$servicename',image = '$filenameondb', price = '$price', description = '$description', status = '$status', poin = '$poin' WHERE id = '$id'";
        if (mysqli_query($link, $query_updateService1)) {
            if (move_uploaded_file($_FILES['thumbnail2']['tmp_name'], $path)) {
                setcookie('returnstatus', 'serviceupdated', time() + (10), "/");
            } else {
                setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
            }
            header("Location: ../service-menu.php");
        }
    } else {
        $query_updateService = "UPDATE menus SET type = 'service', category = '$category', name = '$servicename', price = '$price', description = '$description', status = '$status', poin = '$poin'  WHERE id = '$id'";
        if (mysqli_query($link, $query_updateService)) {
            setcookie('returnstatus', 'serviceupdated', time() + (10), "/");
            header("Location: ../service-menu.php");
        } else {
            setcookie('returnstatus', 'servicenotupdated', time() + (10), "/");
            header("Location: ../service-menu.php");
        }
    }
} else {
    header("Location: ../service-menu.php");
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