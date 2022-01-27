<?php
require_once "../core/init.php";

$query_getCarServices = "SELECT * FROM menus WHERE type = 'service' AND category = 'Car' AND status = 'active'";
$query_getMotorServices = "SELECT * FROM menus WHERE type = 'service' AND category = 'Motorcycle' AND status = 'active'";

$execute_CarServices = mysqli_query($link, $query_getCarServices);
$execute_MotorServices = mysqli_query($link, $query_getMotorServices);
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
            background-color: rgba(255, 255, 255, 0.7);
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



    <div class="container mt-4 pb-5">
        <div class="col-lg-8 offset-lg-2">
            <div class="card bg-light mt-5">
                <div class="card-body" id="customerID">
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Masukan Detail Informasi Anda</h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <form action="order-confirmation.php" method="post">
                            <div class="form-group">
                                <label for="customername">Nama Lengkap </label>
                                <input required autocomplete="off" type="text" class="form-control" id="customername" name="customername" aria-describedby="nameHelp" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="customerphone">No. HP / WhatsApp</label>
                                <input required autocomplete="off" type="text" class="form-control" id="customerphone" name="customerphone" placeholder="No. HP / WhatsApp">
                            </div>
                            <div class="form-group">
                                <label for="customeremail">Email <small>(Opsional)</small></label>
                                <input required autocomplete="off" type="text" class="form-control" id="customeremail" name="customeremail" placeholder="Email">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="registermembership" name="registermembership">
                                <label class="form-check-label" for="registermembership">Daftarkan Saya Dalam Program Keanggotaan </label>
                            </div>
                            <div class="row d-flex justify-content-between mx-auto">
                                <a href="index.php" class="btn btn-secondary"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                                <a class="btn btn-primary" onclick="switchView('customerID','vehicleID')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
                            </div>
                    </div>
                </div>

                <div class="card-body" id="vehicleID" hidden>
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Masukan Identitas Kendaraan</h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <div class="form-group">
                            <label for="vehicleType">Jenis Kendaraan</label><br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="vehicleType">
                                <label class="btn btn-outline-info active">
                                    <input type="radio" name="vehicleType" id="jenismobil" value="Car" checked><i class="fas fa-car"></i> Mobil
                                </label>
                                <label class="btn btn-outline-info">
                                    <input type="radio" name="vehicleType" id="jenismotor" value="Motorcycle"> Motor <i class="fas fa-motorcycle"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="platNomor">Nomor Plat Kendaraan </label>
                            <input type="text" class="form-control" id="platNomor" name="platNomor" aria-describedby="platHelp" placeholder="Nomor Plat Kendaraan">
                            <small id="platHelp" class="form-text text-muted">Contoh : AB 1998 XYZ</small>
                        </div>
                        <div class="row d-flex justify-content-between mx-auto">
                            <a class="btn btn-secondary" onclick="switchView('vehicleID','customerID')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <a class="btn btn-primary" onclick="switchView('vehicleID','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="serviceMenu" hidden>
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Pilih Layanan Yang Diinginkan</h3>
                        <h6 class="font-weight-light text-center text-muted">Klik pada gambar untuk menampilkan deskripsi</h6>
                        <hr>
                        <div class="row d-flex justify-content-between mx-auto">
                            <a class="btn btn-secondary" onclick="switchView('serviceMenu','vehicleID')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <!-- <a class="btn btn-primary" onclick="switchView('serviceMenu','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a> -->
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <div class="row" id="LayananMobil">
                            <?php while ($service = mysqli_fetch_assoc($execute_CarServices)) { ?>
                                <div class="col-md-4 mb-3">
                                    <a href="#collapse_<?= $service['id'] ?>" data-toggle="collapse">
                                        <img src="../assets/img/thumbnail/<?= $service['image'] ?>" alt="" style="width: 100%;" class="img-thumbnail shadow">
                                    </a>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button type="submit" class="btn btn-outline-primary" value="<?= $service['id'] ?>" name="serviceID"><?= $service['name'] ?></button>
                                    </div>
                                    <h6 class="text-weight-light text-dark text-center mt-2"><?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?></h6>
                                    <div class="collapse" id="collapse_<?= $service['id'] ?>">
                                        <p class="text-justify "><small><?= $service['description'] ?></small></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row" id="LayananMotor">
                            <?php while ($service = mysqli_fetch_assoc($execute_MotorServices)) { ?>
                                <div class="col-md-4 mb-3">
                                    <a href="#collapse_<?= $service['id'] ?>" data-toggle="collapse">
                                        <img src="../assets/img/thumbnail/<?= $service['image'] ?>" alt="" style="width: 100%;" class="img-thumbnail shadow">
                                    </a>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button type="submit" class="btn btn-outline-primary" value="<?= $service['id'] ?>" name="serviceID"><?= $service['name'] ?></button>
                                    </div>
                                    <h6 class="text-weight-light text-dark text-center mt-2"><?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?></h6>
                                    <div class="collapse" id="collapse_<?= $service['id'] ?>">
                                        <p class="text-justify "><small><?= $service['description'] ?></small></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        </form>
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

    <script>
        function switchView(hide, show) {
            document.getElementById(hide).hidden = true;
            document.getElementById(show).hidden = false;
            cekjenis();
        }

        function cekjenis() {
            if (document.getElementById('jenismobil').checked == true) {
                document.getElementById('LayananMobil').hidden = false;
                document.getElementById('LayananMotor').hidden = true;
            } else if (document.getElementById('jenismotor').checked == true) {
                document.getElementById('LayananMobil').hidden = true;
                document.getElementById('LayananMotor').hidden = false;
            }
        }
    </script>

</body>

</html>