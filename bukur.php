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
    <a href="bukuc.php" class="button">Tambah Data</a>
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
    $sql = "SELECT b.buku_id,b.judul,b.pengarang,b.penerbit,b.tahun_terbit,b.sinopsis,k.nama_kategori
    FROM buku b
    left JOIN kategori k ON b.kategori_id=k.kategori_id";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border= '1'>";
        echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Sinopsis</th><th>Kategori</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["buku_id"]."</td>";
            echo "<td>".$row["judul"]."</td>";
            echo "<td>".$row["pengarang"]."</td>";
            echo "<td>".$row["penerbit"]."</td>";
            echo "<td>".$row["tahun_terbit"]."</td>";
            echo "<td>".$row["sinopsis"]."</td>";
            echo "<td>".$row["nama_kategori"]."</td>";
            echo "<td>
            <div class='action-buttons'>
                <a href='bukuu.php?id=".$row["buku_id"]."' class='edit-button'>Edit</a>
                <a href='bukud.php?id=".$row["buku_id"]."' class='delete-button'>Hapus</a>
            </div>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data buku.";
    }
    $mysqli->close();
    ?>
</div>

</body>
</html>
