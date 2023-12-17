<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="create.css">
</head>
<body>

<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
?>

<div class="container">
    <div class="sidebar">
    <h2>Menu Dasbor</h2>
    <ul>
    <li><a href="beranda.php">Beranda</a></li>
        <li><a href="bukur.php">Buku</a></li>
        <li><a href="anggotar.php">Anggota</a></li>
        <li><a href="peminjamanr.php">Peminjaman</a></li>
        <li><a href="kategorir.php">Kategori</a></li>
    </ul>
</div>

<div class="form-container">
    <form action="kategoric.php" method="POST">
        <h2>Form Tambah Kategori</h2>
        Nama Kategori: <input type="text" name="nama_kategori"><br>
        <input type="submit" value="Tambah">
    </form>
</div>


<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama_kategori = $_POST['nama_kategori'];

    $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: kategorir.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>
</div>

</body>
</html>
