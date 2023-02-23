<?php 
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>

<body>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h3>Menu's</h3>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="keranjang.php">Keranjang</a></li>
                            <li><a href="aboutus.php">About Us</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                    <?php if(isset($_SESSION['pelanggan'])): ?>
                        <h3>Sign Out</h3>
                            <ul>
                                <li><a href="riwayat.php">Riwayat Pembelian</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        <!-- selain itu jika belum login pelanggan -->
                    <?php else: ?>
                        <h3>Sign In</h3>
                            <ul>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="daftar.php">Daftar</a></li>
                            </ul>
                    <?php endif; ?>
                                
                    </div>
                    <div class="col-md-6 item text">
                        <h3>TOKO KLAMBI</h3>
                        <p>Perusahaan produk berkualitas sesuai dengan kenyamanan dan kebutuhan masyarakat. TOKO KLAMBI telah menyediakan berbagai produk sebagai solusi untuk memberdayakan jutaan konsumen agar mendapatkan kualitas dan kenyamanan dari penggunaan produk kami</p>
                    </div>
                </div>
                <p class="copyright">TOKO KLAMBI © 2021</p>
            </div>
        </footer>
    </div>
</body>


</html>
