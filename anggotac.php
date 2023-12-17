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
    <form action="anggotac.php" method="POST">
        <h2>Form Tambah Anggota</h2>
        Nama: <input type="text" name="nama"><br>
        Alamat: <input type="text" name="alamat"><br>
        Email: <input type="text" name="email"><br>
        Telepon: <input type="text" name="telepon"><br>
        <input type="submit" value="Tambah">
    </form>
</div>


<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $sql = "INSERT INTO anggota (nama, alamat, email, telepon) VALUES ('$nama', '$alamat', '$email', '$telepon')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: anggotar.php");
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
