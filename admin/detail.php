<h2 align="center">DETAIL PEMBELIAN</h2>
<br>
<?php
include '../koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?= $detail['id_pembelian']; ?></strong><br>
        Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
        Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong><br>
        Telepon : <?php echo $detail['telepon_pelanggan']; ?><br>
        Email : <?php echo $detail['email_pelanggan']; ?>

    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?= $detail['kurir']; ?></strong><br>
        Ongkos Kirim Rp. <?= number_format($detail['tarif']); ?><br>
        Alamat : <?= $detail['alamat_pengiriman']; ?>
    </div>
</div><br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama']; ?></td>
                <td>Rp. <?= number_format($pecah['harga']); ?></td>
                <td><?= $pecah['jumlah']; ?></td>
                <td>Rp. <?= number_format($pecah['subharga']); ?></td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
