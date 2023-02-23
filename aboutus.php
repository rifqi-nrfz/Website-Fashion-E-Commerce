<?php
session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <div class="container">
        <div class="col-md-4 text-center">
            <h1 style="margin-bottom: 30px;">Profile</h1>
            <center><img src="admin/assets/img/aboutus.jpg" class="img-responsive" alt="" width="300px"></center>
        </div>
        <div class="col-md-4">
            <h3 style="margin-top: 100px;">Rifqi Nur Fauzi</h3>
            <h3>L200190029</h3>
            <h3>Kelas A</h3>
            <h3>Program Studi Informatika</h3>
            <h3>Universitas Muhammadiyah Surakarta</h3>
        </div>
        <div class="col-md-4">
            <center><img src="admin/assets/img/UMS.png" class="img-responsive" alt="" width="300px" style="margin-top: 85px;"></center>
        </div>
    </div>

    <?php include 'footer.php'; ?>


</body>
</html>