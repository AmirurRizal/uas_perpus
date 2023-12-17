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
$sql = "SELECT * FROM kategori WHERE kategori_id=$id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <form action="update_kategori.php" method="POST">
        <h2>Edit Kategori</h2>
        Nama Kategori: <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $row['kategori_id']; ?>">
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
