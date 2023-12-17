<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM kategori WHERE kategori_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: kategorir.php");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>