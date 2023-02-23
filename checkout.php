<?php 
    session_start();
    include 'koneksi.php';

    // jika belum login maka akan dilarikan ke login.php
    if(!isset($_SESSION['pelanggan'])) {
        echo "<script>alert('Silahkan login terlebih dahulu');</script>";
        echo "<script>location='login.php';</script>";
    }

    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo "<script>alert('Silahkan pilih produk terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <section class="konten">
        <div class="container">
            <h1>Halaman Checkout</h1>
            <hr>
            <table class="table table-bordered table-striped">
                <thead style="background-color:#5cb85c;">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor =1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                    <!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                    <?php 
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah['harga_produk']*$jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama_produk']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                    </tr>
                </tfoot>
            </table>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="id_ongkir" id="" class="form-control" required>
                                <option value="">Pilih Kurir</option>
                                <?php 
                                    $ambil = $koneksi->query("SELECT * FROM ongkir ORDER BY kurir");
                                    while($perongkir = $ambil->fetch_assoc()) {
                                ?>
                                <option value="<?= $perongkir['id_ongkir']; ?>"><?= $perongkir['kurir']; ?> - Rp. <?= number_format($perongkir['tarif']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label for="">Alamat Lengkap Pengiriman :</label>
                        <textarea name="alamat_pengiriman" id="" cols="30" rows="2" placeholder="Masukkan alamat lengkap pengiriman" class="form-control" required></textarea>
                    </div>
                    <button class="btn btn-success" name="checkout">Checkout</button>
                </form>        
                <?php 
                    if(isset($_POST['checkout'])){
                        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                        $id_ongkir = $_POST['id_ongkir'];
                        $tanggal_pembelian = date("Y-m-d");
                        $alamat_pengiriman = $_POST['alamat_pengiriman'];

                        $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                        $arrayongkir = $ambil->fetch_assoc();
                        $kurir = $arrayongkir['kurir'];
                        $tarif = $arrayongkir['tarif'];

                        $total_pembelian = $totalbelanja + $tarif;

                        // menyimpan data ke table pembelian
                        $koneksi->query("INSERT INTO pembelian(id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, kurir,tarif,alamat_pengiriman) VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$kurir','$tarif','$alamat_pengiriman')");

                        // mendapatkan id_pembelian yang dilakukan
                        $id_pembelian_barusan = $koneksi->insert_id;

                        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                            // mendapatkan data produk berdasarkan id_produk
                            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                            $perproduk = $ambil->fetch_assoc();

                            $nama = $perproduk['nama_produk'];
                            $harga = $perproduk['harga_produk'];
                            $berat = $perproduk['berat_produk'];
                            $subberat = $perproduk['berat_produk']*$jumlah;
                            $subharga = $perproduk['harga_produk']*$jumlah;
                            $koneksi ->query("INSERT INTO pembelian_produk(id_pembelian, id_produk,jumlah,nama,harga,berat,subberat,subharga) VALUES ('$id_pembelian_barusan','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga')");

                            // update stok
                            $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
                        }
                        // mengkosongkan keranjang belanja
                        unset($_SESSION['keranjang']);

                        // masuk ke halaman nota
                        echo "<script>alert('Checkout sukses');</script>";
                        echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
                    }
                ?>
        </div>
    </section>

</body>
</html>