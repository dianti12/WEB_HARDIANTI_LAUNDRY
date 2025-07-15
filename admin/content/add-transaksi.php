<?php
require_once 'admin/controller/koneksi.php';
include 'admin/controller/operator-validation.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// --- LOGIKA PHP UNTUK PROSES DATA (CREATE, VIEW, DELETE) ---

// Logika untuk generate order code
$getOrderCodeQuery = mysqli_query($config, "SELECT id FROM trans_order ORDER BY id DESC LIMIT 1");
$getorderCodeID = mysqli_fetch_assoc($getOrderCodeQuery);
$orderCodeID = (mysqli_num_rows($getOrderCodeQuery) > 0) ? $getorderCodeID['id'] + 1 : 1;
$orderCode = "LNDRY-" . date('YmdHis') . $orderCodeID;

// Logika saat form disubmit untuk MENAMBAH order
if (isset($_POST['add_order'])) {
    // var_dump($_POST); die(); // (Untuk debug, hapus jika sudah ok)

    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $order_end_date = $_POST['order_end_date'];
    $order_status = $_POST['order_status']; // <-- Nilai ini sekarang pasti terkirim
    $total_price = $_POST['total_price'];

    // Insert ke tabel utama
    $insert_trans_order = mysqli_query($config, "INSERT INTO trans_order (id_customer, order_code, order_date, order_end_date, order_status, total_price) VALUES ('$id_customer', '$order_code', '$order_date', '$order_end_date', '$order_status', '$total_price')");
    $trans_order_id = mysqli_insert_id($config);

    // Insert ke tabel detail
    if (isset($_POST['id_service'])) {
        foreach ($_POST['id_service'] as $key => $id_service) {
            $qty = $_POST['qty'][$key];
            $subtotal = $_POST['subtotal'][$key];

            mysqli_query($config, "INSERT INTO trans_order_detail (id_order, id_service, qty, subtotal) VALUES ('$trans_order_id', '$id_service', '$qty', '$subtotal')");
        }
    }

    // Alihkan kembali ke halaman daftar order dengan notifikasi sukses
    header("Location:?page=order&add=success");
    die;
} else if (isset($_GET['view'])) { // Logika untuk MELIHAT detail
    $idView = $_GET['view'];
    $queryView = mysqli_query($config, "SELECT trans_order.*, customer.customer_name, customer.phone, customer.address FROM trans_order LEFT JOIN customer ON trans_order.id_customer = customer.id WHERE trans_order.id = '$idView'");
    $rowView = mysqli_fetch_assoc($queryView);

    $orderViewID = $rowView['id'];
    $queryOrderList = mysqli_query($config, "SELECT trans_order_detail.*, type_of_service.* FROM trans_order_detail LEFT JOIN type_of_service ON trans_order_detail.id_service = type_of_service.id WHERE trans_order_detail.id_order = '$orderViewID'");
} else if (isset($_GET['delete'])) { // Logika untuk MENGHAPUS
    $idDelete = $_GET['delete'];
    mysqli_query($config, "DELETE FROM trans_order WHERE id='$idDelete'");
    // Detail dan pickup akan terhapus otomatis jika Anda set ON DELETE CASCADE di database
    // Jika tidak, query di bawah ini diperlukan
    // mysqli_query($config, "DELETE FROM trans_order_detail WHERE id_order='$idDelete'");
    // mysqli_query($config, "DELETE FROM trans_laundry_pickup WHERE id_order = '$idDelete'");
    header("Location:?page=order&delete=success");
    die;
}

// Query untuk mengisi dropdown di form
$queryService = mysqli_query($config, "SELECT * FROM type_of_service");
$queryCustomer = mysqli_query($config, "SELECT * FROM customer");

// --- TAMPILAN HTML (VIEW ATAU FORM) ---
?>

<?php
require_once 'admin/controller/koneksi.php';
$queryCustomer = mysqli_query($config, "SELECT * FROM customer");

if (isset($_POST['add-id_customer'])) {
    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $order_end_date = $_POST['order_end_date'];
    $order_status = $_POST['order_status'];
    $total_price = $_POST['total_price'];

    $insert = mysqli_query($config, "INSERT INTO trans_order (id_customer, order_code, order_date, order_end_date, order_status, total_price)
                VALUES ('$id_customer', '$order_code', '$order_date', '$order_end_date', '$order_status', '$total_price')");

    if ($insert) {
        echo "<script>alert('Transaksi berhasil disimpan'); window.location.href='?page=transaksi';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan transaksi');</script>";
    }
}


// Query untuk mengisi dropdown di form
$queryService = mysqli_query($config, "SELECT * FROM type_of_service");
$queryCustomer = mysqli_query($config, "SELECT * FROM customer");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Laundry - POS</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            text-align: center;
            color: #4a5568;
            margin-bottom: 10px;
            font-size: 2.5em;
            font-weight: 700;
        }

        .header .subtitle {
            text-align: center;
            color: #718096;
            font-size: 1.1em;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card h2 {
            color: #4a5568;
            margin-bottom: 20px;
            font-size: 1.8em;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #4a5568;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 101, 101, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(237, 137, 54, 0.3);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .service-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .service-card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .service-card .price {
            font-size: 1.5em;
            font-weight: 700;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th,
        .cart-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .cart-table th {
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }

        .cart-table tr:hover {
            background: #f7fafc;
        }

        .total-section {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .total-section h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .total-amount {
            font-size: 2.5em;
            font-weight: 700;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fed7d7;
            color: #c53030;
        }

        .status-process {
            background: #feebc8;
            color: #dd6b20;
        }

        .status-ready {
            background: #c6f6d5;
            color: #2f855a;
        }

        .status-delivered {
            background: #bee3f8;
            color: #2b6cb0;
        }

        .transaction-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .transaction-item {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
        }

        .transaction-item h4 {
            color: #4a5568;
            margin-bottom: 5px;
        }

        .transaction-item p {
            color: #718096;
            margin-bottom: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            color: #000;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2em;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        .receipt {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-family: 'Courier New', monospace;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .receipt-total {
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🧺 Sistem Informasi Laundry Hardianti</h1>
            <p class="subtitle">Point of Sales System - Kelola Transaksi Laundry dengan Mudah</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3 id="totalTransactions">0</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-card">
                <h3 id="totalRevenue">Rp 0</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="stat-card">
                <h3 id="activeOrders">0</h3>
                <p>Pesanan Aktif</p>
            </div>
            <div class="stat-card">
                <h3 id="completedOrders">0</h3>
                <p>Pesanan Selesai</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Panel: New Transaction -->
            <div class="card">
                <h2>🛒 Transaksi Baru</h2>

                <form method="POST" id="transactionForm">
                    <div class="form-group">
                        <label for="customerName">Nama Pelanggan</label>
                        <select name="id_customer" id="customerName" required>
                            <option value="">-- Pilih Nama Customer --</option>
                            <?php while ($rowCustomer = mysqli_fetch_assoc($queryCustomer)) : ?>
                                <option data-phone='<?= $rowCustomer['phone'] ?>' data-address='<?= $rowCustomer['address'] ?>' value="<?= $rowCustomer['id'] ?>"><?= $rowCustomer['customer_name'] ?></option>
                            <?php endwhile ?>
                        </select>
                        <!-- <input type="text" id="customerName" required> -->
                        <input type="hidden" name="trxId" id="trxIdInput" value="">
                        <input type="hidden" name="id_customer" id="id_customer" value="">
                        <input type="hidden" name="cart_data" id="cartDataInput">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="customerPhone">No. Telepon</label>
                            <input type="text" id="customerPhone" required>
                        </div>
                        <div class="form-group">
                            <label for="customerAddress">Alamat</label>
                            <input type="text" id="customerAddress">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Pilih Layanan</label>
                        <div class="services-grid">
                            <button type="button" class="service-card" onclick="addService('Cuci Gosok', 5000)">
                                <h3>🌪️ Cuci dan Gosok</h3>
                                <div class="price">Rp 5.000/kg</div>
                            </button>
                            <button type="button" class="service-card" onclick="addService('Hanya Cuci', 4500)">
                                <h3>👔 Hanya Cuci</h3>
                                <div class="price">Rp 4.500/kg</div>
                            </button>
                            <button type="button" class="service-card" onclick="addService('Hanya Gosok', 5000)">
                                <h3>🔥 Hanya Gosok</h3>
                                <div class="price">Rp 5.000/kg</div>
                            </button>
                            <button type="button" class="service-card" onclick="addService('Laundry Besar', 7000)">
                                <h3>✨ Laundry Besar (selimut, karpet, mantel, dan sprei mylove)</h3>
                                <div class="price">Rp 7.000/kg</div>

                            </button>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="serviceWeight">Berat/Jumlah</label>
                            <input type="number" id="serviceWeight" step="0.1" min="0.1" required>
                        </div>
                        <div class="form-group">
                            <label for="serviceType">Jenis Layanan</label>
                            <select id="serviceType" required>
                                <option value="">Pilih Layanan</option>
                                <option value="Cuci Gosok">Cuci dan Gosok</option>
                                <option value="Hanya Cuci">Hanya Cuci</option>
                                <option value="Hanya Gosok">Hanya Gosok</option>
                                <option value="Laundry Besar">Laundry Besar
                                    (selimut, karpet, mantel, dan sprei my love)
                                </option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan</label>
                        <textarea id="notes" rows="3" placeholder="Catatan khusus untuk pesanan..."></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="addToCart()" style="width: 100%; margin-bottom: 10px;">
                        ➕ Tambah ke Keranjang
                    </button>
                </form>

                <!-- Cart -->
                <div id="cartSection" style="display: none;">
                    <h3>📋 Keranjang Belanja</h3>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                        </tbody>
                    </table>

                    <div class="total-section">
                        <h3>Total Pembayaran</h3>
                        <div class="total-amount" id="totalAmount">Rp 0</div>
                        <button class="btn btn-success" onclick="processTransaction()" style="width: 100%; margin-top: 15px;">
                            💳 Proses Transaksi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Transaction History -->
            <div class="card">
                <h2>📊 Riwayat Transaksi</h2>
                <div class="transaction-list" id="transactionHistory">
                    <div class="transaction-item">
                        <h4>TRX-001 - John Doe</h4>
                        <p>📞 0812-3456-7890</p>
                        <p>🛍️ Hanya Cuci - 2.5kg</p>
                        <p>💰 Rp 17.500</p>
                        <p>📅 13 Juli 2025, 14:30</p>
                        <span class="status-badge status-process">Proses</span>
                    </div>
                    <div class="transaction-item">
                        <h4>TRX-002 - Jane Smith</h4>
                        <p>📞 0813-7654-3210</p>
                        <p>🛍️ Cuci Gosok - 3kg</p>
                        <p>💰 Rp 15.000</p>
                        <p>📅 13 Juli 2025, 13:15</p>
                        <span class="status-badge status-ready">Siap</span>
                    </div>
                </div>

                <button class="btn btn-warning" onclick="showAllTransactions()" style="width: 100%; margin-top: 15px;">
                    📋 Lihat Semua Transaksi
                </button>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="text-align: center; margin-top: 20px;">
            <button class="btn btn-primary" onclick="showReports()" style="margin: 0 10px;">
                📈 Laporan Penjualan
            </button>
            <button class="btn btn-warning" onclick="manageServices()" style="margin: 0 10px;">
                ⚙️ Kelola Layanan
            </button>
            <button class="btn btn-danger" onclick="clearCart()" style="margin: 0 10px;">
                🗑️ Bersihkan Keranjang
            </button>
            <a href="?page=transaksi" class="btn btn-success w-10">Halaman Transaksi</a>

        </div>
    </div>

    <!-- Modal for Transaction Details -->
    <div id="transactionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <?php include 'admin/inc/jsx.php' ?>


    <!-- <script>
        const selectCustomer = document.getElementById('customerName');

        selectCustomer.addEventListener('change', function() {
            const optionCustomer = selectCustomer.options[selectCustomer.selectedIndex];
            const phoneCustomer = optionCustomer.dataset.phone;
            const addressCustomer = optionCustomer.dataset.address;
            document.getElementById('customerPhone').value = phoneCustomer;
            document.getElementById('customerAddress').value = addressCustomer;
        });
    </script> -->