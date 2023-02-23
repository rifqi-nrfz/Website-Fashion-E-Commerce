<?php 
    session_start();
    include 'koneksi.php';

    $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
    $detbay = $ambil->fetch_assoc();

    // jika data pembayaran masih kosong
    if(empty($detbay)){
        echo "<script>alert('Silahkan Konfirmasi Pembayaran anda');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }

    // tidak bisa melihat data pembayaran pelanggan lain
    if($_SESSION['pelanggan']['id_pelanggan'] !== $detbay['id_pelanggan']){
        echo "<script>location='riwayat.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <div class="container">
        <h3>Data Pembayaran</h3>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $detbay['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?= $detbay['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $detbay['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?= $detbay['jumlah']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti_pembayaran/<?= $detbay['bukti']; ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>



</body>
</html>