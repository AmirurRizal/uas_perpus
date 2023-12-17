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
<form action="peminjamanc.php" method="POST" id="peminjamanForm">
    <h2>Form Peminjaman</h2>
    ID Buku: <select name="buku_id" id="buku_id" onchange="fetchNamaBuku()">
        <?php
        include 'koneksi.php';

        // Ambil data untuk dropdown dinamis
        $query = "SELECT buku_id FROM buku";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['buku_id'] . '">' . $row['buku_id'] . '</option>';
            }
        } else {
            echo '<option value="">Tidak ada buku tersedia</option>';
        }

        $mysqli->close();
        ?>
    </select><br>
    Judul: <input type="text" name="judul" id="judul" readonly><br>
    ID Anggota: <select name="anggota_id" id="anggota_id" onchange="fetchNamaAnggota()">
        <?php
        include 'koneksi.php';

        // Ambil data untuk dropdown dinamis
        $query = "SELECT anggota_id FROM anggota";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['anggota_id'] . '">' . $row['anggota_id'] . '</option>';
            }
        } else {
            echo '<option value="">Tidak ada angggota tersedia</option>';
        }

        $mysqli->close();
        ?>
    </select><br>
    Nama Anggota: <input type="text" name="nama" id="nama" readonly><br>
    Tanggal peminjaman: <input type="date" name="tanggal_peminjaman"><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali"><br>
    Status:
    <select name="status">
        <option value="dipinjam">Dipinjam</option>
        <option value="kembali">Kembali</option>
    </select><br>
    <input type="submit" value="Tambah">
</form>
</div>

<script>
function fetchNamaBuku() {
    var buku_id = document.getElementById('buku_id').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_nama_buku.php?buku_id=' + buku_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('judul').value = xhr.responseText;

            // Panggil fetchNamaAnggota setelah mengambil data Buku
            fetchNamaAnggota();
        }
    };
    xhr.send();
}

function fetchNamaAnggota() {
    var anggota_id = document.getElementById('anggota_id').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_nama_anggota.php?anggota_id=' + anggota_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('nama').value = xhr.responseText;
        }
    };
    xhr.send();
}
</script>


</body>
</html>

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $query = "SELECT judul FROM buku WHERE buku_id = '$buku_id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $judul = $row['judul'];
    } else {
        $judul = "Judul tidak ditemukan";
    }

    $query = "SELECT nama FROM anggota WHERE anggota_id = '$anggota_id'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
    } else {
        $nama = "nama tidak ditemukan";
    }

    $sql = "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_peminjaman, tanggal_kembali, status) VALUES ('$buku_id', '$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali', '$status')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: peminjamanr.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>
