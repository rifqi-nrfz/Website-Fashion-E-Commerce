<?php
session_start();
include 'koneksi.php';

?>
<?php 
    $datakategori = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($tiap = $ambil->fetch_assoc()){
        $datakategori[] = $tiap;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Klambi</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    <?php include 'menu.php'; ?>

    <section class="konten">
        <div class="container">
            <h1>Kategori</h1>
            <?php foreach($datakategori as $key => $value) : ?>
                <a style="margin-right: 30px;font-size: 20px" href="kategori.php?id=<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></a>
            <?php endforeach; ?>

            <h1 style="margin-top: 30px;">Produk Terbaru</h1>
            <div class="row">

                <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
                <?php while($perproduk=$ambil->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?= $perproduk['foto_produk']; ?>" alt="">
                        <div class="caption">
                            <h3><?php echo $perproduk['nama_produk']; ?></h3>
                            <h5>
                                Rp. <?php echo number_format($perproduk['harga_produk']); ?>
                                <?php 
                                    if(empty($perproduk['stok_produk'])){
                                        echo "<small class='text-danger bg-danger'>Stok habis</small>";
                                    }
                                ?>
                            </h5>
                            <a href="beli.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-default">Beli</a>
                            <a href="detail.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-success">Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>


</body>
</html>