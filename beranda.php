<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="beranda.css">
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
        <h2>Menu Dasbor: <?php echo $_SESSION['username'] ?></h2>
        <ul class="menu">
            <li><a href="beranda.php">Beranda</a></li>
            <li><a href="bukur.php">Buku</a></li>
            <li><a href="anggotar.php">Anggota</a></li>
            <li><a href="peminjamanr.php">Peminjaman</a></li>
            <li><a href="kategorir.php">Kategori</a></li>
        </ul>
        <a class="logout-link" href="logout.php">LOGOUT</a>
    </div>

    <div class="content">
        <h1>Selamat datang di Halaman Beranda Perpustakaan</h1>
    </div>
</div>

</body>
</html>
