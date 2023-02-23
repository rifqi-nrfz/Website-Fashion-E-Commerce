<?php 
    include 'koneksi.php';

    $keyword = $_GET['keyword'];
    $semuadata=array();
    $ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' OR harga_produk LIKE '%$keyword%'");
    while($pecah = $ambil->fetch_assoc()){
        $semuadata[]=$pecah;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    <?php 
        include 'menu.php';
    ?>
    <div class="container">
        <h3>Hasil Pencarian : <?= $keyword ?></h3> <br>

        <?php if(empty($semuadata)) : ?>
            <div class="alert alert-danger">Produk <b><?= $keyword; ?></b> tidak ditemukan</div>
        <?php endif; ?>
        <div class="row">

        <?php foreach($semuadata as $key => $value) : ?>

            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="foto_produk/<?= $value['foto_produk']; ?>" alt="" class="img-responsive">
                    <div class="caption">
                        <h3><?php echo $value['nama_produk']; ?></h3>
                            <h5>Rp. <?php echo number_format($value['harga_produk']); ?></h5>
                            <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-default">Beli</a>
                            <a href="detail.php?id=<?= $value['id_produk']; ?>" class="btn btn-success">Detail</a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>

    <?php include 'footer.php'; ?>


</body>
</html>