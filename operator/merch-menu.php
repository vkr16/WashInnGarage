<?php
require_once 'operator-only.php';
$activePageLvl = 2;

$query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
$execute_getUser = mysqli_query($link, $query_getUser);
$i = 1;

$query_getMerchandise = "SELECT * FROM menus WHERE type = 'merchandise' AND status= 'active'";
$execute_getMerchandise = mysqli_query($link, $query_getMerchandise);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Active Menu</title>

  <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
  <link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
  <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- dataTable css -->
  <link href="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body class="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar Attach -->
    <?php require_once 'view-template/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar Attach -->
        <?php require_once 'view-template/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Active Menu </h1>

            <?php
            if (isset($_COOKIE['returnstatus'])) {
              if ($_COOKIE['returnstatus'] == 'itemadded') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>New Merchandise Item Added To The Menu</strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'itemnotadded') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Failed!</strong><br>Something abnormal happen, please try again.<hr>If error continues please contact developer. [ERR-883]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'itemexist') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Add New Item Failed. <br> Error :</strong> Item Name Already Exist In Menu 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'itemnotupdated') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Item Detail Update Failed. <br>Error : </strong>Service redundant or id not found. [ERR-274]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'serviceaddednotuploaded') {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                          <strong>New Service Added To The Menu With An Error. <br></strong>Thumbnail image not uploaded, unknown reason. [ERR-998]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'servicedeleted') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>An Item Has Been Deleted.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'servicenotdeleted') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Service Deletion Failed. <br>Error : </strong>Service not found.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'serviceupdated') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>A Service Has Been Updated.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'serviceredundant') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Update Service Failed. <br> Error :</strong> A Service With The Same Name Already Exist On The Menu
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              }
            }
            ?>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- User Manager -->
            <div class="col-xl-12 col-lg-12" id="panelUtama">
              <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-gift fa-fw"></i> Merchandise</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                  <table class="table table-striped" id="services">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Point Reward</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($merch = mysqli_fetch_assoc($execute_getMerchandise)) {
                        $checker = ($merch['status'] == 'active') ? 'checked' : '';
                        $status = ($merch['status'] == 'active') ? 'Active' : 'Inactive';
                        $points = $merch['poin'];
                        $type = ($merch['type'] == 'merchandise') ? 'Merchandise' : 'other';
                        $price = 'Rp ' . number_format($merch['price'], 0, ',', '.')
                      ?>
                        <tr onclick="openDetail('<?= $merch['image'] . '\',\'' . $merch['name'] . '\',\'' . $type . '\',\'' . $merch['stock'] . '\',\'' . $price . '\',\'' . $status . '\',\'' . $merch['description'] . '\',\'' . $merch['id'] . '\',\'' . $merch['price'] . '\',\'' . $merch['poin'] ?>')">
                          <th scope="row"><?= $i ?></th>
                          <td><a href="#" class="text-decoration-none"><?= $merch['name'] ?></a></td>
                          <td><?= $price ?></td>
                          <td><?= $merch['stock'] ?></td>
                          <td><i class="fab fa-product-hunt fa-fw"></i> +<?= $points ?></td>
                        </tr>
                      <?php $i++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--  -->
            <div class="col-xl-5 col-lg-5" hidden id="detailPanel">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary" id="rightPaneTitle"><i class="fas fa-info-circle fa-fw"></i> Item Detail</h5>
                  <a class="btn btn-danger" onclick="closeDetailPanel()"><i class="fas fa-times fa-fw"></i></a>

                </div>
                <!-- Card Body -->
                <div class="card-body" id="modeView">
                  <div class="row">
                    <div class="col-xl-5">
                      <div class="d-flex justify-content-center">
                        <img id="thumbnailShow" src="" class="rounded-lg border border-white shadow" width=100%>
                      </div>
                    </div>
                    <div class="col-xl-7">
                      <h5 class="mb-0 text-dark font-weight-bolder" id="merchNameShow"></h5>
                      <p class="mb-0" id="typeShow"></p>
                      <p class="mb-2" id="priceShow"></p>
                      <p class="mb-2">Point Reward : <span id="poinShow"></span> <i class="fab fa-product-hunt fa-fw fa-sm"></i></p>
                      <p class="mb-2 font-weight-bolder" id="statusShow"></p>
                    </div>
                  </div>
                  <hr>
                  <!-- <br> -->
                  <div class="col-xl-12 col-lg-12 text-dark">
                    <p class="font-weight-bolder">Description :</p>
                    <p class="text-justify" id="descriptionShow"></p>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer Attach -->
      <?php require_once "view-template/footer.php" ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>




  <!-- Bootstrap core JavaScript-->
  <script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?= $assets ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= $assets ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= $assets ?>/js/sb-admin-2.min.js"></script>

  <!-- dataTable js -->
  <script src="<?= $assets ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#services').DataTable();
    });





    function openDetail(thumbnail, name, type, stock, price, status, description, id, rawprice, poin) {
      document.getElementById('detailPanel').hidden = false;
      document.getElementById('modeView').hidden = false;


      document.getElementById('thumbnailShow').src = '../assets/img/thumbnail/' + thumbnail;
      document.getElementById('merchNameShow').innerHTML = name;
      document.getElementById('typeShow').innerHTML = type + ' - ' + stock + ' in Stock';
      document.getElementById('priceShow').innerHTML = price;
      document.getElementById('poinShow').innerHTML = poin;
      document.getElementById('descriptionShow').innerHTML = description;


      document.getElementById('panelUtama').className = 'col-xl-7 col-lg-7';
      if (status == 'Active') {
        document.getElementById('statusShow').innerHTML = '<i class="fas fa-dot-circle text-info"></i> On Sale';
      } else if (status == 'Inactive') {
        document.getElementById('statusShow').innerHTML = '<i class="far fa-dot-circle text-danger"></i> On Hold';
      }



    }

    function closeDetailPanel() {
      document.getElementById('detailPanel').hidden = true;
      document.getElementById('panelUtama').className = 'col-xl-12 col-lg-12';
    }
  </script>

</body>

</html>