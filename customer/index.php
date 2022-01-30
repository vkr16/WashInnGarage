<?php
require_once "../core/init.php";
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

    .bg-semi-dark {
      background-color: rgba(255, 255, 255, 0.65);
    }

    .bg-transparent {
      background-color: transparent;
    }
  </style>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Raleway&display=swap');
  </style>


  <nav class="navbar navbar-dark bg-semi-dark shadow" style="font-family: 'Oswald', sans-serif;">
    <a class="navbar-brand" href="index.php">
      <img src="<?= $assets ?>/img/logo-white.png" width="30" height="30" class="d-inline-block align-top" alt="">
      &nbsp; Wash Inn Garage
    </a>
  </nav>



  <div class="container">
    <div class="col-lg-10 offset-lg-1">
      <div class="card mt-4">
        <div class="card-body ">
          <div class="col-md-8 offset-md-2">

            <h1 class="text-center display-4"><strong> Selamat Datang</strong></h1><br>
            <h5 class="font-weight-light text-center">Silahkan Masukan Detail Informasi <br> dan Layanan Yang Ingin Anda Pesan</h5>
          </div>
          <div class="col-md-8 offset-md-2 d-flex justify-content-between mt-4">
            <a href="new-customer.php" class="btn btn-info btn-lg text-light">Pelanggan Baru</a>
            <a href="check-membership.php" class="btn btn-info btn-lg text-light">Sudah Pernah Datang</a>
          </div>
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