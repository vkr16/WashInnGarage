<?php
require_once 'admin-only.php';
$activePageLvl = 4;
$query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
$execute_getUser = mysqli_query($link, $query_getUser);
$i = 1;
$query_getServices = "SELECT * FROM menus WHERE type = 'service'";
$execute_getServices = mysqli_query($link, $query_getServices);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Menu</title>

  <link rel="icon" type="image/png" href="<?= $assets ?>/img/logo.png">
  <link rel="stylesheet" type="text/css" href="<?= $assets ?>/css/sb-admin-2.min.css">
  <link href="<?= $assets ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body class="page-top">
  <div id="wrapper">
    <?php require_once 'view-template/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php require_once 'view-template/topbar.php'; ?>
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Menu </h1>
            <?php
            if (isset($_COOKIE['returnstatus'])) {
              if ($_COOKIE['returnstatus'] == 'serviceadded') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>New Service Added To The Menu</strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'servicenotadded') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Failed!</strong><br>Something abnormal happen, please try again.<hr>If error continues please contact developer.
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
                                          <strong>A Service Has Been Deleted.<br></strong>
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
              } elseif ($_COOKIE['returnstatus'] == 'servicenotupdated') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Service Update Failed. <br>Error : </strong>Service redundant or id not found. [ERR-274]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
              } elseif ($_COOKIE['returnstatus'] == 'serviceexist') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Add New Service Failed. <br> Error :</strong> Service Already Exist In Menu 
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
          <div class="row">
            <div class="col-xl-12 col-lg-12" id="panelUtama">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-toolbox fa-fw"></i> Services</h5>
                  <a data-toggle="modal" data-target="#addMenuModal" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> Add Menu</a>
                </div>
                <div class="card-body">
                  <table class="table table-striped" id="services">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($service = mysqli_fetch_assoc($execute_getServices)) {
                        $checker = ($service['status'] == 'active') ? 'checked' : '';
                        $status = ($service['status'] == 'active') ? 'Active' : 'Inactive';
                        $type = ($service['type'] == 'service') ? 'Service' : 'other';
                        $price = 'Rp ' . number_format($service['price'], 0, ',', '.')
                      ?>
                        <tr onclick="openDetail('<?= $service['image'] . '\',\'' . $service['name'] . '\',\'' . $type . '\',\'' . $service['category'] . '\',\'' . $price . '\',\'' . $status . '\',\'' . $service['description'] . '\',\'' . $service['id'] . '\',\'' . $service['price'] . '\',\'' . $service['poin'] ?>')">
                          <th scope="row"><?= $i ?></th>
                          <td><a href="#" class="text-decoration-none"><?= $service['name'] ?></a></td>
                          <td><?= $price ?></td>
                          <td><?= $service['category'] ?></td>
                          <td><?= $status ?></td>
                        </tr>
                      <?php $i++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-xl-5 col-lg-5" hidden id="detailPanel">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary" id="rightPaneTitle"><i class="fas fa-info-circle fa-fw"></i> Service Detail</h5>
                  <a class="btn btn-danger" onclick="closeDetailPanel()"><i class="fas fa-times fa-fw"></i></a>
                </div>
                <div class="card-body" id="modeView">
                  <div class="row">
                    <div class="col-xl-5">
                      <div class="d-flex justify-content-center">
                        <img id="thumbnailShow" src="" class="rounded-lg border border-white shadow" width=100%>
                      </div>
                    </div>
                    <div class="col-xl-7">
                      <h5 class="mb-0 text-dark font-weight-bolder" id="servicenameShow"></h5>
                      <p class="mb-0" id="typeShow"></p>
                      <p class="mb-2" id="priceShow"></p>
                      <p class="mb-2">Point Reward : <span id="poinShow"></span> <i class="fab fa-product-hunt fa-fw fa-sm"></i></p>
                      <p class="mb-2 font-weight-bolder" id="statusShow"></p>
                    </div>
                  </div>
                  <hr>
                  <div class="col-xl-12 col-lg-12 text-dark">
                    <p class="font-weight-bolder">Description :</p>
                    <p class="text-justify" id="descriptionShow"></p>
                  </div>
                  <hr>
                  <div class="row mx-2 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary" onclick="changeMode()">
                      <i class="fas fa-edit fa-fw fa-sm"></i> Edit </a>
                    &emsp;
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteservice">
                      <i class="fas fa-trash-alt fa-fw fa-sm"></i> Delete </a>
                  </div>
                </div>
                <div class="card-body" id="modeEdit" hidden>
                  <form action="functions/update-service-menu.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="updateCategory">Category</label>
                        <select id="updateCategory" class="form-control" name="category">
                          <option selected value="Car">Car</option>
                          <option value="Motorcycle">Motorcycle</option>
                        </select>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="updateServiceName">Service Name</label>
                        <input required autocomplete="off" type="text" class="form-control" id="updateServiceName" placeholder="Service Name" name="servicename">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="updateServicePrice">Price</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                          </div>
                          <input required autocomplete="off" type="number" class="form-control" id="updateServicePrice" placeholder="50000" name="serviceprice">
                        </div>
                      </div>
                      <div class="form-group col-md-5">
                        <label for="updateFileImage">Thumbnail (Optional) </label>
                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" onchange="imageSelected2()" id="updateImage" accept=".jpg" name="thumbnail2">
                            <label class="custom-file-label" for="updateImage" id="updateImageLabel">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="updatePoin">Poin</label>
                        <input required autocomplete="off" type="number" class="form-control" id="updatePoin" placeholder="Poin" name="poin">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="updateServiceDesc">Service Description (Optional)</label>
                        <textarea autocomplete="off" class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this service" name="servicedesc" id="updateServiceDesc"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="setActiveStatus" name="activate">
                        <label class="custom-control-label" for="setActiveStatus">Set as Active</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <a class="btn btn-secondary" onclick="changeMode()">Cancel</a> &emsp;
                        <input type="text" name="serviceidhidden" id="serviceidhidden" hidden readonly>
                        <button type="submit" name="btnUpdateService" class="btn btn-primary">Save <i class="fas fa-save fa-fw fa-sm"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once "view-template/footer.php" ?>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal Add New Menu -->
  <div class="modal fade " data-backdrop="static" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Add New Service To Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="functions/add-service-menu.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputCategory">Category</label>
                <select id="inputCategory" class="form-control" name="category">
                  <option selected value="Car">Car</option>
                  <option value="Motorcycle">Motorcycle</option>
                </select>
              </div>
              <div class="form-group col-md-8">
                <label for="inputServiceName">Service Name</label>
                <input required autocomplete="off" type="text" class="form-control" id="inputServiceName" placeholder="Service Name" name="servicename">
              </div>
              <div class="form-group col-md-4">
                <label for="inputServicePrice">Price</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                  </div>
                  <input required autocomplete="off" type="number" class="form-control" id="inputServicePrice" placeholder="50000" name="serviceprice">
                </div>
              </div>
              <div class="form-group col-md-5">
                <label for="inputFileImage">Thumbnail Image (Optional) </label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" onchange="imageSelected()" id="inputFileImage" accept=".jpg" name="thumbnail">
                    <label class="custom-file-label" for="inputFileImage" id="inputFileImageLabel">Choose file</label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label for="inputPoin">Poin</label>
                <input required autocomplete="off" type="number" class="form-control" id="inputPoin" placeholder="Poin" name="poin">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="inputServiceDesc">Service Description (Optional)</label>
                <textarea autocomplete="off" class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this service" name="servicedesc"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="setActiveCheck" name="activate">
                <label class="custom-control-label" for="setActiveCheck">Set as Active</label>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
          <button type="submit" name="btnAddServiceMenu" class="btn btn-primary">Save <i class="fas fa-save fa-fw"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Add New Menu  END-->

  <!-- Modal confirm delete service -->
  <div class="modal fade" id="deleteservice" tabindex="-1" aria-labelledby="deleteserviceLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm To Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="font-weight-bolder text-dark" id="deleteTitle">[ Express Plus ]</h4>
          Are you sure want to delete this menu?
        </div>
        <div class="modal-footer">
          <form action="functions/delete-menu.php" method="post">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <input type="password" name="hiddenServiceID" id="hiddenServiceID" hidden readonly>
            <input type="password" name="origin" id="origin" hidden readonly value="service-menu.php">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt fa-fw fa-sm"></i> Yes, Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal confirm delete service END-->

</body>

</html>

<script src="<?= $assets ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= $assets ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assets ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= $assets ?>/js/sb-admin-2.min.js"></script>
<script src="<?= $assets ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $assets ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#services').DataTable();
  });

  function imageSelected() {
    if (document.getElementById("inputFileImage").value != '') {
      var input = document.getElementById("inputFileImage");
      document.getElementById("inputFileImageLabel").innerHTML = input.files.item(0).name;
    }
  }

  function imageSelected2() {
    if (document.getElementById("updateImage").value != '') {
      var input = document.getElementById("updateImage");
      document.getElementById("updateImageLabel").innerHTML = input.files.item(0).name;
    }
  }

  function openDetail(thumbnail, name, type, category, price, status, description, id, rawprice, poin) {
    document.getElementById('detailPanel').hidden = false;
    document.getElementById('modeView').hidden = false;
    document.getElementById('modeEdit').hidden = true;
    document.getElementById('thumbnailShow').src = '../assets/img/thumbnail/' + thumbnail;
    document.getElementById('servicenameShow').innerHTML = name;
    document.getElementById('typeShow').innerHTML = type + ' - ' + category;
    document.getElementById('priceShow').innerHTML = price;
    document.getElementById('poinShow').innerHTML = poin;
    document.getElementById('hiddenServiceID').value = id;
    document.getElementById('deleteTitle').innerHTML = '[ ' + name + ' ]';
    document.getElementById('descriptionShow').innerHTML = description;
    document.getElementById('updateCategory').value = category;
    document.getElementById('updateServiceName').value = name;
    document.getElementById('updateServicePrice').value = rawprice;
    document.getElementById('updatePoin').value = poin;
    document.getElementById('updateServiceDesc').value = description;
    document.getElementById('serviceidhidden').value = id;
    if (status == 'Active') {
      var checker = 'checked';
    } else {
      var checker = '';
    }
    document.getElementById('setActiveStatus').checked = checker;
    document.getElementById('panelUtama').className = 'col-xl-7 col-lg-7';
    if (status == 'Active') {
      document.getElementById('statusShow').innerHTML = '<i class="fas fa-dot-circle text-info"></i> Active';
    } else if (status == 'Inactive') {
      document.getElementById('statusShow').innerHTML = '<i class="far fa-dot-circle text-danger"></i> Inactive';
    }
  }

  function closeDetailPanel() {
    document.getElementById('detailPanel').hidden = true;
    document.getElementById('panelUtama').className = 'col-xl-12 col-lg-12';
  }

  function changeMode() {
    if (document.getElementById('modeView').hidden == false) {
      document.getElementById('modeView').hidden = true;
      document.getElementById('modeEdit').hidden = false;
      document.getElementById('rightPaneTitle').innerHTML = '<i class="fas fa-edit fa-fw"></i> Edit Service Detail';
    } else {
      document.getElementById('modeView').hidden = false;
      document.getElementById('modeEdit').hidden = true;
      document.getElementById('rightPaneTitle').innerHTML = '<i class="fas fa-info-circle fa-fw"></i> Service Detail';
    }
  }
</script>

<!-- ==============================================

FFFFFFFFFFFFFFFFFFFFFFFFFF
 FFFFFFFFFFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFFFFFFFFF
  FFFFF                FFF
  FFFFF
  FFFFF         FFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFFFFFFFFFFFFFF
  FFFFF         FFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
  FFFFF
 FFFFFFF
FFFFFFFFF

==============================================  -->