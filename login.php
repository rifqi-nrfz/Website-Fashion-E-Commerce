<?php 
    session_start();
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="admin/assets/img/logo.png">
</head>
<body>
    
<?php include 'menu.php'; ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button class="btn btn-success" name="simpan">Login</button>
                        </form> <br>
                        <small>Belum punya akun? <strong><a href="daftar.php">Daftar Disini</a></strong></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        // jika tombol login ditekan
        if(isset($_POST['simpan'])){
            $email = $_POST['email'];
            $password =$_POST['password'];
            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

            // hitung akun yang terpanggil
            $akunyangcocok = $ambil->num_rows;

            // jika ada yang cocok maka diloginkan
            if($akunyangcocok==1){
                $akun= $ambil->fetch_assoc();
                $_SESSION['pelanggan'] = $akun;
                echo "<script>alert('Anda berhasil login');</script>";

                if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])){
                    echo "<script>location='checkout.php';</script>";
                }else{
                    echo "<script>location='index.php';</script>";
                }
                
            }else{
                echo "<script>alert('Gagal login, periksa email dan password anda');</script>";
                echo "<script>location='login.php';</script>";
            }
        }
    ?>

    <?php include 'footer.php'; ?>


</html>