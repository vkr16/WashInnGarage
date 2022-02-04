<div id="container1">
    <table class=" table" id="tabletoaddorder">
        <thead>
            <tr>
                <th scope="col">Item / Service</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Add</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../core/init.php';

            if (isset($_POST['getactivemenus'])) {

                $query_getActiveMenus = "SELECT * FROM menus WHERE status = 'active' AND type != 'promotion' AND stock > 0 OR status = 'active' AND type != 'promotion' AND stock IS NULL";
                $execute_getActiveMenus = mysqli_query($link, $query_getActiveMenus);

                while ($menu = mysqli_fetch_assoc($execute_getActiveMenus)) {
                    if ($menu['type'] == 'service' && $menu['category'] == 'Car') {
                        $menutype = 'Service  -  Car ';
                    } elseif ($menu['type'] == 'service' && $menu['category'] == 'Motorcycle') {
                        $menutype = 'Service  -  Motorcycle ';
                    } elseif ($menu['type'] == 'food') {
                        $menutype = 'Food';
                    } elseif ($menu['type'] == 'beverage') {
                        $menutype = 'Beverage';
                    } elseif ($menu['type'] == 'merchandise') {
                        $menutype = 'Merchandise';
                    } else {
                        $menutype = 'Unknown';
                    }

            ?>


                    <tr>
                        <td><strong><?= $menu['name'] ?></strong></td>
                        <td><?= $menutype ?></td>
                        <td><?= 'Rp ' . number_format($menu['price'], 0, ',', '.')  ?></td>
                        <td><button class="btn btn-sm btn-outline-info" onclick="addOrderToActiveTrx('<?= $menu['id'] ?>')"><i role="button" class="fas fa-plus fa-fw fa-2x"></i></button></td>
                    </tr>



            <?php
                    # code...
                }
            }
            ?>

        </tbody>
    </table>
</div>



<script>
    $(document).ready(function() {
        $('#tabletoaddorder').DataTable({
            "ordering": false
        });
    });
</script>