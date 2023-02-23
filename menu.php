<link rel="stylesheet" href="admin/assets/css/style.css">

<nav class="navbar navbar-default"">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color: rgb(3, 172, 14);text-decoration: none;font-weight:bold">TOKO KLAMBI</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <li><a href="aboutus.php">About Us</a></li>

            <!-- jika sudah login pelanggan -->
            <?php if(isset($_SESSION['pelanggan'])): ?>
                <li><a href="riwayat.php">Riwayat Pembelian</a></li>
                <li style="margin-left: 15px;"><a href="logout.php" style="background-color:red;color:white;" onMouseOver="this.style.backgroundColor='#d43f3a'" onMouseOut="this.style.backgroundColor='red'">Logout</a></li>

            <!-- selain itu jika belum login pelanggan -->
            <?php else: ?>
                <li><a href="login.php" style="color:rgb(3, 172, 14);" onMouseOver="this.style.color='green'"
                onMouseOut="this.style.color='rgb(3, 172, 14)'">Login</a></li>
                <li style="margin-left: 10px;"><a href="daftar.php" style="color: white;background-color:rgb(3, 172, 14);" onMouseOver="this.style.backgroundColor='green'" onMouseOut="this.style.backgroundColor='rgb(3, 172, 14)'">Daftar</a></li>
            <?php endif; ?>
        </ul>
        <form action="pencarian.php" method="get" class="navbar-form navbar-right" style="margin-right: 110px;">
            <input type="text" class="form-control" name="keyword" placeholder="cari produk" autocomplete="off">
            <button class="btn" style="background-color: rgb(3, 172, 14);color:white;" onMouseOver="this.style.backgroundColor='green'" onMouseOut="this.style.backgroundColor='rgb(3, 172, 14)'">Cari</button>
        </form>
    </div>
  </div>
</nav>

<script src="admin/assets/js/jquery-1.10.2.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/jquery.metisMenu.js"></script>
    <script src="admin/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="admin/assets/js/morris/morris.js"></script>
    <script src="admin/assets/js/custom.js"></script>