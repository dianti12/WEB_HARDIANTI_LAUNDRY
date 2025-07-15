<?php
$navbarID = $_SESSION['id'];
$queryNavbar = mysqli_query($connection, "SELECT * FROM user WHERE id = '$navbarID'");
$dataNavbar = mysqli_fetch_assoc($queryNavbar);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Laundry App</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= !isset($_GET['page']) || ($_GET['page'] == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="?page=dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php if ($dataNavbar['id_level'] == 1) : ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Master Data
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin"
                aria-expanded="true" aria-controls="collapseAdmin">
                <i class="fas fa-fw fa-user-shield"></i>
                <span>Administrasi</span>
            </a>
            <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master:</h6>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'user' || $_GET['page'] == 'add-user')) ? 'active' : '' ?>"
                        href="?page=user">Pengguna</a>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'level' || $_GET['page'] == 'add-level')) ? 'active' : '' ?>"
                        href="?page=level">Level</a>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'customer' || $_GET['page'] == 'add-customer')) ? 'active' : '' ?>"
                        href="?page=customer">Pelanggan</a>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'service' || $_GET['page'] == 'add-service')) ? 'active' : '' ?>"
                        href="?page=service">Layanan</a>
                </div>
            </div>
        </li>
    <?php elseif ($dataNavbar['id_level'] == 2) : ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Operator
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperator"
                aria-expanded="true" aria-controls="collapseOperator">
                <i class="fas fa-fw fa-cash-register"></i>
                <span>Operator</span>
            </a>
            <div id="collapseOperator" class="collapse" aria-labelledby="headingOperator" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Transaksi:</h6>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'transaksi' || $_GET['page'] == 'add-transaksi')) ? 'active' : '' ?>"
                        href="?page=transaksi">Transaksi</a>
                </div>
            </div>
        </li>
    <?php elseif ($dataNavbar['id_level'] == 3) : ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Panel Pimpinan
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePimpinan"
                aria-expanded="true" aria-controls="collapsePimpinan">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Laporan</span>
            </a>
            <div id="collapsePimpinan" class="collapse" aria-labelledby="headingPimpinan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Wawasan Data:</h6>
                    <a class="collapse-item <?= (isset($_GET['page']) && ($_GET['page'] == 'report')) ? 'active' : '' ?>"
                        href="?page=report">Lihat Laporan</a>
                </div>
            </div>
        </li>
    <?php endif ?>

    <hr class="sidebar-divider d-none d-md-block">

</ul>