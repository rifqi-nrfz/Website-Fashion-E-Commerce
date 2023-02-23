<?php 
    session_start();
    include 'koneksi.php';

    // jika belum login tidak bisa masuk ke riwayat
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>location='login.php';</script>";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css//bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Pembelian <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomor = 1;
                        // mendapatkan data dari session
                        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                        $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                        while($pecah = $ambil->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= $pecah['tanggal_pembelian']; ?></td>
                        <td>
                            ⦿ <?= $pecah['status_pembelian']; ?>
                            <?php if(!empty($pecah['resi_pengiriman'])) : ?>
                                => Resi : <?= $pecah['resi_pengiriman']; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($pecah['total_pembelian']); ?></td>
                        <td>
                            <a href="nota.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-default">Nota</a>

                            <?php if($pecah['status_pembelian'] == 'Pending') : ?>
                                <a href="pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info">Konfirmasi Pembayaran</a>
                            <?php else : ?>
                                <a href="lihat_pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section><br><br><br><br><br><br><br>

    <?php include 'footer.php'; ?>

</body>
</html>