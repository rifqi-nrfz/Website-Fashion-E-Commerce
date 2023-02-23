<?php 
session_start();
include 'koneksi.php';
    // mendapatkan id_produk dari url
    $id_produk = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $detail = $ambil->fetch_assoc();
    
    // jika stok produk kosong
    if(empty($detail['stok_produk'])){
        echo "<script>alert('Maaf, Stok produk telah habis');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    // jika produk sudah ada di keranjang, maka jumlah di +1
    if(isset($_SESSION['keranjang'][$id_produk])){
        $_SESSION['keranjang'][$id_produk]+=1;
    }
    // selain itu(blm ada di keranjang),maka produk dianggap dibeli 1
    else{
        $_SESSION['keranjang'][$id_produk]=1;
        // larikan ke hal keranjang
    }

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    echo "<script>alert('produk telah dimasukkan ke keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";
?>