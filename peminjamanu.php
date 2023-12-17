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
$sql = "SELECT p.*, a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON a.anggota_id = p.anggota_id
JOIN buku b ON b.buku_id = p.buku_id
WHERE p.peminjaman_id = $id";

    
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $judul = $row['judul'];
    $nama = $row['nama'];
    ?>
    <form action="update_peminjaman.php" method="POST">
        <h2>Edit Peminjaman</h2>
        ID buku: <select name="buku_id" id="buku_id" onchange="fetchNamaBuku()">
            <?php
            //dropdown dinamis
            $query_buku = "SELECT buku_id FROM buku";
            $result_buku = $mysqli->query($query_buku);

            if ($result_buku->num_rows > 0) {
                while ($row_buku = $result_buku->fetch_assoc()) {
                    $selected = ($row_buku['buku_id'] == $row['buku_id']) ? 'selected' : '';
                    echo '<option value="' . $row_buku['buku_id'] . '" ' . $selected . '>' . $row_buku['buku_id'] . '</option>';
                }
            } else {
                echo '<option value="">Tidak ada buku tersedia</option>';
            }
            ?>
        </select><br>

        Judul: <input type="text" name="judul" id="judul" readonly value="<?php echo $judul; ?>"><br>
        ID Anggota: <select name="anggota_id" id="anggota_id" onchange="fetchNamaAnggota()">
        <?php
        //dropdown dinamis
        $query_anggota = "SELECT anggota_id FROM anggota";
        $result_anggota = $mysqli->query($query_anggota);

        if ($result_anggota->num_rows > 0) {
            while ($row_anggota = $result_anggota->fetch_assoc()) {
                $selected = ($row_anggota['anggota_id'] == $row['anggota_id']) ? 'selected' : '';
                echo '<option value="' . $row_anggota['anggota_id'] . '" ' . $selected . '>' . $row_anggota['anggota_id'] . '</option>';
            }
        } else {
            echo '<option value="">Tidak ada anggota tersedia</option>';
        }
        ?>
        </select><br>

        Nama Anggota: <input type="text" name="nama" id="nama" readonly value="<?php echo $nama; ?>"><br>
        Tanggal peminjaman: <input type="date" name="tanggal_peminjaman" value="<?php echo $row['tanggal_peminjaman']; ?>"><br>
        Tanggal kembali: <input type="date" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>"><br>
        Status:
        <select name="status">
            <option value="dipinjam" <?php echo ($row['status'] == 'dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
            <option value="kembali" <?php echo ($row['status'] == 'kembali') ? 'selected' : ''; ?>>kembali</option>
        </select><br>
        <input type="hidden" name="id" value="<?php echo $row['peminjaman_id']; ?>">
        <input type="submit" value="Update">
    </form>
    
    <script>
        function fetchNamaBuku() {
            var buku_id = document.getElementById('buku_id').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_nama_buku.php?buku_id=' + buku_id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('judul').value = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <script>
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
    <?php
} else {
    echo "Data tidak ditemukan.";
}
$mysqli->close();
?>

</body>
</html>
