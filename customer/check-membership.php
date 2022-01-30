<?php
require_once "../core/init.php";

if (isset($_POST['btnCheckMembership'])) {
    $phoneRAW = $_POST['customerphone'];

    // extracting phone number to be converted to be useable with whatsapp api
    if ($phoneRAW[0] == '0') {
        $customerphone = '62' . substr($phoneRAW, 1);
    } elseif (substr($phoneRAW, 0, 3) == "+62") {
        $customerphone = '62' . substr($phoneRAW, 3);
    } else {
        $customerphone = $phoneRAW;
    }


    // query check membership status
    $query_checkMembership = "SELECT * FROM customers WHERE phone = '$customerphone'";
    $execute_checkMembership = mysqli_query($link, $query_checkMembership);
    $count_checkMembership = mysqli_num_rows($execute_checkMembership);

    if ($count_checkMembership == 1) {
        $memberDetail = mysqli_fetch_assoc($execute_checkMembership);
        $id = $memberDetail['id'];
        $idValue = base64_encode($id);
        header("Location:member-customer.php?mid=" . $idValue);
    } else {
        $error  = "error";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
    <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">



    <title>Wash Inn Garage</title>
</head>

<body>
    <style>
        body {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("../assets/img/bg-cover-customer.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Raleway&display=swap');
    </style>


    <nav class="navbar navbar-light bg-light shadow" style="font-family: 'Oswald', sans-serif;">
        <a class="navbar-brand" href="index.php">
            <img src="<?= $assets ?>/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            &nbsp; Wash Inn Garage
        </a>
    </nav>



    <div class="container mt-4 pb-5">
        <div class="col-lg-8 offset-lg-2">
            <div class="card bg-light mt-5">
                <div class="card-body" id="customerID">
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Masukan Nomor Telepon Anda </h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="customerphone">No. HP / WhatsApp </label>
                                <input required autocomplete="off" type="text" class="form-control" id="customerphone" name="customerphone" aria-describedby="nameHelp" placeholder="No. HP / WhatsApp">
                            </div>

 <?php if (isset($error)) {
                                echo ' <div class="alert alert-danger" role="alert">
                                      Mohon maaf <strong>No. HP / WhatsApp</strong> anda belum terdaftar.
                                    </div>';
                            } ?>

                            <div class="row d-flex justify-content-between mx-auto">
                                <a href="index.php" class="btn btn-secondary"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary" id="btnCheckMembership" name="btnCheckMembership">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></button>
                            </div>
                           
                           
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted"> Copyright &copy; Wash Inn Garage 2022 <br>All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>