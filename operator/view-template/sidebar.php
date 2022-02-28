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
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="<?= $assets ?>/img/logo-white.png" width=60px>
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?= $lvl0 ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Operational
    </div>
    <li class="nav-item <?= $lvl1 ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu2" aria-expanded="true" aria-controls="collapseMenu2">
            <i class="fas fa-fw fa-database"></i>
            <span>Customer Data</span>
        </a>
        <div id="collapseMenu2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer</h6>
                <a class="collapse-item" href="customer-data.php">Basic Information</a>
                <a class="collapse-item" href="customer-vehicle.php">Vehicles</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= $lvl2 ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="true" aria-controls="collapseMenu">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Active Menu</span>
        </a>
        <div id="collapseMenu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="service-menu.php">Services</a>
                <a class="collapse-item" href="merch-menu.php">Merchandise</a>
                <a class="collapse-item" href="fnb-menu.php">Food & Beverage</a>
                <a class="collapse-item" href="promotions-menu.php">Promotions</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        Crew Area
    </div>
    <li class="nav-item <?= $lvl3 ?>">
        <a class="nav-link" href="crew-index.php">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Crew Area</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <div class="sidebar-card d-none d-lg-flex">
        <img class="mb-3" src="<?= $assets ?>/img/logo-white.png" width=60px>
        <p class="text-center mb-2">Copyright &copy; 2022 <br><strong>Wash Inn Garage.</strong> All Rights Reserved</p>
    </div>
</ul>