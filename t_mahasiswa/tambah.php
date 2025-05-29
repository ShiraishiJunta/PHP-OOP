<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Mahasiswa</h2>
    <a href="index.php" class="back-button">← Kembali</a>
    <form method="post">
        <input type="text" name="npm" placeholder="NPM" required><br>
        <input type="text" name="namaMHS" placeholder="Nama Mahasiswa" required><br>
        <input type="text" name="prodi" placeholder="Prodi" required><br>
        <input type="text" name="alamat" placeholder="Alamat" required><br>
        <input type="text" name="noHP" placeholder="No HP" required><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $npm = $_POST['npm'];
        $nama = $_POST['namaMHS'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHP = $_POST['noHP'];

        // Cek apakah NPM sudah ada menggunakan prepared statement
        if ($stmt_check = mysqli_prepare($koneksi, "SELECT * FROM t_mahasiswa WHERE npm=?")) {
            mysqli_stmt_bind_param($stmt_check, "s", $npm);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check); // Menyimpan hasil untuk mysqli_stmt_num_rows
            
            if(mysqli_stmt_num_rows($stmt_check) > 0) {
                echo "<div class='error'>NPM sudah terdaftar!</div>";
            } else {
                // Menggunakan prepared statement untuk INSERT
                if ($stmt_insert = mysqli_prepare($koneksi, "INSERT INTO t_mahasiswa (npm, namaMHS, prodi, alamat, noHP) VALUES (?, ?, ?, ?, ?)")) {
                    mysqli_stmt_bind_param($stmt_insert, "sssss", $npm, $nama, $prodi, $alamat, $noHP);
                    $query_success = mysqli_stmt_execute($stmt_insert);
                    mysqli_stmt_close($stmt_insert);

                    if ($query_success) {
                        header("Location: index.php");
                        exit(); // Penting untuk menghentikan eksekusi setelah redirect
                    } else {
                        echo "<div class='error'>Gagal menambahkan data.</div>";
                    }
                } else {
                    echo "<div class='error'>Error preparing insert statement: " . mysqli_error($koneksi) . "</div>";
                }
            }
            mysqli_stmt_close($stmt_check);
        } else {
            echo "<div class='error'>Error preparing check statement: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>
</div>
</body>
</html>