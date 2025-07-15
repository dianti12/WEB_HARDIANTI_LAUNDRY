<?php
require_once 'admin/controller/koneksi.php';
include 'admin/controller/administrator-validation.php';

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $query = mysqli_query($config, "DELETE FROM customer WHERE id='$idDelete'");
    header("Location: ?page=customer&delete=success");
    die;
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($config, "SELECT * FROM customer WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
    if (isset($_POST['edit'])) {
        $customer_name = $_POST['customer_name'];
        $phone  = $_POST['phone'];
        $address = $_POST['address'];

        $queryEdit = mysqli_query($config, "UPDATE customer SET customer_name = '$customer_name' WHERE id='$idEdit'");
        header("Location: ?page=customer&edit=success");
        die;
    }
} else if (isset($_POST['add'])) {
    $customer_name = $_POST['customer_name'];
    $phone  = $_POST['phone'];
    $address = $_POST['address'];


    $queryAdd = mysqli_query($config, "INSERT INTO customer (customer_name, phone, address) VALUES ('$customer_name', '$phone', '$address')");
    header("Location: ?page=customer&add=success");
    die;
}

$querycustomer = mysqli_query($config, "SELECT * FROM customer");
$rowcustomer = mysqli_fetch_all($querycustomer, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-header">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Customer</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer</label>
                                <input type="text" name="customer_name" class="form-control" placeholder="enter your name" value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No Telpon</label>
                                <input type="text" name="phone" class="form-control" placeholder="enter your phone" value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control"><?php echo isset($_GET['edit']) ? $rowEdit['address'] : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="" align="right">
                        <a href="?page=customer" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary"
                            name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>">
                            <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>