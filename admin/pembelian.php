<h2>Data Pembelian</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Status Pembelian</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php include '../koneksi.php'; ?>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan ORDER BY status_pembelian"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_pelanggan']; ?></td>
                <td><?= $pecah['tanggal_pembelian']; ?></td>
                <td>⦿ <?= $pecah['status_pembelian']; ?></td>
                <td><?= $pecah['total_pembelian']; ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info">detail</a>

                    <?php if($pecah['status_pembelian'] =='Dibayar') : ?>
                        <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-warning">Konfirmasi</a>
                    <?php elseif($pecah['status_pembelian'] =='Dikonfirmasi') : ?>
                        <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-danger">Input Resi</a>
                    <?php elseif($pecah['status_pembelian'] =='Dikirim') : ?>
                    <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-default">Lihat</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php }; ?>
    </tbody>
</table>
