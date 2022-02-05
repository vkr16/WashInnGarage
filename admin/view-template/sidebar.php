<?php
if ($activePageLvl == 0) {
    $lvl0 = 'active';
} elseif ($activePageLvl == 1) {
    $lvl1 = 'active';
} elseif ($activePageLvl == 2) {
    $lvl2 = 'active';
} elseif ($activePageLvl == 3) {
    $lvl3 = 'active';
} elseif ($activePageLvl == 4) {
    $lvl4 = 'active';
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="<?= $assets ?>/img/logo-white.png" width=60px>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $lvl0 ?>">
        <a class="nav-link" href="<?= $home ?>/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Control
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $lvl1 ?>">
        <a class="nav-link" href="manage-user.php">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>User Management</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $lvl2 ?>">
        <a class="nav-link" href="manage-user.php">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transaction</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= $lvl3 ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu2" aria-expanded="true" aria-controls="collapseMenu2">
            <i class="fas fa-fw fa-database"></i>
            <span>Customer Data</span>
        </a>
        <div id="collapseMenu2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer</h6>
                <a class="collapse-item" href="customer-basic.php">Basic Information</a>
                <a class="collapse-item" href="customer-vehicle.php">Vehicles</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= $lvl4 ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="true" aria-controls="collapseMenu">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage Menu</span>
        </a>
        <div id="collapseMenu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="service-menu.php">Services</a>
                <a class="collapse-item" href="merch-menu.php">Merchandise</a>
                <a class="collapse-item" href="fnb-menu.php">Food & Beverage</a>
                <a class="collapse-item" href="promotions-menu.php">Promotions</a>
                <!-- <a class="collapse-item" href="utilities-other.html">Other</a> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Operational
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $lvl4 ?>">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Active Order</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="mb-3" src="<?= $assets ?>/img/logo-white.png" width=60px>
        <p class="text-center mb-2">Copyright &copy; 2022 <br><strong>Wash Inn Garage.</strong> All Rights Reserved</p>
    </div>
</ul>
<!-- End of Sidebar -->