<?php
require_once 'admin/controller/koneksi.php';
include 'admin/controller/administrator-validation.php';

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $query = mysqli_query($config, "DELETE FROM type_of_service WHERE id='$idDelete'");
    header("Location: ?page=service&delete=success");
    die;
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($config, "SELECT * FROM type_of_service WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
    if (isset($_POST['edit'])) {
        $service_name = $_POST['service_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $queryEdit = mysqli_query($config, "UPDATE type_of_service SET service_name = '$service_name', price = '$price' , description = '$description' WHERE id='$idEdit'");
        header("Location: ?page=service&edit=success");
        die;
    }
} else if (isset($_POST['add'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $queryAdd = mysqli_query($config, "INSERT INTO type_of_service SET service_name = '$service_name', price = '$price' , description = '$description'");
    header("Location: ?page=service&add=success");
    die;
}

$querytype_of_service = mysqli_query($config, "SELECT * FROM type_of_service");
$rowtype_of_service = mysqli_fetch_all($querytype_of_service, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-header">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Jenis Layanan Laundry </h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="service_name" class="form-label">service_name</label>
                                <input type="text" name="service_name" class="form-control" placeholder="enter your service name" value="">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (gram)</label>
                                <input type="number" name="price" class="form-control" placeholder="enter price" value="">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="" align="right">
                        <a href="?page=service" class="btn btn-secondary">Back</a>
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