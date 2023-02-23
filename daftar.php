<?php 
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
    <?php include 'menu.php'; ?>

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Daftar Akun
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Nama :</label>
                                <div class="col-md-7">
                                    <input type="text" name="nama" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Email :</label>
                                <div class="col-md-7">
                                    <input type="email" name="email" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Password :</label>
                                <div class="col-md-7">
                                    <input type="password" name="password" class="form-control" id="inputPassword" autocomplete="none" required>
                                    <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                                    <script>
                                        function myFunction() {
                                            var x = document.getElementById("inputPassword");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Alamat :</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" class="form-control" id="" cols="30" rows="2" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">No HP :</label>
                                <div class="col-md-7">
                                    <input type="text" name="telepon" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-success" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>

                        <?php 
                            // jika ditekan tombol daftar
                            if(isset($_POST['daftar'])){
                                $nama = $_POST['nama'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $alamat = $_POST['alamat'];
                                $telepon = $_POST['telepon'];

                                // cek apakah email pernah digunakan
                                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
                                $yangcocok = $ambil->num_rows;
                                if($yangcocok==1){
                                    echo "<script>alert('Email sudah terdaftar');</script>";
                                    echo "<script>location='daftar.php';</script>";
                                }else{
                                    // masukkan data ke database pelanggan
                                    $koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");

                                    echo "<script>alert('Akun berhasil dibuat');</script>";
                                    echo "<script>location='login.php';</script>";
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>


</body>
</html>