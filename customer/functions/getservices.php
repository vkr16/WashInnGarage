<?php
require_once '../../core/init.php';

$limit = $_POST['limit'];
$position = $_POST['position'];
$category = $_POST['category'];
$query_getServices = "SELECT * FROM menus WHERE type = 'service' AND category = '$category' AND status = 'active' LIMIT $limit OFFSET $position";
$execute_getServices = mysqli_query($link, $query_getServices);

$query_getActiveServices = "SELECT * FROM menus WHERE type = 'service' AND category = '$category' AND status = 'active'";
$execute_getActiveServices = mysqli_query($link, $query_getActiveServices);
// $execute_MotorServices = mysqli_query($link, $query_getMotorServices);
$countservice = mysqli_num_rows($execute_getActiveServices);
if ($position == 0) {
    $prevPos = 0;
    echo '<script>document.getElementById("menuPrevPageBtn").className = "btn btn-outline-light";</script>';
    echo '<script>document.getElementById("menuPrevPageBtn").disabled = true;</script>';
} else {
    $prevPos = $position - $limit;
    echo '<script>document.getElementById("menuPrevPageBtn").className = "btn btn-outline-info";</script>';
    echo '<script>document.getElementById("menuPrevPageBtn").disabled = false;</script>';
}


$lastrendereddata = $position + $limit;
if ($countservice <= $lastrendereddata) {
    $nextPos = $position;
    echo '<script>document.getElementById("menuNextPageBtn").className = "btn btn-outline-light";</script>';
    echo '<script>document.getElementById("menuNextPageBtn").disabled = true;</script>';
} else {
    $nextPos = $position + $limit;
    echo '<script>document.getElementById("menuNextPageBtn").className = "btn btn-outline-info";</script>';
    echo '<script>document.getElementById("menuNextPageBtn").disabled = false;</script>';
}

?>

<div class="" id="LayananMobil">
    <div class="row">
        <?php while ($service = mysqli_fetch_assoc($execute_getServices)) { ?>
            <div class="col-md-4 mb-3" onclick="viewDetails('<?= $service['image'] ?>', '<?= $service['name'] ?>','<?= $service['id'] ?>','<?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?>','<?= $service['description'] ?>', 'serviceMenu','serviceDetail')">
                <a href="#collapse_<?= $service['id'] ?>" data-toggle="collapse">
                    <img src="../assets/img/thumbnail/<?= $service['image'] ?>" alt="" style="width: 100%;" class="img-thumbnail shadow">
                </a>
                <div class="d-flex justify-content-center mt-2">
                    <a class="btn btn-outline-info" name="serviceID"><?= $service['name'] ?></a>
                </div>
                <h6 class="text-weight-light text-dark text-center mt-2"><?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?></h6>
            </div>
        <?php } ?>
    </div>

</div>
<div class="" id="LayananMotor">
    <div class="row">

        <?php while ($service = mysqli_fetch_assoc($execute_getServices)) { ?>
            <div class="col-md-4 mb-3" onclick="viewDetails('<?= $service['image'] ?>', '<?= $service['name'] ?>','<?= $service['id'] ?>','<?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?>','<?= $service['description'] ?>', 'serviceMenu','serviceDetail')">
                <a href="#collapse_<?= $service['id'] ?>" data-toggle="collapse">
                    <img src="../assets/img/thumbnail/<?= $service['image'] ?>" alt="" style="width: 100%;" class="img-thumbnail shadow">
                </a>
                <div class="d-flex justify-content-center mt-2">
                    <a class="btn btn-outline-info" name="serviceID"><?= $service['name'] ?></a>
                </div>
                <h6 class="text-weight-light text-dark text-center mt-2"><?= 'Rp ' . number_format($service['price'], 0, ',', '.') ?></h6>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    document.getElementById("menuNextPageBtn").value = "<?= $nextPos ?>";
    document.getElementById("menuPrevPageBtn").value = "<?= $prevPos ?>";
    document.getElementById("availablemenucount").innerHTML = "<?= $countservice ?>";

    if ($category == 'Car') {
        document.getElementById("LayananMotor").hidden = true;
        document.getElementById("LayananMobil").hidden = false;
    } else {
        document.getElementById("LayananMotor").hidden = false;
        document.getElementById("LayananMobil").hidden = true;
    }
</script>