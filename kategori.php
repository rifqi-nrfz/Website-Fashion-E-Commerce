<?php 
    include 'koneksi.php';

    $idkategori = $_GET['id'];
    $semuadata = array();
    $ambil = $koneksi->query("SELECT * FROM kategori LEFT JOIN produk ON kategori.id_kategori=produk.id_kategori WHERE kategori.id_kategori = '$idkategori'");
    while($pecah = $ambil->fetch_assoc()){
        $semuadata[] = $pecah;
    }
    if(empty($semuadata['0']['id_produk'])) {
        echo "<script>alert('Produk dengan kategori ini sedang tidak ada');</script>";
        echo "<script>location='index.php';</script>";
    }
    // echo "<<pre>";
    //     print_r($semuadata);
    // echo "</pre>";
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
    <title>Kategori | <?php echo $semuadata['0']["nama_kategori"]; ?></title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    <?php 
        include 'menu.php';
    ?>
    <div class="container">
        <h1>Kategori</h1>
            <?php foreach($datakategori as $key => $value) : ?>
                <a style="margin-right: 30px;font-size: 20px" href="kategori.php?id=<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></a>
            <?php endforeach; ?>
        <h3 style="margin-top: 30px;">Kategori : <?= $semuadata['0']["nama_kategori"]; ?></h3> <br>
        
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