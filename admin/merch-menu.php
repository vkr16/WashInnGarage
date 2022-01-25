<?php 
    require_once 'admin-only.php';
    $activePageLvl=3;

    $query_getUser = "SELECT * FROM users WHERE username != '$current_user'";
    $execute_getUser = mysqli_query($link,$query_getUser);
    $i = 1;

    $query_getMerchandise = "SELECT * FROM menus WHERE type = 'merchandise'";
    $execute_getMerchandise = mysqli_query($link, $query_getMerchandise);

 ?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Menu</title>

    <link rel="icon" type="image/png" href="<?=$assets?>/img/logo.png">
    <link rel="stylesheet" type="text/css" href="<?=$assets?>/css/sb-admin-2.min.css">
    <link href="<?=$assets?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- dataTable css -->
    <link href="<?=$assets?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Manage Menu </h1>
<<<<<<< HEAD
                        
                        <?php 
                            if (isset($_COOKIE['returnstatus'])) {
                                if ($_COOKIE['returnstatus'] == 'userexist') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Registration failed!, Username already exist in database
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'success') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Registration successful!</strong><br>Password sent to user\'s email, please ask user to check their spam folder!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'usernameconflict') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Update failed!</strong>, new username conflict with another user in database
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'updatesuccess') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Update successful!</strong><br>Information update sent to user\'s email, please ask user to check their spam folder!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'deletesuccess') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>User Deletion Successful!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'offlinewarning') {
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Update Successful With an Error!</strong><br>
                                        Failed send email notification to user!!
                                        Update saved to database but user got no notification!
                                        <br>It may caused by invalid email address or there is no internet connection.<br><hr>
                                        If you just reset user password, please try again with internet connection!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'offlineFailed') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Add New User Failed!!</strong><br>
                                        Can not send email confirmation to user, 
                                        <br>It may caused by invalid email address or there is no internet connection.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
=======
                        <?php 
                            if (isset($_COOKIE['returnstatus'])) {
                                if ($_COOKIE['returnstatus'] == 'itemadded') {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>New Merchandise Item Added To The Menu</strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'itemnotadded') {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Failed!</strong><br>Something abnormal happen, please try again.<hr>If error continues please contact developer. [ERR-883]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'itemexist') {
                                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Add New Item Failed. <br> Error :</strong> Item Name Already Exist In Menu 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'itemnotupdated') {
                                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Item Detail Update Failed. <br>Error : </strong>Service redundant or id not found. [ERR-274]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'serviceaddednotuploaded') {
                                     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                          <strong>New Service Added To The Menu With An Error. <br></strong>Thumbnail image not uploaded, unknown reason. [ERR-998]
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'servicedeleted') {
                                     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>An Item Has Been Deleted.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'servicenotdeleted') {
                                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Service Deletion Failed. <br>Error : </strong>Service not found.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'serviceupdated') {
                                     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>A Service Has Been Updated.<br></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                }elseif ($_COOKIE['returnstatus'] == 'serviceredundant') {
                                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Update Service Failed. <br> Error :</strong> A Service With The Same Name Already Exist On The Menu
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
>>>>>>> a58888368a1995618c66043e4accf611b6e9151b
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
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-gift fa-fw"></i> Merchandise</h5>
                                    <a data-toggle="modal" data-target="#addMenuModal" class="btn btn-success"><i class="fas fa-plus fa-fw"></i> Add Menu</a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-striped" id="services">
<<<<<<< HEAD
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
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@mdo</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@mdo</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
=======
                                      <thead>
                                        <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Item Name</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Stock</th>
                                          <th scope="col">Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php while ($merch = mysqli_fetch_assoc($execute_getMerchandise)) {
                                            $checker = ($merch['status'] == 'active')?'checked':'';
                                            $status = ($merch['status'] == 'active')?'Active':'Inactive';
                                            $type = ($merch['type'] == 'merchandise')?'Merchandise':'other';
                                            $price = 'Rp '.number_format($merch['price'],0,',','.') 
                                        ?>
                                        <tr onclick="openDetail('<?= $merch['image'].'\',\''.$merch['name'].'\',\''.$type.'\',\''.$merch['stock'].'\',\''.$price.'\',\''.$status.'\',\''.$merch['description'].'\',\''.$merch['id'].'\',\''.$merch['price'] ?>')">
                                          <th scope="row"><?= $i ?></th>
                                          <td><a href="#"  class="text-decoration-none"><?= $merch['name']?></a></td>
                                          <td><?= $price?></td>
                                          <td><?= $merch['stock'] ?></td>
                                          <td><?= $status ?></td>
                                        </tr>
                                        <?php $i++;} ?>
                                      </tbody>
>>>>>>> a58888368a1995618c66043e4accf611b6e9151b
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-xl-5 col-lg-5" hidden id="detailPanel">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary" id="rightPaneTitle"><i class="fas fa-info-circle fa-fw"></i> Item Detail</h5>
                                    <a class="btn btn-danger" onclick="closeDetailPanel()"><i class="fas fa-times fa-fw"></i></a>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" id="modeView" >
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
                                      <p class="mb-2 font-weight-bolder" id="statusShow"></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <!-- <br> -->
                                  <div class="col-xl-12 col-lg-12 text-dark">
                                    <p class="font-weight-bolder">Description :</p>
                                    <p class="text-justify" id="descriptionShow"></p>
                                  </div>
                                  <hr>
                                  <div class="row mx-2 d-flex justify-content-end">
                                    <a href="#" class="btn btn-primary" onclick="changeMode()"> 
                                      <i class="fas fa-edit fa-fw fa-sm"></i> Edit </a> 
                                      &emsp; 
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deletemerch">
                                      <i class="fas fa-trash-alt fa-fw fa-sm"></i> Delete </a>
                                  </div>
                                </div>
                                <div class="card-body" id="modeEdit" hidden>
                                  <form action="functions/update-merch-menu.php" method="post" enctype="multipart/form-data">
                                      <div class="form-row">
                                        <div class="form-group col-md-8">
                                          <label for="updateMerchName">Item Name</label>
                                          <input required autocomplete="off" type="text" class="form-control" id="updateMerchName" placeholder="Item Name" name="merchname">
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="updateMerchStock">Stock</label>
                                          <input required autocomplete="off" class="form-control" id="updateMerchStock" type="number" name="merchstock" placeholder="Item Stock">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="updateMerchPrice">Price</label>
                                          <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                              </div>
                                              <input required autocomplete="off" type="text" class="form-control" id="updateMerchPrice" placeholder="50000" name="merchprice">
                                          </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="updateFileImage">Thumbnail Image (Optional) </label>
                                            <div class="input-group mb-3">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" onchange="imageSelected2()" id="updateImage" accept=".jpg" name="thumbnail2">
                                                <label class="custom-file-label" for="updateImage" id="updateImageLabel">Choose file</label>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-12">
                                              <label for="updateMerchDesc">Item Description (Optional)</label>
                                              <textarea autocomplete="off" class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this item" name="merchdesc" id="updateMerchDesc"></textarea>
                                            
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="setActiveStatus" name="activate">
                                          <label class="custom-control-label" for="setActiveStatus"> Put On Sale</label>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-secondary" onclick="changeMode()">Cancel</a>                                          &emsp;
                                            <input type="text" name="serviceidhidden" id="serviceidhidden" hidden readonly>
                                            <button type="submit" name="btnUpdateMerch" class="btn btn-primary" >Save <i class="fas fa-save fa-fw fa-sm"></i></button>
                                        </div>
                                      </div>
                                    </form>
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





    <!-- Modal Add New Menu -->
    <div class="modal fade " data-backdrop="static" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
<<<<<<< HEAD
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">Add New Service To Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCategory">Category</label>
                                <select id="inputCategory" class="form-control">
                                    <option selected value="Car">Car</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputServiceName">Service Name</label>
                                <input type="text" class="form-control" id="inputServiceName" placeholder="Service Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputServicePrice">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="inputServicePrice" placeholder="50.000">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputFileImage">Thumbnail Image (Optional)</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" onchange="imageSelected()" id="inputFileImage" accept=".jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="inputFileImage" id="inputFileImageLabel">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="inputServiceDesc">Service Description (Optional)</label>
                                <textarea class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this service"></textarea>
                            </div>
                        </div>
                  
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="setActiveCheck">
                                <label class="custom-control-label" for="setActiveCheck">Set as Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                    <button type="button" class="btn btn-primary">Save <i class="fas fa-save fa-fw"></i></button>
                </div>
            </div>
=======
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addMenuModalLabel">Add New Merchandise Item To Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="functions/add-merch-menu.php" method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="inputMerchName">Item Name</label>
                  <input required autocomplete="off" type="text" class="form-control" id="inputMerchName" placeholder="Item Name" name="merchname">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputStock">Stock</label>
                  <input required autocomplete="off" class="form-control" type="number" name="merchstock" placeholder="Item Stock">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputMerchPrice">Price</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                      </div>
                      <input required autocomplete="off" type="text" class="form-control" id="inputMerchPrice" placeholder="50000" name="merchprice">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputFileImage">Thumbnail Image (Optional) </label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="imageSelected()" id="inputFileImage" accept=".jpg" name="thumbnail">
                        <label class="custom-file-label" for="inputFileImage" id="inputFileImageLabel">Choose file</label>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-12">
                      <label for="inputMerchDesc">Item Description (Optional)</label>
                      <textarea autocomplete="off" class="form-control" style="min-height: 100px; max-height: 200px;" placeholder="Description for this item" name="merchdesc"></textarea>
                  </div>
              </div>
              
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="setActiveCheck" name="activate">
                  <label class="custom-control-label" for="setActiveCheck">Put On Sale</label>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
            <button type="submit" name="btnAddMerch" class="btn btn-primary">Save <i class="fas fa-save fa-fw"></i></button>
            </form>
          </div>
>>>>>>> a58888368a1995618c66043e4accf611b6e9151b
        </div>
    </div>
<<<<<<< HEAD
    <!-- Modal Add New Menu  END-->
=======
<!-- Modal Add New Menu  END-->


<!-- Modal confirm delete service -->
<div class="modal fade" id="deletemerch" tabindex="-1" aria-labelledby="deletemerchLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm To Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h4 class="font-weight-bolder text-dark" id="deleteTitle"></h4>
       Are you sure want to delete this menu?
      </div>
      <div class="modal-footer">
        <form action="functions/delete-menu.php" method="post">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <input type="password" name="hiddenServiceID" id="hiddenServiceID" hidden readonly>
            <input type="password" name="origin" id="origin" hidden readonly value="merch-menu.php">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt fa-fw fa-sm"></i> Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal confirm delete service END-->




>>>>>>> a58888368a1995618c66043e4accf611b6e9151b



    <!-- Bootstrap core JavaScript-->
    <script src="<?=$assets?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$assets?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$assets?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$assets?>/js/sb-admin-2.min.js"></script>

    <!-- dataTable js -->
    <script src="<?=$assets?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=$assets?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#services').DataTable();
        });


<<<<<<< HEAD
        function imageSelected(){
            if (document.getElementById("inputFileImage").value != '') {
                var input =  document.getElementById("inputFileImage");
                document.getElementById("inputFileImageLabel").innerHTML = input.files.item(0).name;
            }
        }
    </script>
=======



    function imageSelected(){
        if (document.getElementById("inputFileImage").value != '') {
            var input =  document.getElementById("inputFileImage");
            document.getElementById("inputFileImageLabel").innerHTML = input.files.item(0).name;
        }
    }
    function imageSelected2(){
        if (document.getElementById("updateImage").value != '') {
            var input =  document.getElementById("updateImage");
            document.getElementById("updateImageLabel").innerHTML = input.files.item(0).name;
        }
    }

    function openDetail(thumbnail, name, type, stock, price, status, description, id, rawprice){
        document.getElementById('detailPanel').hidden = false;
        document.getElementById('modeView').hidden = false;
        document.getElementById('modeEdit').hidden = true;

        document.getElementById('thumbnailShow').src = '../assets/img/thumbnail/'+ thumbnail;
        document.getElementById('merchNameShow').innerHTML = name;
        document.getElementById('typeShow').innerHTML = type + ' - ' + stock + ' in Stock';
        document.getElementById('priceShow').innerHTML = price;
        document.getElementById('hiddenServiceID').value = id;
        document.getElementById('deleteTitle').innerHTML = '[ '+ name +' ]';
        document.getElementById('descriptionShow').innerHTML = description;

        document.getElementById('updateMerchStock').value = stock;
        document.getElementById('updateMerchName').value = name;
        document.getElementById('updateMerchPrice').value = rawprice;
        document.getElementById('updateMerchDesc').value = description;
        document.getElementById('serviceidhidden').value  = id;
        if (status == 'Active') {
            var checker = 'checked';
        }else{
            var checker = '';
        }
        document.getElementById('setActiveStatus').checked = checker;


        document.getElementById('panelUtama').className = 'col-xl-7 col-lg-7';
        if (status =='Active') {
            document.getElementById('statusShow').innerHTML = '<i class="fas fa-dot-circle text-info"></i> On Sale';
        }else if (status == 'Inactive') {
            document.getElementById('statusShow').innerHTML = '<i class="far fa-dot-circle text-danger"></i> On Hold';
        }



    }

    function closeDetailPanel(){
        document.getElementById('detailPanel').hidden = true;
        document.getElementById('panelUtama').className = 'col-xl-12 col-lg-12';
    }

    function changeMode(){
        if (document.getElementById('modeView').hidden == false) {
            document.getElementById('modeView').hidden = true;
            document.getElementById('modeEdit').hidden = false;
            document.getElementById('rightPaneTitle').innerHTML = '<i class="fas fa-edit fa-fw"></i> Edit Item Detail';
        }else{
            document.getElementById('modeView').hidden = false;
            document.getElementById('modeEdit').hidden = true;
            document.getElementById('rightPaneTitle').innerHTML = '<i class="fas fa-info-circle fa-fw"></i> Item Detail';
        }
    }

</script>

>>>>>>> a58888368a1995618c66043e4accf611b6e9151b
</body>
</html>