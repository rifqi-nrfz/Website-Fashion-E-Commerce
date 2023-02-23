<h2>Data Kategori</h2>

<?php 
    include '../koneksi.php';
    $semuadata = array();
    $ambil = $koneksi->query("SELECT * FROM kategori");
    while($tiap = $ambil->fetch_assoc()) {
        $semuadata[]=$tiap;
    }
?>

<table class="table table-bordered">
    <thead>
        <th>No</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </thead>
    <tbody>

    <?php foreach($semuadata as $key => $value) : ?>
        <tr>
            <td><?= $key+1; ?></td>
            <td><?= $value['nama_kategori']; ?></td>
            <td>
                <a href="" class="btn btn-warning">Ubah</a>
                <a href="" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<a href="" class="btn btn-primary">Tambah Data</a>

