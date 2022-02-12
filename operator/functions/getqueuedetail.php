<table class="table table-hover">
    <thead>
        <th>Ordered Service</th>
        <th>Vehicle</th>
    </thead>
    <tbody id="">

        <?php
        require_once '../../core/init.php';

        if (isset($_POST['getqueue'])) {
            $invoice = $_POST['invoice'];


            $current_user = $_SESSION['wig_user'];
            $query_getActiveTrx = "SELECT * FROM transactions WHERE invoice_number = '$invoice'";
            $execute_getActiveTrx = mysqli_query($link, $query_getActiveTrx);


            while ($activeTrx = mysqli_fetch_assoc($execute_getActiveTrx)) {



                // ambil data dari table orders
                $activeTrxId = $activeTrx['id'];
                $query_getActiveOrder = "SELECT * FROM orders WHERE trx_id = '$activeTrxId' AND order_status = 'active'";
                $execute_getActiveOrder = mysqli_query($link, $query_getActiveOrder);
                while ($activeOrder = mysqli_fetch_assoc($execute_getActiveOrder)) {
                    $menuId = $activeOrder['menu_id'];
                    $query_getOrderedMenu = "SELECT * FROM menus WHERE id = '$menuId'";
                    $execute_getOrderedMenu = mysqli_query($link, $query_getOrderedMenu);
                    $orderedMenu = mysqli_fetch_assoc($execute_getOrderedMenu);
                    if ($orderedMenu['type'] == 'service') {
                        if ($orderedMenu['category'] == 'Car') {
                            $iconvehi = 'fas fa-car fa-fw  text-primary';
                        } else {
                            $iconvehi = 'fas fa-motorcycle fa-fw  text-primary';
                        }
        ?>
                        <tr>
                            <td><?= $orderedMenu['name'] ?></td>
                            <td><i class="<?= $iconvehi ?>"></i> &nbsp;<?= $activeOrder['platnomor'] ?></td>
                        </tr>

                <?php
                    }
                }
                ?>
    </tbody>
</table>
<?php

                if ($activeTrx['progress'] == 'waiting') { ?>
    <form action="functions/processqueue.php" method="POST">
        <button class="btn btn-primary" name="btnprocess" value="<?= $activeTrx['id'] ?>">Process</button>
    </form>
<?php
                } else { ?>
    <form action="functions/finishqueue.php" method="POST">
        <button class="btn btn-success" name="btnfinish" value="<?= $activeTrx['id'] ?>">Finish</button>
    </form>
<?php
                }
            }
        } else {
            header("Location:../index.php");
        }
?>