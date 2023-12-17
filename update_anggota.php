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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $update_query = "UPDATE anggota SET
                    nama='$nama',
                    alamat='$alamat',
                    email='$email',
                    telepon='$telepon'
                    WHERE anggota_id='$id'";

    if ($mysqli->query($update_query) === TRUE) {
        header("Location: anggotar.php");
        exit;
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
