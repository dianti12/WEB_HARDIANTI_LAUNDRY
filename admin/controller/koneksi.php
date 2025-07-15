<?php

$connection = mysqli_connect("localhost", "root", "", "db_laundry_dianti");

if (!$connection) {
    echo "Unable to connect";
    die;
}
