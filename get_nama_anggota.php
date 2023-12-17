<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['anggota_id'])) {
    $anggota_id = $_GET['anggota_id'];

    $query = "SELECT nama FROM anggota WHERE anggota_id = '$anggota_id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['nama'];
    } else {
        echo "Anggota tidak ditemukan";
    }

    $mysqli->close();
} else {
    echo "Invalid Request";
}
?>
