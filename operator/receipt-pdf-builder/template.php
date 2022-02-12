<?php
require_once '../../core/init.php';
if (isset($_POST['invoicenumber'])) {
  $invoice = $_POST['invoicenumber'];
  // $invoice = 'INV/2022/0203/8';
  $total = 0;
  $poin = 0;

  $query_getTrx = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
  $execute_getTrx = mysqli_query($link, $query_getTrx);
  $Trx = mysqli_fetch_assoc($execute_getTrx);

  $date = date_create($Trx['completedate']);
  $date = date_format($date, "d-m-Y");
  $trx_id = $Trx['id'];
  $query_getOrders = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status ='completed'";
  $execute_getOrders = mysqli_query($link, $query_getOrders);
  $Orders = mysqli_fetch_assoc($execute_getOrders);

  $customer_id = $Orders['customer_id'];
  $query_getCustomer = "SELECT * FROM customers WHERE id = '$customer_id'";
  $execute_getCustomer = mysqli_query($link, $query_getCustomer);
  $Customer = mysqli_fetch_assoc($execute_getCustomer);

  $platnomor = $Orders['platnomor'];
  $query_getVehicle = "SELECT * FROM vehicles WHERE platnomor = '$platnomor'";
  $execute_getVehicle = mysqli_query($link, $query_getVehicle);
  $Vehicle = mysqli_fetch_assoc($execute_getVehicle);
} ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/vendor/fontawesome-free/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <title>Hello, world!</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lobster&family=Nunito:wght@300&display=swap');
  </style>
</head>

<body onload="downloadPDF('<?= $Trx['receipt_number'] ?>')">
  <div class="col-md-4 offset-md-4 d-flex justify-content-center mt-3 mb-3">
    <!-- <button class="btn btn-outline-danger" onclick="downloadPDF('<?= $Trx['receipt_number'] ?>')"><i class="fas fa-file-pdf fa-fw"></i> Export</button> -->
    <h4 style="font-family: nunito;">Generating PDF Receipt. . . . .</h4>
  </div>
  <div class="col-md-12" hidden>
    <div class="card">
      <div class="card-body" id="printbody">
        <div class="row">
          <div class="col-md-3 pr-0">
            <img src="../../assets/img/logo.png" width=80%>
          </div>
          <div class="col-md-6 pl-0">
            <h2 style="font-family: 'Lobster', cursive;">Wash Inn garage</h2>
            <p>
              <i class=" fab fa-instagram fa-fw fa-sm"></i> @washinn.garage
              <br>
              <i class="fab fa-whatsapp fa-fw fa-sm"></i> +62 812 1790 1009
              <br>
              <i class="fas fa-map-marker-alt fa-fw fa-sm "></i> Jl. Garuda Mas No.3, Pabelan, Kartasura, <br> &emsp; Sukoharjo, Jawa Tengah. 57162
            </p>
          </div>
        </div>
        <hr>

        <!-- main tamplating forms -->
        <div class="row d-flex justify-content-between mx-auto" style="font-family: Nunito;">
          <span><strong>Tanggal :</strong> <?= $Trx['completedate'] ?></span>
          <span class="text-right"><strong>No. Nota :</strong> <?= $Trx['receipt_number'] ?> <br> <strong> Status :</strong> LUNAS</span>
        </div>
        <hr>
        <div class="row d-flex justify-content-between mx-auto" style="font-family: Nunito;">
          <div class="">
            <p class="mb-0 font-weight-bold">Pelanggan</p>
            <span>
              <p class="mb-0 mt-0"> <?= $Orders['customer_name'] ?> </p>
              <p class="mb-0 mt-0"> <?= $Orders['customer_phone'] ?> </p>
              <p class="mb-0 mt-0"> <?= $Orders['customer_email'] ?> </p>
            </span>
          </div>
          <div class=" text-right">
            <p class="mb-0 font-weight-bold">Kendaraan</p>
            <span>
              <p class="mb-0 mt-0"> <?= $Vehicle['vehicletype'] ?> </p>
              <p class="mb-0 mt-0"> <?= $platnomor ?></p>
            </span>
          </div>
        </div>
        <hr>
        <!-- Tabel Data Pesanan -->
        <table class="table table-sm">
          <thead>
            <th>Layanan / Item</th>
            <th class="text-center">Jumlah</th>
            <th class="text-right">Subtotal</th>
          </thead>
          <tbody>


            <?php
            $query_getOrders2 = "SELECT * FROM orders WHERE trx_id = '$trx_id' AND order_status ='completed'";
            $execute_getOrders2 = mysqli_query($link, $query_getOrders2);
            while ($Orders = mysqli_fetch_assoc($execute_getOrders2)) {
              $menu_id = $Orders['menu_id'];
              $query_getMenu = "SELECT * FROM menus WHERE id = '$menu_id'";
              $execute_getMenu = mysqli_query($link, $query_getMenu);
              $Menu = mysqli_fetch_assoc($execute_getMenu);
              $qty = $Orders['amount'];
              $price = $Menu['price'];
              $poinpermenu = $Menu['poin'];
              $poinorder = $poinpermenu * $qty;
              $subtotal = $qty * $price;
              $total = $total + $subtotal;
              $poin = $poin + $poinorder;
            ?>
              <tr>
                <td><?= $Menu['name'] ?></td>
                <td class=" text-center"><?= $qty ?></td>
                <td class="text-right"><?= 'Rp ' . number_format($subtotal, 0, ',', '.') ?></td>
              </tr>
            <?php
            }
            ?>



            <tr>
              <td></td>
              <th class=" text-right">Total : </th>
              <td class="text-right"><?= 'Rp ' . number_format($total, 0, ',', '.') ?></td>
            </tr>
            <?php if ($Customer['membership'] == 'member') { ?>
              <tr>
                <td></td>
                <th class=" text-right">Poin : </th>
                <td class="text-right">+ <?= $poin ?> <i class="fab fa-product-hunt fa-fw"></i></td>
              </tr>
              <tr>
                <td></td>
                <th class=" text-right">Total Poin : </th>
                <td class="text-right"><?= $Customer['membership_point'] ?> <i class="fab fa-product-hunt fa-fw"></i></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <br>
        <div class="row d-flex justify-content-between mx-auto" style="font-family: Nunito;">
          <div class="">

          </div>
          <div class=" text-right">
            <span>
              <p class="mb-0 font-weight-bold">Operator / Kasir</p>
              <!-- <br> -->
              <p class="mb-0 mt-0"> <?= $Trx['operator_name'] ?> </p>
            </span>
          </div>
        </div>

        <hr>
        <div class="text-center" style="font-family: lobster;">
          <h4>Terima Kasih Atas Kunjungan Anda</h4>
          <h5>- Wash Inn Garage -</h5>

        </div>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script>
    function downloadPDF(receipt) {
      const element = document.getElementById("printbody");
      var opt = {
        margin: [4, 6, 0, 6],
        filename: receipt + '.pdf',
        image: {
          type: 'jpeg',
          quality: 1
        },
        html2canvas: {
          scale: 6
        },
        jsPDF: {
          unit: 'mm',
          format: 'letter',
          orientation: 'portrait'
        }
      };

      // New Promise-based usage:
      html2pdf().set(opt).from(element).save();
      // Simulate an HTTP redirect:
      setTimeout(redirect, 1500);
    }

    function redirect() {
      history.back();
    }
  </script>
</body>

</html>