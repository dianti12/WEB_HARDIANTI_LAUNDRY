<?php
include 'admin/controller/administrator-validation.php';
$queryData = mysqli_query($config, "SELECT user.id, user.username, user.email, level.level_name FROM user LEFT JOIN level ON user.id_level = level.id ORDER BY user.id_level ASC, user.updated_at DESC");
?>
<div class="card shadow">
    <div class="card-header">
        <h3>Data User</h3>
    </div>
    <div class="card-body">
        <?php include 'admin/controller/alert-data-crud.php' ?>
        <div align="right" class="button-action">
            <a href="?page=add-user" class="btn btn-primary"><i class='bx bx-plus'>Add User</i></a>
        </div>
        <table class="table table-bordered table-striped table-hover table-responsive mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Level</th>
                    <th>Full Nama</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($rowData = mysqli_fetch_assoc($queryData)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= isset($rowData['level_name']) ? $rowData['level_name'] : '-' ?></td>
                        <td><?= isset($rowData['username']) ? $rowData['username'] : '-' ?></td>
                        <td><?= isset($rowData['email']) ? $rowData['email'] : '-' ?></td>
                        <td>
                            <a href="?page=add-user&edit=<?php echo $rowData['id'] ?>">
                                <button class="btn btn-secondary">
                                    <i class="tf-icon bx bx-edit bx-22px">Edit</i>
                                </button>
                            </a>
                            <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                href="?page=add-user&delete=<?php echo $rowData['id'] ?>">
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