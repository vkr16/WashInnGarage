<?php
require_once "../core/init.php";

$query_getCarServices = "SELECT * FROM menus WHERE type = 'service' AND category = 'Car' AND status = 'active'";
$query_getMotorServices = "SELECT * FROM menus WHERE type = 'service' AND category = 'Motorcycle' AND status = 'active'";

$execute_CarServices = mysqli_query($link, $query_getCarServices);
$execute_MotorServices = mysqli_query($link, $query_getMotorServices);

$idNameEncoded = base64_encode('id');
$idValueEncoded = $_GET['mid'];
$id = base64_decode($idValueEncoded);
$query_getMemberDetail = "SELECT * FROM customers WHERE id = '$id'";
$execute_getMemberDetail = mysqli_query($link, $query_getMemberDetail);
$memberDetail = mysqli_fetch_assoc($execute_getMemberDetail);
if ($memberDetail['membership'] == 'customer') {
    $poinHide = 'hidden';
    $emailwidth = "col-md-12";
} else {
    $poinHide = '';
    $emailwidth = "col-md-7";
}

$query_getCars  = "SELECT * FROM vehicles WHERE owner_id = '$id' AND vehicletype = 'Mobil'";
$execute_getCars = mysqli_query($link, $query_getCars);

$query_getMotors  = "SELECT * FROM vehicles WHERE owner_id = '$id' AND vehicletype = 'Motor'";
$execute_getMotors = mysqli_query($link, $query_getMotors);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

        .form-control:focus {
            border-color: #17A2B8;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(23, 184, 176, 0.6);
        }
    </style>


    <nav class="navbar navbar-light bg-light shadow" style="font-family: 'Oswald', sans-serif;">
        <a class="navbar-brand" href="index.php">
            <img src="<?= $assets ?>/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            &nbsp; Wash Inn Garage
        </a>
    </nav>

    <div class="container mt-4 pb-5" style="padding-top: 50pt;">
        <div class="col-lg-8 offset-lg-2">
            <div class="card bg-light mt-5">
                <div class="card-body" id="customerID">
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Periksa Detail Informasi Anda</h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <form action="order-confirmation-member.php" method="post" name="formneworder">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="customername">Nama Lengkap </label>
                                    <input readonly required autocomplete="off" type="text" class="form-control" id="customername" name="customername" aria-describedby="nameHelp" value="<?= $memberDetail['fullname'] ?>">
                                    <input type="text" name="memberid" id="memberid" value="<?= $id ?>" hidden readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="customerphone">Nomor WhatsApp</label>
                                    <input readonly required autocomplete="off" type="text" class="form-control" id="customerphone" name="customerphone" value="<?= $memberDetail['phone'] ?>">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group <?= $emailwidth ?>">
                                    <label for="customeremail">Email</label>
                                    <input readonly autocomplete="off" type="text" class="form-control" id="customeremail" name="customeremail" value="<?= $memberDetail['email'] ?>">
                                </div>
                                <div class="form-group col-md-5" <?= $poinHide ?>>
                                    <label for="customerpoints">Poin Member </label>
                                    <input readonly autocomplete="off" type="text" class="form-control" id="customerpoints" name="customerpoints" value="<?= $memberDetail['membership_point'] ?> ">
                                    <input type="text" name="ismember" id="ismember" value="yes" hidden readonly>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between mx-auto">
                                <a href="check-membership.php" class="btn btn-secondary"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                                <a class="btn btn-info" onclick="switchView('customerID','vehicleID')" id="btnNext1">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
                            </div>
                    </div>
                </div>

                <div class="card-body" id="vehicleID" hidden>
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Masukkan Identitas Kendaraan</h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <div class="form-group">
                            <label for="vehicleType">Jenis Kendaraan</label><br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="vehicleType">
                                <label class="btn btn-outline-info active">
                                    <input type="radio" name="vehicleType" onchange="cekjenis()" id="jenismobil" value="Car" checked><i class="fas fa-car"></i> Mobil
                                </label>
                                <label class="btn btn-outline-info">
                                    <input type="radio" name="vehicleType" onchange="cekjenis()" id="jenismotor" value="Motorcycle"> Motor <i class="fas fa-motorcycle"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="savedplatnomor">Plat Nomor Kendaraan</label>
                            <select class="form-control platNomorField" id="savedplatnomorMobil" name="platNomor1" onclick="onmanual(value)">
                                <?php while ($vehicle = mysqli_fetch_assoc($execute_getCars)) { ?>
                                    <option><?= $vehicle['platnomor'] ?></option>
                                <?php
                                }
                                ?>
                                <option value="-">Masukkan Nomor Lainnya</option>
                            </select>
                            <select class="form-control platNomorField" id="savedplatnomorMotor" hidden name="platNomor1" onclick="onmanual(value)">
                                <?php while ($vehicle = mysqli_fetch_assoc($execute_getMotors)) { ?>
                                    <option><?= $vehicle['platnomor'] ?></option>
                                <?php
                                }
                                ?>
                                <option value="-">Masukkan Nomor Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group" id="manualInputPlatNomor">
                            <label for="platNomor">Nomor Plat Kendaraan </label>
                            <input type="text" class="form-control" id="platNomor" onkeyup="hidealertplatempty()" name="platNomor" aria-describedby="platHelp" placeholder="Nomor Plat Kendaraan">
                            <small id="platHelp" class="form-text text-muted">Contoh : AB 1999 FMA</small>
                        </div>
                        <div class="alert alert-danger" id="alertplatempty" hidden>
                            <i class="fas fa-exclamation-triangle"></i> &nbsp; Mohon Maaf, <strong>Plat Nomor</strong> Tidak Boleh Kosong
                        </div>
                        <div class="row d-flex justify-content-between mx-auto">
                            <a class="btn btn-secondary" onclick="switchView('vehicleID','customerID')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <a class="btn btn-info" onclick="isplatnomorempty('vehicleID','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
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
                            <small class="my-auto text-muted"><span id="availablemenucount">0</span> Pilihan menu tersedia</small>

                            <!-- <a class="btn btn-info" onclick="switchView('serviceMenu','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a> -->
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-info" id="menuPrevPageBtn" value="0" onclick="getMenu(value)"><i class="fas fa-chevron-left"></i></button>
                        <div class="col-md-10 px-0" id="menusspace">

                        </div>
                        <button type="button" class="btn btn-info" id="menuNextPageBtn" value="0" onclick="getMenu(value)"><i class="fas fa-chevron-right"></i></button type="button">
                    </div>
                </div>

                <div class="card-body" id="serviceDetail" hidden>
                    <div class="col-md-10 offset-md-1">
                        <div class="col-md-2 offset-md-5 mb-2">
                            <img src="../assets/img/logo.png" alt="" width="100%">
                        </div>
                        <hr>
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Konfirmasi Pilihan Anda</h3>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary" onclick="switchView('serviceDetail','serviceMenu')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <button type="submit" name="serviceID" id="btnSubmitToConfirmation" value="" class="btn btn-info " onclick="switchView('vehicleID','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></button>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="../assets/img/thumbnail/Express 250.jpg" alt="" width="100%" id="serviceDetailImage"><br><br>
                            </div>
                            <div class="col-md-7">
                                <h4 id="serviceDetailName">Express 250</h4>
                                <h5 id="serviceDetailPrice">Rp 25.000</h5>
                                <p class="text-justify" id="serviceDetailDesc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eum laudantium soluta, sed quaerat facilis reiciendis atque repellendus error, ut eaque recusandae minima illo quis ipsa praesentium ad delectus nostrum!</p>
                            </div>
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
    <script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            getMenu(0);
        });


        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        function onmanual(value) {
            console.log(value);
            if (value == "-") {
                document.getElementById("manualInputPlatNomor").hidden = false;
            } else {
                document.getElementById("manualInputPlatNomor").hidden = true;
            }
        }

        function switchView(hide, show) {
            document.getElementById(hide).hidden = true;
            document.getElementById(show).hidden = false;
            var position = document.getElementById("menuPrevPageBtn").value;
            cekjenis();
            getMenu(position);
            hidealertplatempty();
        }

        function cekjenis() {
            if (document.getElementById('jenismobil').checked == true) {
                document.getElementById('savedplatnomorMobil').hidden = false;
                document.getElementById('savedplatnomorMobil').disabled = false;
                document.getElementById('savedplatnomorMotor').hidden = true;
                document.getElementById('savedplatnomorMotor').disabled = true;
                if (document.getElementById("savedplatnomorMobil").value == '-') {
                    document.getElementById("manualInputPlatNomor").hidden = false;
                } else {
                    document.getElementById("manualInputPlatNomor").hidden = true;
                }
            } else if (document.getElementById('jenismotor').checked == true) {
                document.getElementById('savedplatnomorMobil').hidden = true;
                document.getElementById('savedplatnomorMobil').disabled = true;
                document.getElementById('savedplatnomorMotor').hidden = false;
                document.getElementById('savedplatnomorMotor').disabled = false;
                if (document.getElementById("savedplatnomorMotor").value == '-') {
                    document.getElementById("manualInputPlatNomor").hidden = false;
                } else {
                    document.getElementById("manualInputPlatNomor").hidden = true;
                }
            }
        }

        function isplatnomorempty(hide, show) {
            if (document.getElementById("manualInputPlatNomor").hidden == false && document.getElementById("platNomor").value == '') {
                document.getElementById("alertplatempty").hidden = false;
            } else {
                document.getElementById("alertplatempty").hidden = true;
                switchView(hide, show);
            }
        }

        function hidealertplatempty() {
            document.getElementById("alertplatempty").hidden = true;
        }

        function viewDetails(image, name, id, price, description, hide, show) {
            document.getElementById("serviceDetailName").innerHTML = name;
            document.getElementById("serviceDetailPrice").innerHTML = price;
            document.getElementById("serviceDetailDesc").innerHTML = description;
            document.getElementById("serviceDetailImage").src = '../assets/img/thumbnail/' + image;
            document.getElementById("btnSubmitToConfirmation").value = id;

            switchView(hide, show);
        }

        function getMenu(position) {

            if (document.getElementById('jenismobil').checked == true) {
                $.post("functions/getservices.php", {
                        limit: 6,
                        position: position,
                        getdata: true,
                        category: 'Car'
                    },
                    function(data) {
                        $("#menusspace").html(data);
                    });
                document.getElementById('LayananMobil').hidden = false;
                document.getElementById('LayananMotor').hidden = true;
            } else if (document.getElementById('jenismotor').checked == true) {
                $.post("functions/getservices.php", {
                        limit: 6,
                        position: position,
                        getdata: true,
                        category: 'Motorcycle'
                    },
                    function(data) {
                        $("#menusspace").html(data);
                    });
                document.getElementById('LayananMobil').hidden = true;
                document.getElementById('LayananMotor').hidden = false;
            }
        }
    </script>

</body>

</html>