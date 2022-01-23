<?php

require_once "../../core/init.php";

if (isset($_POST['btnAddServiceMenu'])) {
    $servicename = $_POST['servicename'];
    $category    = $_POST['category'];
    $image       = $_POST['thumbnail'];
    $price       = $_POST['serviceprice'];
    $description = $_POST['servicedesc'];

    if (isset($_POST['activate'])) {
        $status = 'active';
    } else {
        $status = 'inactive';
    }

    if (!empty($_FILES['thumbnail'])) {
        $path  = $_SERVER['DOCUMENT_ROOT'] . "/WashInnGarage/assets/img/thumbnail/";
        $path2 = $_FILES['thumbnail']['name'];
        $ext   = pathinfo($path2, PATHINFO_EXTENSION);
        $path  = $path . $servicename . '.' . $ext;
        
        $query_addService1 = "INSERT INTO menus (category, name, price, image, description, status) 
                                    VALUES ('$category', '$servicename', '$price', '$path2', '$description', '$status')";
        
        if (mysqli_query($link, $query_addService1)) {
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
                setcookie('returnstatus', 'serviceadded', time() + (10), "/");
            }else{
                setcookie('returnstatus', 'serviceadded', time() + (10), "/");
	            // I've no idea WHY, but it works so i let it be. (Jangan dihapus)
            }
            header("Location: ../service-menu.php");
        }
    } else {
        $query_addService = "INSERT INTO menus (category, name, price, description, status) 
                                    VALUES ('$category', '$servicename', '$price', '$description', '$status')";
        if (mysqli_query($link, $query_addService)) {
            setcookie('returnstatus', 'serviceadded', time() + (10), "/");
            header("Location: ../service-menu.php");
        } else {
            setcookie('returnstatus', 'servicenotadded', time() + (10), "/");
            header("Location: ../service-menu.php");
        }
    }
}

?>