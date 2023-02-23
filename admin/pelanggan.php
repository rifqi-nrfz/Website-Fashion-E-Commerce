
<h2>Data Pelanggan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php include '../koneksi.php'; ?>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_pelanggan']; ?></td>
                <td><?= $pecah['email_pelanggan']; ?></td>
                <td><?= $pecah['telepon_pelanggan']; ?></td>
            </tr>
            <?php $nomor++; ?>
        <?php }; ?>
    </tbody>
</table>
