<?php
require_once "../core/init.php";
if (isset($_POST['customername'])) {
    $customername = $_POST['customername'];
    $customerphone = $_POST['customerphone'];
    $customeremail = $_POST['customeremail'];

    if (isset($_POST['registermembership'])) {
        $registermembership = 'yes';
    } else {
        $registermembership = 'no';
    }

    $vehicleType = $_POST['vehicleType'];
    $platNomor = $_POST['platNomor'];
    $serviceID = $_POST['serviceID'];
    $price = '40000';
    $priceformated = 'Rp ' . number_format($price, 0, ',', '.');
} else {
    header("Location:index.php");
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
            background-image: url('<?= $assets ?>/img/bg-cover-customer.jpg');
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.65);
            background-repeat: no-repeat;
        }

        .bg-semi-light {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .bg-transparent {
            background-color: transparent;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Raleway&display=swap');
    </style>


    <nav class="navbar navbar-light bg-semi-light shadow" style="font-family: 'Oswald', sans-serif;">
        <a class="navbar-brand" href="index.php">
            <img src="<?= $assets ?>/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            &nbsp; Wash Inn Garage
        </a>
    </nav>



    <div class="container">
        <div class="col-lg-10 offset-lg-1">
            <div class="card bg-semi-light mt-4 mb-5">
                <div class="card-body mb-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Periksa Detail Pesanan Anda</h3>
                        <hr>
                        <a href="new-customer.php" class="btn btn-secondary"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Batal</a>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4 row">
                        <div class="col-md-5">
                            <img src="../assets/img/thumbnail/Express 250.jpg" class="rounded" alt="" width="100%">
                        </div>
                        <div class="col-md-7">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <td> : </td>
                                        <td><?= $customername ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. HP / WhatsApp</th>
                                        <td> : </td>
                                        <td><?= $customerphone ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td> : </td>
                                        <td><?= $customeremail ?></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <tr>
                                        <th>Kendaraan</th>
                                        <td> : </td>
                                        <td><?= $vehicleType ?></td>
                                    </tr>
                                    <tr>
                                        <th>Plat Nomor</th>
                                        <td> : </td>
                                        <td><?= $platNomor ?></td>
                                    </tr>
                                    <tr>
                                        <th>Paket Layanan</th>
                                        <td> : </td>
                                        <td><?= $serviceID ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Harga</th>
                                        <td> : </td>
                                        <td><?= $priceformated ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 d-flex justify-content-center">
                        <button class="btn btn-lg btn-primary">Konfirmasi Pesanan</button>
                    </div>
                    <hr class="col-md-10 offset-md-1">
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