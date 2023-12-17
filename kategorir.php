<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="read.css">
</head>
<body>

<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
    }
?>

<div class="action-buttons">
    <a href="kategoric.php" class="button">Tambah Data</a>
</div>

<div class="sidebar">
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="bukur.php">Buku</a></li>
        <li><a href="anggotar.php">Anggota</a></li>
        <li><a href="peminjamanr.php">Peminjaman</a></li>
        <li><a href="kategorir.php">Kategori</a></li>
    </ul>
</div>

<div class="content">
    <?php
    include 'koneksi.php';

    $sql = "SELECT * FROM kategori";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border ='1'>";
        echo "<tr><th>ID</th><th>Nama kategori</th><th>Action</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["kategori_id"]."</td>";
            echo "<td>".$row["nama_kategori"]."</td>";
            echo "<td>
            <div class='action-buttons'>
                <a href='kategoriu.php?id=".$row["kategori_id"]."' class='edit-button'>Edit</a>
                <a href='kategorid.php?id=".$row["kategori_id"]."' class='delete-button'>Hapus</a>
            </div>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data kategori.";
    }
    $mysqli->close();
    ?>
</div>

</body>
</html>
