<?php
include 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM peminjaman WHERE peminjaman_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: peminjamanr.php");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>