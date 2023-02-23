<?php 
    $datakategori = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($tiap = $ambil->fetch_assoc()){
        $datakategori[] = $tiap;
    }
?>

<h2>Tambah Produk</h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" id="">
    </div>
    <div class="form-group">
        <label for="">Kategori</label>
        <select class="form-control" name="id_kategori" id="">
            <option value="">Pilih Kategori</option>
            <?php foreach($datakategori as $key => $value) : ?>
                <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
            <?php endforeach; ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" id="">
    </div>
    <div class="form-group">
        <label for="">Berat (gr)</label>
        <input type="number" class="form-control" name="berat" id="">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea name="deskripsi" id="" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="">Stok</label>
        <input type="number" class="form-control" name="stok" id="">
    </div>
    <div class="form-group">
        <label for="">Foto</label>
        <input type="file" class="form-control" name="foto" id="">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>


<?php
if (isset($_POST['save'])) {
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_produk/" . $nama);
    $koneksi->query("INSERT INTO produk(nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, stok_produk, id_kategori) VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]','$_POST[id_kategori]')");

    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>