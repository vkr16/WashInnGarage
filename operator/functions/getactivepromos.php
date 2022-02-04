<div id="container2">
    <table class="table" id="tablepromo">
        <thead>
            <tr>
                <th scope="col">Promotion</th>
                <th scope="col">Value</th>
                <th scope="col">Cost</th>
                <th scope="col">Add</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../core/init.php';

            if (isset($_POST['getactivepromos'])) {

                $query_getActiveMenus = "SELECT * FROM menus WHERE status = 'active' AND type = 'promotion'";
                $execute_getActiveMenus = mysqli_query($link, $query_getActiveMenus);

                while ($menu = mysqli_fetch_assoc($execute_getActiveMenus)) {
            ?>


                    <tr>
                        <td><strong><?= $menu['name'] ?></strong></td>
                        <td><?= 'Rp ' . number_format($menu['price'], 0, ',', '.')  ?></td>
                        <td><?= $menu['poin'] ?> <i class="fab fa-product-hunt fa-fw"></i></td>
                        <td><button class="btn btn-sm btn-outline-info" onclick="addPromoToActiveTrx('<?= $menu['id'] ?>')"><i role="button" class="fas fa-plus fa-fw fa-2x"></i></button></td>
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

        $('#tablepromo').DataTable({
            "ordering": false
        });
    });
</script>