<?php
session_start();
require_once 'admin/controller/koneksi.php';
require_once 'admin/controller/functions.php'; // Pastikan file ini ada dan berisi fungsi yang dibutuhkan

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']); // Sanitasi input
    $password = mysqli_real_escape_string($connection, $_POST['password']); // Sanitasi input

    // Gunakan prepared statements untuk keamanan lebih lanjut jika memungkinkan,
    // tapi untuk saat ini, mysqli_real_escape_string sudah cukup sebagai perbaikan cepat.

    $queryLogin = mysqli_query($connection, "SELECT id, email, password FROM user WHERE email='$email'");

    if (mysqli_num_rows($queryLogin) > 0) {
        $rowLogin = mysqli_fetch_assoc($queryLogin);

        // Perhatian: Sebaiknya gunakan password_verify() jika Anda menyimpan password yang di-hash.
        // Jika password di database tidak di-hash, ini sudah berfungsi.
        if ($password == $rowLogin['password']) {
            $_SESSION['id'] = $rowLogin['id'];
            $_SESSION['name'] = $rowLogin['name'];
            header("location: dashboard.php");
            exit(); // Penting: selalu gunakan exit() setelah header redirect
        } else {
            // Jika password salah, arahkan kembali dengan pesan error
            header("location: index.php?login=failed&message=wrong_password");
            exit();
        }
    } else {
        // Jika email tidak ditemukan
        header("location: index.php?login=failed&message=email_not_found");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Laundry Dianti</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            /* Gradien latar belakang modern */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }

        .login-card {
            border-radius: 1.5rem;
            /* Sudut lebih membulat */
            overflow: hidden;
            /* Penting agar border-radius bekerja pada nested row */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            /* Shadow lebih menonjol */
            background-color: #fff;
        }

        .login-card .card-body {
            padding: 0;
        }

        .login-image-section {
            background-color: #f8f9fa;
            /* Latar belakang untuk bagian gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-image-section img {
            max-width: 100%;
            /* Gambar responsif */
            height: auto;
            border-radius: 1rem;
            /* Sudut gambar membulat */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .login-form-section {
            padding: 40px;
        }

        .login-form-section .text-center h1 {
            color: #343a40;
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        .form-control-user {
            border-radius: 0.5rem;
            /* Sudut input lebih membulat */
            padding: 1rem 1.25rem;
            /* Padding lebih besar */
            font-size: 1rem;
            margin-bottom: 1.5rem;
            /* Jarak antar input */
            border: 1px solid #ced4da;
        }

        .form-control-user:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25);
        }

        .btn-user {
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #6a11cb;
            /* Warna primer yang serasi dengan gradien */
            border-color: #6a11cb;
        }

        .btn-primary:hover {
            background-color: #550ca1;
            border-color: #550ca1;
        }

        .form-group .small {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .text-center a.small {
            color: #2575fc;
            /* Warna link yang serasi */
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .text-center a.small:hover {
            color: #1a5acb;
        }

        .alert {
            font-size: 0.9rem;
            padding: 0.75rem 1.25rem;
            margin-top: 15px;
        }

        @media (max-width: 992px) {
            .login-image-section {
                display: none;
                /* Sembunyikan gambar di layar kecil */
            }

            .col-lg-6 {
                width: 100%;
            }

            .login-form-section {
                padding: 30px;
            }

            .login-card {
                margin: 20px;
                /* Atur margin agar tidak terlalu rapat di mobile */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card login-card my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block login-image-section mt-5">
                                <img src="./img/cover.jpg" alt="Laundry Dianti Logo">
                            </div>
                            <div class="col-lg-6 login-form-section">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Laundry System</h1>
                                    </div>

                                    <?php
                                    // Tampilkan pesan error jika login gagal
                                    if (isset($_GET['login']) && $_GET['login'] == 'failed') {
                                        $message = "Email atau password salah.";
                                        if (isset($_GET['message'])) {
                                            if ($_GET['message'] == 'wrong_password') {
                                                $message = "Password yang Anda masukkan salah.";
                                            } elseif ($_GET['message'] == 'email_not_found') {
                                                $message = "Email tidak terdaftar.";
                                            }
                                        }
                                        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($message) . '</div>';
                                    }
                                    ?>

                                    <form action="" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <!-- <div class="form-group mb-4">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>