<?php
require_once '../core/init.php';
$mobilcounter   = 0;
$motorcounter   = 0;
$query_getTrx   = "SELECT * FROM transactions WHERE trx_status ='completed'";
$execute_getTrx = mysqli_query($link, $query_getTrx);
while ($getTrx = mysqli_fetch_assoc($execute_getTrx)) {
    $trxID              = $getTrx['id'];
    $query_getOrder     = "SELECT * FROM orders WHERE trx_id = '$trxID'";
    $execute_getOrder   = mysqli_query($link, $query_getOrder);
    $getOrder           = mysqli_fetch_assoc($execute_getOrder);
    $platnomor          = $getOrder['platnomor'];
    $query_getVehicle   = "SELECT * FROM vehicles WHERE platnomor = '$platnomor'";
    $execute_getVehicle = mysqli_query($link, $query_getVehicle);
    $getVehicle         = mysqli_fetch_assoc($execute_getVehicle);
    $veti               = $getVehicle['vehicletype'];
    if ($veti == 'Mobil') {
        $mobilcounter += 1;
    } elseif ($veti == 'Motor') {
        $motorcounter += 1;
    }
}
if ($mobilcounter == 0 && $motorcounter == 0) {
    $persenmobil = 50;
    $persenmotor = 50;
} else {
    $persenmobil = ($mobilcounter / ($mobilcounter + $motorcounter)) * 100;
    $persenmotor = ($motorcounter / ($mobilcounter + $motorcounter)) * 100;
}
$a         = round($persenmobil, 2);
$b         = round($persenmotor, 2);
$arraymomo = json_encode(array(
    $a,
    $b
));
?>

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