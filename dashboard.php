<?php
session_start();
session_regenerate_id();
ob_start();
ob_clean();
require_once 'admin/controller/koneksi.php';
require_once 'admin/controller/functions.php';
if (empty($_SESSION['id'])) {
    header('Location: logout.php');
}

// getting account data
$idNav = $_SESSION['id'];
$queryNav = mysqli_query($connection, "SELECT user.*, level.level_name FROM user LEFT JOIN level ON user.id_level = level.id WHERE user.id = '$idNav'");
$rowNav  = mysqli_fetch_array($queryNav);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'admin/inc/cdn.php' ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'admin/inc/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <?php include 'admin/inc/sidebarToggle.php' ?>
                    <!-- Topbar Search -->
                    <?php include 'admin/inc/topbarSearch.php' ?>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php include 'admin/inc/topbarNavbar.php' ?>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="container">
                        <?php
                        if (isset($_GET['page'])) {
                            if (file_exists('admin/content/' . $_GET['page'] . '.php')) {
                                include 'admin/content/' . $_GET['page'] . '.php';
                            } else {
                                header("Location: admin/content/misc/error.php");
                                die;
                            }
                        } else {
                            include 'admin/content/dashboard.php';
                        }
                        ?>

                    </div>



                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="tmp/vendor/jquery/jquery.min.js"></script>
    <script src="tmp/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="tmp/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="tmp/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="tmp/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="tmp/js/demo/chart-area-demo.js"></script>
    <script src="tmp/js/demo/chart-pie-demo.js"></script>
    <?php include 'admin/inc/script.php' ?>
</body>

</html>