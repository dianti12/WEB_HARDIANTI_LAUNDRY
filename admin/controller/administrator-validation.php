<?php
require_once 'admin/controller/koneksi.php';
$validationID = $_SESSION['id'];
$validationUserQuery = mysqli_query($config, "SELECT * FROM user WHERE id = '$validationID'");
$dataValidation = mysqli_fetch_assoc($validationUserQuery);

if ($dataValidation['id_level'] != 1) {
    header('Location: dashboard.php');
    die;
}
