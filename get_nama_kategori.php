<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['kategori_id'])) {
    $kategori_id = $_GET['kategori_id'];

    $query = "SELECT nama_kategori FROM kategori WHERE kategori_id = '$kategori_id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['nama_kategori'];
    } else {
        echo "Kategori tidak ditemukan";
    }

    $mysqli->close();
} else {
    echo "Invalid Request";
}
?>
