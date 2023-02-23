<?php 
session_start();
include '../koneksi.php'; 
if(!isset($_SESSION['admin'])){
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php'</script>";
    header("Location:login.php");
    exit();
}
?>
<h2>Data Produk</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Deskripsi</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_produk']; ?></td>
                <td><?= $pecah['nama_kategori']; ?></td>
                <td><?= $pecah['harga_produk']; ?></td>
                <td><?= $pecah['berat_produk']; ?></td>
                <td>
                    <img src="../foto_produk/<?= $pecah['foto_produk']; ?>" width="100px">
                </td>
                <td><?= $pecah['deskripsi_produk']; ?></td>
                <td><?= $pecah['stok_produk']; ?></td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-danger">hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-warning">ubah</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>

