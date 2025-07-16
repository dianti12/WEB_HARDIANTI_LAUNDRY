<?php
// Pastikan Anda sudah memiliki koneksi database ($connection) dan session dimulai di awal file Anda.
// Contoh:
// session_start();
// $connection = mysqli_connect("localhost", "username", "password", "database_name");
// if (!$connection) {
//     die("Koneksi database gagal: " . mysqli_connect_error());
// }

// getting account username
$idDashboard = $_SESSION['id'];
$queryDashboard = mysqli_query($connection, "SELECT * FROM user WHERE id = '$idDashboard'");
$rowDashboard = mysqli_fetch_array($queryDashboard);

// menghitung data pelanggan
$dataPelanggan = mysqli_query($connection, "SELECT * FROM customer");
$jmlDataPelanggan = mysqli_num_rows($dataPelanggan);

// menghitung data user
$dataUser = mysqli_query($connection, "SELECT * FROM user");
$jmlDataUser = mysqli_num_rows($dataUser);

// Menghitung Total Transaksi dan Total Pendapatan
$queryTotalTransactions = mysqli_query($connection, "SELECT COUNT(*) AS total_transactions, SUM(total_price) AS total_revenue FROM trans_order");
$statsTotal = mysqli_fetch_assoc($queryTotalTransactions);
$totalTransactions = $statsTotal['total_transactions'] ?? 0;
$totalRevenue = $statsTotal['total_revenue'] ?? 0;

// Menghitung Pesanan Aktif (pending, process, ready)
$queryActiveOrders = mysqli_query($connection, "SELECT COUNT(*) AS active_orders FROM trans_order WHERE order_status IN ('pending', 'process', 'ready')");
$statsActive = mysqli_fetch_assoc($queryActiveOrders);
$activeOrders = $statsActive['active_orders'] ?? 0;

// Menghitung Pesanan Selesai (delivered)
$queryCompletedOrders = mysqli_query($connection, "SELECT * FROM trans_order WHERE order_status = '1'");
$jml = mysqli_num_rows($queryCompletedOrders);
// $statsCompleted = mysqli_fetch_assoc($queryCompletedOrders);
// $completedOrders = $statsCompleted['completed_orders'] ?? 0;
$completedOrders = $jml;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Laundry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-color: #f0f2f5;
      /* Warna latar belakang body */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* --- Gaya Umum untuk Kontainer Dashboard --- */
    .dashboard-container {
      background-color: #ffffff;
      /* Latar belakang utama dashboard */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      margin-top: 30px;
      /* Jarak dari atas halaman */
    }

    /* --- Gaya Bagian Selamat Datang --- */
    .welcome-section {
      background: linear-gradient(45deg, #e0f7fa 0%, #b3e5fc 100%);
      /* Gradien biru cerah */
      border-radius: 15px;
      padding: 40px 30px;
      margin-bottom: 30px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      color: #004d40;
      /* Warna teks yang kontras */
    }

    .welcome-section h2 {
      font-size: 2.8em;
      font-weight: 700;
      margin-bottom: 10px;
      color: #004d40;
    }

    .welcome-section p {
      font-size: 1.2em;
      color: #00796b;
    }

    /* --- Gaya Kartu Statistik (Dashboard Cards) --- */
    .dashboard-card {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      padding: 25px;
      text-align: center;
      transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
      height: 100%;
      /* Memastikan semua kartu memiliki tinggi yang sama */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .dashboard-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card .icon-wrapper {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2.2em;
      color: #ffffff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* --- Warna Latar Belakang Ikon Spesifik (Gradien) --- */
    .icon-wrapper.bg-customer {
      background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    }

    /* Ungu-Biru */
    .icon-wrapper.bg-user {
      background: linear-gradient(45deg, #20c997 0%, #17a2b8 100%);
    }

    /* Hijau-Cyan */
    .icon-wrapper.bg-transactions {
      background: linear-gradient(45deg, #fd7e14 0%, #e83e8c 100%);
    }

    /* Oranye-Pink */
    .icon-wrapper.bg-revenue {
      background: linear-gradient(45deg, #28a745 0%, #1e7e34 100%);
    }

    /* Hijau */
    .icon-wrapper.bg-active {
      background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
    }

    /* Biru */
    .icon-wrapper.bg-completed {
      background: linear-gradient(45deg, #6f42c1 0%, #8b008b 100%);
    }

    /* Ungu */

    .dashboard-card h2 {
      font-size: 2.5em;
      font-weight: 700;
      color: #343a40;
      margin-bottom: 5px;
    }

    .dashboard-card p {
      font-size: 1.1em;
      color: #6c757d;
      margin-bottom: 0;
    }

    /* --- Gambar Ilustrasi --- */
    .dashboard-card img {
      max-width: 150px;
      height: auto;
      margin-bottom: 15px;
      border-radius: 8px;
    }

    /* --- Responsivitas --- */
    @media (max-width: 768px) {
      .welcome-section {
        padding: 30px 20px;
      }

      .welcome-section h2 {
        font-size: 2em;
      }

      .welcome-section p {
        font-size: 1em;
      }

      .dashboard-card h2 {
        font-size: 2em;
      }

      .dashboard-card p {
        font-size: 0.9em;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="dashboard-container">
      <div class="welcome-section">
        <h2>Selamat Datang, <?= $rowDashboard['username'] ?></h2>
        <p>Mari pantau performa bisnis laundry Anda dengan ringkasan ini.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-customer">
              <i class="fas fa-users"></i>
            </div>
            <img src="./img/pelanggan.jpg" alt="Data Pelanggan">
            <h2><?= $jmlDataPelanggan; ?></h2>
            <p>Data Pelanggan</p>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-user">
              <i class="fas fa-user-tie"></i>
            </div>
            <img src="./img/user-data.png" alt="Data User">
            <h2><?= $jmlDataUser; ?></h2>
            <p>Data User (Karyawan)</p>
          </div>
        </div>


        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-transactions">
              <i class="fas fa-shopping-basket"></i>
            </div>
            <img src="./img/mesincuci1.jpg" alt="Total Transaksi">
            <h2><?= $totalTransactions; ?></h2>
            <p>Total Transaksi</p>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-revenue">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <img src="./img/total_pendapatan.jpg" alt="Total Pendapatan">
            <h2>Rp <?= number_format($totalRevenue, 0, ',', '.'); ?></h2>
            <p>Total Pendapatan</p>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-active">
              <i class="fas fa-sync-alt"></i>
            </div>
            <img src="./img/total_transaksi.png" alt="Pesanan Aktif">
            <h2><?= $activeOrders; ?></h2>
            <p>Pesanan Aktif</p>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
          <div class="dashboard-card">
            <div class="icon-wrapper bg-completed">
              <i class="fas fa-check-circle"></i>
            </div>
            <img src="admin/img/laundry_completed.png" alt="Pesanan Selesai">
            <h2><?= $completedOrders; ?></h2>
            <p>Pesanan Selesai</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>