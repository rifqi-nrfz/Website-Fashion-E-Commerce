<?php 
    session_start();
    include 'koneksi.php';

    // mendapatkan id_produk dari url
    $id_produk = $_GET['id'];

    // query ambil data
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <section class="konten">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?= $detail['foto_produk']; ?>" alt="<?= $detail['foto_produk']; ?>" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?= $detail['nama_produk']; ?></h2>
                    <h4>Rp. <?= number_format($detail['harga_produk']); ?></h4>
                    <h5>Stok : <?= $detail['stok_produk']; ?></h5>
                    <?php if(empty($detail['stok_produk'])) : ?>
                        <div class="alert alert-danger">
                            <p>Stok produk sudah habis</p>
                        </div>
                    <?php endif; ?>
                    <p><?= $detail['deskripsi_produk']; ?></p>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" max="<?= $detail['stok_produk']; ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" name="beli">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php 
                        if(isset($_POST['beli'])) {
                            if($detail['stok_produk'] == 0){
                                echo "<script>alert('Stok produk sudah habis');</script>";
                            } else {
                                // mendapatkan jumlah pembelian
                                $jumlah = $_POST['jumlah'];
                                // masukkan di keranjang belanja
                                $_SESSION['keranjang'][$id_produk] = $jumlah;

                                echo "<script>alert('Produk telah dimasukkan ke keranjang');</script>";
                                echo "<script>location='keranjang.php';</script>";
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>


</body>
</html>