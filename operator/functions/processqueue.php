<?php
require_once '../../core/init.php';

if (isset($_POST['btnprocess'])) {
    $id = $_POST['btnprocess'];

    $query_select = "SELECT * FROM transactions WHERE id = '$id'";
    $execute_select = mysqli_query($link, $query_select);
    $data = mysqli_fetch_assoc($execute_select);

    if ($data['progress'] == 'waiting') {
        $current_user = $_SESSION['wig_user'];
        $query_update = "UPDATE transactions SET progress = 'working' , crew = '$current_user' WHERE id = '$id'";
        $execute_update = mysqli_query($link, $query_update);
        header("Location:../crew-index.php");
        setcookie('returnstatus', 'ok', time() + (10), "/");
    } else {
        setcookie('returnstatus', 'conflict', time() + (10), "/");
        header("Location:../crew-index.php");
    }
} else {
    header("Location:../crew-index.php");
}
