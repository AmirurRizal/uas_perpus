<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM buku WHERE buku_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: bukur.php");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>