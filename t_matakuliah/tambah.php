<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Mata Kuliah</h2>
    <a href="index.php" class="back-button">← Kembali</a>
    <form method="post">
        <input type="text" name="kodeMK" placeholder="Kode Mata kuliah" required><br>
        <input type="text" name="namaMK" placeholder="Nama Mata kuliah" required><br>
        <input type="text" name="sks" placeholder="SKS" required><br>
        <input type="text" name="jam" placeholder="Jam" required><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $kode = $_POST['kodeMK'];
        $nama = $_POST['namaMK'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];

        // Cek apakah kode MK sudah ada
        $cek = mysqli_query($koneksi, "SELECT * FROM t_matakuliah WHERE kodeMK='$kode'");
        if(mysqli_num_rows($cek) > 0) {
            echo "<div class='error'>Kode Matakuliah sudah ada!</div>";
        } else {
            $query = mysqli_query($koneksi, "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kode', '$nama', '$sks','$jam')");

            if ($query) {
                header("Location: index.php");
            } else {
                echo "<div class='error'>Gagal menambahkan data.</div>";
            }
        }
    }
    ?>
</div>
</body>
</html>
