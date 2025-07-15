<?php
include 'admin/controller/administrator-validation.php';
$queryData = mysqli_query($config, "SELECT * FROM customer ORDER BY customer_name ASC");


?>
<div class="card shadow">
    <div class="card-header">
        <h3>Data Customer</h3>
    </div>
    <div class="card-body">
        <?php include 'admin/controller/alert-data-crud.php' ?>
        <div align="right" class="button-action">
            <a href="?page=add-customer" class="btn btn-primary"><i class='bx bx-plus'>Add Customer</i></a>
        </div>
        <table class="table table-bordered table-striped table-hover table-responsive mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>customer_name</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($rowData = mysqli_fetch_assoc($queryData)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= isset($rowData['customer_name']) ? $rowData['customer_name'] : '' ?></td>
                        <td><?= isset($rowData['phone']) ? $rowData['phone'] : '' ?></td>
                        <td><?= isset($rowData['address']) ? $rowData['address'] : '' ?></td>
                        <td><?= isset($rowData['action']) ? $rowData['action'] : '' ?>

                            <a href="?page=add-customer&edit=<?php echo $rowData['id'] ?>">
                                <button class="btn btn-secondary">
                                    <i class="tf-icon bx bx-edit bx-22px">Edit</i>
                                </button>
                            </a>
                            <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                href="?page=add-customer&delete=<?php echo $rowData['id'] ?>">
                                <button class="btn btn-danger">
                                    <i class="tf-icon bx bx-trash bx-22px">Delete</i>
                                </button>
                            </a>

                        </td>
                    </tr>
                <?php endwhile; // End While 
                ?>
            </tbody>
        </table>
        <div class="mt-4" align="right">
            <span class="me-4"><i class="bx bx-plus"></i> = Add</span>
            <span class="me-4"><i class="bx bx-edit"></i> = Edit</span>
            <span><i class="bx bx-trash"></i> = Delete</span>
        </div>
    </div>
</div>