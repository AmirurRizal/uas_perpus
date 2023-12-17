<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['buku_id'])) {
    $buku_id = $_GET['buku_id'];

    $query = "SELECT judul FROM buku WHERE buku_id = '$buku_id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['judul'];
    } else {
        echo "Buku tidak ditemukan";
    }

    $mysqli->close();
} else {
    echo "Invalid Request";
}
?>
