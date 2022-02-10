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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("../assets/img/bg-cover-customer.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .form-control:focus {
            border-color: #17A2B8;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(23, 184, 176, 0.6);
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
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
                        <h3 class="font-weight-normal text-center text-dark">Silahkan Masukan Detail Informasi Anda</h3>
                        <hr>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <form action="order-confirmation.php" method="post" name="formneworder">
                            <div class="form-group">
                                <label for="customername">Nama Lengkap </label>
                                <input required onkeyup='hidenamealert()' autocomplete="off" type="text" class="form-control" id="customername" name="customername" aria-describedby="nameHelp" placeholder="Nama Lengkap">
                            </div>

                            <div hidden class="alert alert-danger" id="emptynamealert" role="alert">
                                Mohon maaf <strong>Nama</strong> tidak boleh kosong.
                            </div>

                            <div class="form-group">
                                <label for="customerphone">Nomor WhatsApp</label>
                                <input required onkeyup='hidephonealert()' autocomplete="off" type="number" class="form-control" id="customerphone" name="customerphone" placeholder="Nomor WhatsApp">
                            </div>

                            <div hidden class="alert alert-danger" id="emptyphonealert" role="alert">
                                Mohon maaf <strong>Nomor WhatsApp</strong> tidak boleh kosong.
                            </div>

                            <div class="form-group">
                                <label for="customeremail">Email <small>(Opsional)</small></label>
                                <input autocomplete="off" type="text" class="form-control" id="customeremail" name="customeremail" placeholder="Email" onkeyup="ValidateEmail(document.formneworder.customeremail)">
                                <small class="text-danger" hidden id="emailalert"><i class="fas fa-exclamation-triangle"></i> Format email tidak lengkap / tidak valid</small>
                                <small class="text-danger" hidden id="emailalert2"><br><i class="fas fa-exclamation-triangle"></i> Untuk mendaftar sebagai member email wajib diisi</small>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="registermembership" name="registermembership" onclick="checkEmailField()">
                                <label class="form-check-label" for="registermembership">Daftarkan Saya Sebagai Member </label>
                            </div>



                            <div class="row d-flex justify-content-between mx-auto">
                                <a href="index.php" class="btn btn-secondary"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                                <a class="btn btn-info" onclick="firstnextbtn('customerID','vehicleID')" id="btnNext1">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
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
                            <input required onkeyup='hideplatalert()' type="text" class="form-control" id="platNomor" name="platNomor" aria-describedby="platHelp" placeholder="Nomor Plat Kendaraan">
                            <small id="platHelp" class="form-text text-muted">Contoh : AD 1998 XYZ</small>
                        </div>

                        <div hidden class="alert alert-danger" id="emptyplatalert" role="alert">
                            Mohon maaf <strong>Nomor plat kendaraan</strong> tidak boleh kosong.
                        </div>

                        <div class="row d-flex justify-content-between mx-auto">
                            <a class="btn btn-secondary" onclick="switchView('vehicleID','customerID')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <a class="btn btn-info" onclick="secondnextbtn('vehicleID','serviceMenu')">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></a>
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
                        <h6 class="font-weight-light text-center text-muted">Klik pada item menu untuk menampilkan deskripsi</h6>
                        <hr>
                        <div class="row d-flex justify-content-between mx-auto">
                            <a class="btn btn-secondary" onclick="switchView('serviceMenu','vehicleID')"><i class="fas fa-chevron-left fa-fw fa-sm"></i> Kembali</a>
                            <small class="my-auto text-muted"><span id="availablemenucount">0</span> Pilihan menu tersedia</small>
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
                            <button type="submit" name="serviceID" id="btnSubmitToConfirmation" value="" class="btn btn-info " onclick="errorempty()">Selanjutnya <i class="fas fa-chevron-right fa-fw fa-sm"></i></button>
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

        function switchView(hide, show) {
            document.getElementById(hide).hidden = true;
            document.getElementById(show).hidden = false;
            // cekjenis();
            var position = document.getElementById("menuPrevPageBtn").value;
            getMenu(position);
        }

        function cekjenis() {
            if (document.getElementById('jenismobil').checked == true) {
                document.getElementById('LayananMobil').hidden = false;
                // document.getElementById('LayananMotor').hidden = true;
            } else if (document.getElementById('jenismotor').checked == true) {
                // document.getElementById('LayananMobil').hidden = true;
                document.getElementById('LayananMotor').hidden = false;
            }
        }

        function ValidateEmail(newemail) {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (newemail.value.match(mailformat) || newemail.value == '') {
                document.getElementById("emailalert").hidden = true;
                document.getElementById("emailalert2").hidden = true;

                return true;
            } else {
                document.getElementById("emailalert").hidden = false;
                return false;
            }
        }

        function checkEmailField() {
            if (document.getElementById('customeremail').value == '' || document.getElementById('emailalert').hidden == false) {
                document.getElementById('emailalert2').hidden = false;
                document.getElementById('registermembership').checked = false;
            } else {
                document.getElementById('emailalert2').hidden = true;
            }
        }

        function viewDetails(image, name, id, price, description, hide, show) {
            // document.getElementById("serviceDetailId").value = id;
            document.getElementById("serviceDetailName").innerHTML = name;
            document.getElementById("serviceDetailPrice").innerHTML = price;
            document.getElementById("serviceDetailDesc").innerHTML = description;
            document.getElementById("serviceDetailImage").src = '../assets/img/thumbnail/' + image;
            document.getElementById("btnSubmitToConfirmation").value = id;

            switchView(hide, show);
        }

        function firstnextbtn(hide, show) {
            var customername = document.getElementById("customername").value;
            var customerphone = document.getElementById("customerphone").value;

            if (customername == '' || customerphone == '') {
                if (customername == '') {
                    document.getElementById("emptynamealert").hidden = false;
                }
                if (customerphone == '') {
                    document.getElementById("emptyphonealert").hidden = false;
                }
            } else {
                document.getElementById("emptyphonealert").hidden = true;
                document.getElementById("emptynamealert").hidden = true;
                switchView(hide, show);
            }
        }

        function hidenamealert() {
            document.getElementById("emptynamealert").hidden = true;
        }

        function hidephonealert() {
            document.getElementById("emptyphonealert").hidden = true;
        }

        function secondnextbtn(hide, show) {
            var platNomor = document.getElementById("platNomor").value;
            if (platNomor == '') {
                document.getElementById("emptyplatalert").hidden = false;
            } else {
                document.getElementById("emptyplatalert").hidden = true;
                switchView(hide, show);
            }
        }

        function hideplatalert() {
            document.getElementById("emptyplatalert").hidden = true;
        }

        function getMenu(position) {
            // var invoice = document.getElementById("tdinvoicenumber").innerHTML;

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