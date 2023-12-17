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
    <a href="anggotac.php" class="button">Tambah Data</a>
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

    $sql = "SELECT * FROM anggota";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border ='1'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Action</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["anggota_id"]."</td>";
            echo "<td>".$row["nama"]."</td>";
            echo "<td>".$row["alamat"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["telepon"]."</td>";
            echo "<td>
            <div class='action-buttons'>
                <a href='anggotau.php?id=".$row["anggota_id"]."' class='edit-button'>Edit</a>
                <a href='anggotad.php?id=".$row["anggota_id"]."' class='delete-button'>Hapus</a>
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
