<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="create.css">
</head>
<body>

<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
?>

<div class="container">
    <div class="sidebar">
    <h2>Menu Dasbor</h2>
    <ul>
        <li><a href="beranda.php">Beranda</a></li>
        <li><a href="bukur.php">Buku</a></li>
        <li><a href="anggotar.php">Anggota</a></li>
        <li><a href="peminjamanr.php">Peminjaman</a></li>
        <li><a href="kategorir.php">Kategori</a></li>
    </ul>
</div>

<div class="form-container">
    <form action="bukuc.php" method="POST" id="formTambahBuku">
        <h2>Form Tambah Buku</h2>
        Judul: <input type="text" name="judul"><br>
        Pengarang: <input type="text" name="pengarang"><br>
        Penerbit: <input type="text" name="penerbit"><br>
        Tahun Terbit: <input type="text" name="tahun_terbit"><br>
        Sinopsis: <input type="text" name="sinopsis"><br>
        ID Kategori: <select name="kategori_id" id="kategori_id" onchange="fetchNamaKategori()">
            <?php
            include 'koneksi.php';

            // Ambil data untuk dropdown dinamis
            $query = "SELECT kategori_id FROM kategori";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['kategori_id'] . '">' . $row['kategori_id'] . '</option>';
                }
            } else {
                echo '<option value="">Tidak ada kategori tersedia</option>';
            }

            $mysqli->close();
            ?>
        </select><br>
        Nama Kategori: <input type="text" name="nama_kategori" id="nama_kategori" readonly><br>
        <input type="submit" value="Tambah">
    </form>
</div>

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
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $sinopsis = $_POST['sinopsis'];
    $kategori_id = $_POST['kategori_id'];

    $query = "SELECT nama_kategori FROM kategori WHERE kategori_id = '$kategori_id'";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_kategori = $row['nama_kategori'];
    } else {
        $nama_kategori = "Kategori tidak ditemukan";
    }

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, sinopsis, kategori_id) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$sinopsis', '$kategori_id')";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: bukur.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>

</body>
</html>
