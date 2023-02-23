<?php 
    session_start();
    include 'koneksi.php';

    // jika belum login tidak bisa masuk ke riwayat
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>location='login.php';</script>";
        exit();
    }

    // mendapatkan id pembelian dari url
    $idpem = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
    $detpem = $ambil->fetch_assoc();

    // mendapatkan id_pelanggan yg beli
    $id_pelanggan_beli = $detpem['id_pelanggan'];
    // mendapatkan id_pelanggan yg login
    $id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

    if($id_pelanggan_beli !== $id_pelanggan_login){
        echo "<script>location='riwayat.php';</script>";
        exit();
    }


    // echo "<pre>";
    //     print_r($detpem);
    //     print_r($_SESSION);
    
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim bukti pembayaran</p>
        <div class="alert alert-info">Total tagihan anda = <strong>Rp. <?= number_format($detpem['total_pembelian']); ?></strong></div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nama Pembayar :</label>
                <input type="text" class="form-control" name="nama" id="">
            </div>
            <div class="form-group">
                <label for="">Bank :</label>
                <input type="text" class="form-control" name="bank" id="">
            </div>
            <div class="form-group">
                <label for="">Jumlah :</label>
                <input type="number" class="form-control" name="jumlah" id="" value="<?= $detpem['total_pembelian']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Foto Bukti :</label>
                <input type="file" class="form-control" name="bukti" id="">
                <small class="text-danger">foto bukti harus jelas</small>
            </div>
            <button class="btn btn-success" name="kirim">Kirim</button>
        </form>
    </div>

    <?php 
        // jika tombol kirim ditekan
        if(isset($_POST['kirim'])){
            $namabukti = $_FILES['bukti']['name'];
            $lokasibukti = $_FILES['bukti']['tmp_name'];
            $namafiks = date("YmdHis").$namabukti;
            move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

            $nama = $_POST['nama'];
            $bank = $_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date("Y-m-d");

            // simpan pembayaran
            $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");
            // update status pembayaran
            $koneksi->query("UPDATE pembelian SET status_pembelian = 'Dibayar' WHERE id_pembelian='$idpem'");

            echo "<script>alert('Bukti telah dikirim ke admin');</script>";
            echo "<script>location='riwayat.php';</script>";
        }
    ?>

    <?php include 'footer.php'; ?>

</body>
</html>