<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="update.css">
</head>
<body>

<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
?>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT b.*, k.nama_kategori FROM buku b
        JOIN kategori k ON b.kategori_id = k.kategori_id
        WHERE b.buku_id = $id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_kategori = $row['nama_kategori'];

?>

<form action="update_buku.php" method="POST">
    <h2>Edit Buku</h2>
    Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br>
    Pengarang: <input type="text" name="pengarang" value="<?php echo $row['pengarang']; ?>"><br>
    Penerbit: <input type="text" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>
    Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>"><br>
    Sinopsis: <input type="text" name="sinopsis" value="<?php echo $row['sinopsis']; ?>"><br>
    Kategori: 
    <select name="kategori_id" id="kategori_id" onchange="fetchNamaKategori()">
        <?php
        // Ambil data untuk dropdown dinamis
        $query_kategori = "SELECT kategori_id FROM kategori";
        $result_kategori = $mysqli->query($query_kategori);

        if ($result_kategori->num_rows > 0) {
            while ($row_kategori = $result_kategori->fetch_assoc()) {
                $selected = ($row_kategori['kategori_id'] == $row['kategori_id']) ? 'selected' : '';
                echo '<option value="' . $row_kategori['kategori_id'] . '" ' . $selected . '>' . $row_kategori['kategori_id'] . '</option>';
            }
        } else {
            echo '<option value="">Tidak ada kategori tersedia</option>';
        }
        ?>
    </select><br>
    Nama Kategori: <input type="text" name="nama_kategori" id="nama_kategori" readonly value="<?php echo $nama_kategori; ?>"><br>
    <input type="hidden" name="id" value="<?php echo $row['buku_id']; ?>">
    <input type="submit" value="Update">
</form>


    <script>
        function fetchNamaKategori() {
            var kategori_id = document.getElementById('kategori_id').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_nama_kategori.php?kategori_id=' + kategori_id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('nama_kategori').value = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <?php
} else {
    echo "Data tidak ditemukan.";
}
$mysqli->close();
?>

</body>
</html>
