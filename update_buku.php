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
    $buku_id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $sinopsis = $_POST['sinopsis'];
    $kategori_id = $_POST['kategori_id'];

    $query_kategori = "SELECT nama_kategori FROM kategori WHERE kategori_id = '$kategori_id'";
    $result_kategori = $mysqli->query($query_kategori);

    if ($result_kategori) {
        $row_kategori = $result_kategori->fetch_assoc();
        $nama_kategori = $row_kategori['nama_kategori'];

        $update_query = "UPDATE buku SET
                        judul='$judul',
                        pengarang='$pengarang',
                        penerbit='$penerbit',
                        tahun_terbit='$tahun_terbit',
                        sinopsis='$sinopsis',
                        kategori_id='$kategori_id'
                        WHERE buku_id='$buku_id'";

        if ($mysqli->query($update_query) === TRUE) {
            echo '<script>
                    alert("Data berhasil diupdate.");
                    window.location.href = "bukur.php";
                  </script>';
        } else {
            echo "Error: " . $update_query . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Permintaan tidak valid.";
}

$mysqli->close();
?>


</body>
</html>
