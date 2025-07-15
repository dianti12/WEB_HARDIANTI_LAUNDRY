<?php
// Pastikan path ke file ini sudah benar relatif terhadap lokasi file saat ini
require_once 'admin/controller/koneksi.php';
// Pastikan path ke file ini sudah benar
include 'admin/controller/pimpinan-validation.php';

// Fungsi getOrderStatus ini diperlukan agar status tampil dengan benar
// Jika fungsi ini ada di file lain (misal di pimpinan-validation.php), Anda tidak perlu menuliskannya di sini
// Jika belum ada, tambahkan fungsi ini:
if (!function_exists('getOrderStatus')) {
    function getOrderStatus($status_code)
    {
        switch ($status_code) {
            case '0':
                return 'Belum Bayar'; // Sesuaikan jika ini status pembayaran
            case '1':
                return 'Lunas';     // Sesuaikan jika ini status pembayaran
            default:
                return 'Tidak Diketahui';
        }
    }
}


$order_date_start = isset($_GET['order_date_start']) ? $_GET['order_date_start'] : '';
$order_date_end = isset($_GET['order_date_end']) ? $_GET['order_date_end'] : '';
$order_status = isset($_GET['order_status']) ? $_GET['order_status'] : '';

$sql = "SELECT trans_order.*, customer.customer_name, trans_laundry_pickup.pickup_date
        FROM trans_order 
        LEFT JOIN customer ON trans_order.id_customer = customer.id 
        LEFT JOIN trans_laundry_pickup ON trans_order.id = trans_laundry_pickup.id_order
        WHERE trans_order.id >= 0"; // Kondisi awal yang selalu true

if ($order_status != '') {
    // Pastikan nilai status 0 atau 1 sesuai dengan kolom order_status di DB Anda
    // Jika order_status di DB Anda berupa string ('pending', 'delivered', dll.), sesuaikan logic ini
    // Contoh untuk string: $sql .= " AND trans_order.order_status = '$order_status'";
    // Atau jika 0 dan 1 merepresentasikan status pembayaran, itu sudah benar
    $sql .= " AND trans_order.order_status = '$order_status'";
}

if ($order_date_start != '') {
    // Menggunakan kolom order_date untuk filter tanggal order
    // Menambahkan ' 00:00:00' untuk memastikan filter mencakup seluruh hari start
    $sql .= " AND trans_order.order_date >= '$order_date_start 00:00:00'";
}
if ($order_date_end != '') {
    // Menggunakan kolom order_date untuk filter tanggal order
    // Menambahkan ' 23:59:59' untuk memastikan filter mencakup seluruh hari end
    $sql .= " AND trans_order.order_date <= '$order_date_end 23:59:59'";
}


$sql .= " ORDER BY trans_order.id DESC"; // Order by paling baru
$queryData = mysqli_query($connection, $sql);

// DEBUGGING: Untuk melihat query yang terbentuk. Hapus ini setelah berhasil.
// echo "<pre>";
// echo $sql;
// echo "</pre>";
// if (!$queryData) {
//     echo "Query gagal: " . mysqli_error($connection);
// }
// echo "Jumlah data ditemukan: " . mysqli_num_rows($queryData);


if (isset($_GET['clear'])) {
    header("Location: ?page=report");
    exit(); // Penting: selalu gunakan exit() setelah header redirect
}
?>
<div class="card shadow">
    <div class="card-header">
        <h3>Data Report</h3>
    </div>
    <div class="card-body">
        <form method="get">
            <div class="row">
                <div class="col-sm-3 mb-3"> <label class="form-label">Order Date Start</label>
                    <input type="date" class="form-control" name="order_date_start"
                        value="<?= htmlspecialchars($order_date_start) ?>">
                </div>
                <div class="col-sm-3 mb-3"> <label class="form-label">Order Date End</label>
                    <input type="date" class="form-control" name="order_date_end"
                        value="<?= htmlspecialchars($order_date_end) ?>">
                </div>
                <div class="col-sm-3 mb-3"> <label class="form-label">Order Status</label>
                    <select name="order_status" id="order_status" class="form-control">
                        <option value=""> All </option>
                        <option value="0" <?= ($order_status == '0') ? 'selected' : '' ?>>Belum Bayar</option>
                        <option value="1" <?= ($order_status == '1') ? 'selected' : '' ?>>Lunas</option>
                    </select>
                </div>
                <input type="hidden" name="page" value="report">
                <div class="col-sm-3 mt-auto mb-3"> <button type="submit" class="btn btn-primary me-2" name="fiter">Filter</button>
                    <button type="submit" class="btn btn-secondary" name="clear">Clear</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Order Start Date</th>
                        <th>Order End Date</th>
                        <th>Pickup Date</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($queryData) > 0) {
                        while ($rowData = mysqli_fetch_assoc($queryData)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= isset($rowData['order_code']) ? $rowData['order_code'] : '-' ?></td>
                                <td><?= isset($rowData['customer_name']) ? $rowData['customer_name'] : '-' ?></td>
                                <td><?= isset($rowData['order_date']) ? $rowData['order_date'] : '-' ?></td>
                                <td><?= isset($rowData['order_end_date']) ? $rowData['order_end_date'] : '-' ?></td>
                                <td><?= isset($rowData['pickup_date']) ? $rowData['pickup_date'] : '-' ?></td>
                                <?php $statusOrder = getOrderStatus($rowData['order_status']) ?>
                                <td><?= $statusOrder ?></td>
                                <td class="text-end"> <?php if (isset($rowData['order_status']) && $rowData['order_status'] == 1): ?>
                                        <a href="admin/content/misc/print.php?order=<?= htmlspecialchars($rowData['id']) ?>" target="_blank" class="btn btn-secondary btn-sm me-1">
                                            <i class="tf-icon bx bx-printer bx-22px"></i> Print
                                        </a>
                                    <?php endif ?>
                                    <a href="?page=add-report&view=<?= htmlspecialchars($rowData['id']) ?>" class="btn btn-secondary btn-sm me-1">
                                        <i class="tf-icon bx bx-show bx-22px"></i> Lihat
                                    </a>
                                    <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                        href="?page=add-report&delete=<?= htmlspecialchars($rowData['id']) ?>" class="btn btn-danger btn-sm">
                                        <i class="tf-icon bx bx-trash bx-22px"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                    } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    <?php } // End While 
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-end"> </div>
    </div>
</div>