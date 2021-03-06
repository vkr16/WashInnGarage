<?php
require_once "../../core/init.php";
if (isset($_POST['btnAddServiceMenu'])) {
    $servicename = $_POST['servicename'];
    $category    = $_POST['category'];
    $image       = $_POST['thumbnail'];
    $price       = $_POST['serviceprice'];
    $description = $_POST['servicedesc'];
    $poin        = $_POST['poin'];
    if (isset($_POST['activate'])) {
        $status = 'active';
    } else {
        $status = 'inactive';
    }
    $query_getServices = "SELECT * FROM menus WHERE name = '$servicename'";
    $match             = mysqli_num_rows(mysqli_query($link, $query_getServices));
    if ($match == 0) {
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
        if (!empty($_FILES['thumbnail'])) {
            $path              = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
            $path2             = $_FILES['thumbnail']['name'];
            $ext               = pathinfo($path2, PATHINFO_EXTENSION);
            $path              = $path . $servicename . '.' . $ext;
            $filenameondb      = $servicename . '.' . $ext;
            $query_addService1 = "INSERT INTO menus (type ,category, name, price, image, description, status, poin) 
                                        VALUES ('service','$category', '$servicename', '$price', '$filenameondb', '$description', '$status', '$poin')";
            if (mysqli_query($link, $query_addService1)) {
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
                    setcookie('returnstatus', 'serviceadded', time() + (10), "/");
                } else {
                    setcookie('returnstatus', 'serviceadded', time() + (10), "/");
                    // I've no idea WHY, but it works so i let it be. (Jangan dihapus) 0_o
                }
                header("Location: ../service-menu.php");
            }
        } else {
            $query_addService = "INSERT INTO menus (type ,category, name, price, description, status, poin) 
                                        VALUES ('service','$category', '$servicename', '$price', '$description', '$status', '$poin')";
            if (mysqli_query($link, $query_addService)) {
                setcookie('returnstatus', 'serviceadded', time() + (10), "/");
                header("Location: ../service-menu.php");
            } else {
                setcookie('returnstatus', 'servicenotadded', time() + (10), "/");
                header("Location: ../service-menu.php");
            }
        }
    } else {
        setcookie('returnstatus', 'serviceexist', time() + (10), "/");
        header("Location: ../service-menu.php");
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