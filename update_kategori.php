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
    $nama_kategori = $_POST['nama_kategori'];

    $kategori_id = $_POST['id'];
    $update_query = "UPDATE kategori SET
                nama_kategori='$nama_kategori'
                WHERE kategori_id='$kategori_id'";


    if ($mysqli->query($update_query) === TRUE) {
        echo '<script>
                alert("Data berhasil diupdate.");
                window.location.href = "kategorir.php";
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
