<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM anggota WHERE anggota_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: anggotar.php");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>