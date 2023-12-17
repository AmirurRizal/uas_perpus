<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="update.css">
</head>
<body>

<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
?>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM anggota WHERE anggota_id=$id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <form action="update_anggota.php" method="POST">
        <h2>Edit Anggota</h2>
        Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
        Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        Telepon: <input type="text" name="telepon" value="<?php echo $row['telepon']; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $row['anggota_id']; ?>">
        <input type="submit" value="Update">
    </form>
    <?php
} else {
    echo "Data tidak ditemukan.";
}
$mysqli->close();
?>


</body>
</html>
