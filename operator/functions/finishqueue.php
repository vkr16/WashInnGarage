<?php


require_once '../../core/init.php';

if (isset($_POST['btnfinish'])) {
    $id = $_POST['btnfinish'];

    $current_user = $_SESSION['wig_user'];

    $query_select = "SELECT * FROM transactions WHERE id = '$id'";
    $execute_select = mysqli_query($link, $query_select);
    $data = mysqli_fetch_assoc($execute_select);

    if ($data['progress'] == 'working' && $data['crew'] == $current_user) {
        $query_update = "UPDATE transactions SET progress = 'finished' WHERE id = '$id'";
        $execute_update = mysqli_query($link, $query_update);
        header("Location:../crew-index.php");
        setcookie('returnstatus', 'ok', time() + (10), "/");
    } else {
        setcookie('returnstatus', 'conflictfinish', time() + (10), "/");
        header("Location:../crew-index.php");
    }
} else {
    header("Location:../crew-index.php");
}
