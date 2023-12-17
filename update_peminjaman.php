<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
</head>
<body>

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $query_anggota = "SELECT nama FROM anggota WHERE anggota_id = '$anggota_id'";
    $result_anggota = $mysqli->query($query_anggota);

    if ($result_anggota) {
        $row_anggota = $result_anggota->fetch_assoc();
        $nama_anggota = $row_anggota['nama'];
    } else {
        echo "Error: Gagal mengambil data anggota.";
        exit;
    }

    $query_buku = "SELECT judul FROM buku WHERE buku_id = '$buku_id'";
    $result_buku = $mysqli->query($query_buku);

    if ($result_buku) {
        $row_buku = $result_buku->fetch_assoc();
        $judul_buku = $row_buku['judul'];
    } else {
        echo "Error: Gagal mengambil data buku.";
        exit;
    }

    $peminjaman_id = $_POST['id'];
    $update_query = "UPDATE peminjaman SET
                    buku_id='$buku_id',
                    anggota_id='$anggota_id',
                    tanggal_peminjaman='$tanggal_peminjaman',
                    tanggal_kembali='$tanggal_kembali',
                    status='$status'
                    WHERE peminjaman_id='$peminjaman_id'";

    if ($mysqli->query($update_query) === TRUE) {
        echo '<script>
                alert("Data berhasil diupdate.");
                window.location.href = "peminjamanr.php";
              </script>';
    } else {
        echo "Error: " . $update_query . "<br>" . $mysqli->error;
    }
} else {
    echo "Permintaan tidak valid.";
}

$mysqli->close();
?>

</body>
</html>
