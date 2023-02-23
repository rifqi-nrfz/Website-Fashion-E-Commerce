<h2>Data Pembayaran</h2>

<?php 
    include '../koneksi.php';
    $id_pembelian = $_GET['id'];

    // mengambil data pembayaran berdasarkan id_pembelian
    $ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
    $detail = $ambil->fetch_assoc();

    $after = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
    $afterkonfirmasi = $after->fetch_assoc();
?>
<pre>
    <?php echo print_r($afterkonfirmasi); ?>
</pre>
<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $detail['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $detail['bank']; ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?= number_format($detail['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= $detail['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?= $detail['bukti']; ?>" alt="" class="img-responsive">
    </div>
</div>

<form action="" method="post">
    <div class="form-group">
        <label for="">No Resi Pengiriman</label>
        <input type="text" name="resi" class="form-control" id="" value="<?= $afterkonfirmasi['resi_pengiriman']; ?>">
    </div>

    <?php if($afterkonfirmasi['status_pembelian'] !== 'Dibayar') : ?>
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="<?= $afterkonfirmasi['status_pembelian']; ?>"><?= $afterkonfirmasi['status_pembelian']; ?></option>
                <option value="Dikonfirmasi">Dikonfirmasi</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Batal">Batal</option>
            </select>
        </div>
    <?php else : ?>
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="">Pilih Status</option>
                <option value="Dikonfirmasi">Dikonfirmasi</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Batal">Batal</option>
            </select>
        </div>
    <?php endif; ?>
    <button class="btn btn-primary" name="proses">Konfirmasi</button>
</form>

<?php 
    if(isset($_POST['proses'])){
        $resi = $_POST['resi'];
        $status =$_POST['status'];
        $koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

        echo "<script>alert('Status sukses di Update');</script>";
        echo "<script>location='index.php?halaman=pembelian';</script>";
    }
?>
