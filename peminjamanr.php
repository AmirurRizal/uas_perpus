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
    <a href="peminjamanc.php" class="button">Tambah Data</a>
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
    $sql = "SELECT a.peminjaman_id,a.tanggal_peminjaman,a.tanggal_kembali,b.judul,c.nama, a.status
    FROM peminjaman a
    left JOIN buku b ON a.buku_id=b.buku_id
    left JOIN anggota c ON c.anggota_id=a.anggota_id";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border= '1'>";
        echo "<tr><th>ID</th><th>Buku</th><th>Anggota</th><th>Tanggal Peminjaman</th><th>Tanggal Kembali</th><th>Status</th><th>Action</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["peminjaman_id"]."</td>";
            echo "<td>".$row["judul"]."</td>";
            echo "<td>".$row["nama"]."</td>";
            echo "<td>".$row["tanggal_peminjaman"]."</td>";
            echo "<td>".$row["tanggal_kembali"]."</td>";
            echo "<td>".$row["status"]."</td>";
            echo "<td>
            <div class='action-buttons'>
                <a href='peminjamanu.php?id=".$row["peminjaman_id"]."' class='edit-button'>Edit</a>
                <a href='peminjamand.php?id=".$row["peminjaman_id"]."' class='delete-button'>Hapus</a>
            </div>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data anggota.";
    }
    $mysqli->close();
    ?>
</div>

</body>
</html>
