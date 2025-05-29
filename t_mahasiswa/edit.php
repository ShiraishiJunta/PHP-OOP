<?php include 'koneksi.php'; ?>
<?php
$npm = $_GET['npm'];
// Menggunakan prepared statement untuk SELECT
if ($stmt = mysqli_prepare($koneksi, "SELECT * FROM t_mahasiswa WHERE npm=?")) {
    mysqli_stmt_bind_param($stmt, "s", $npm); // 's' karena NPM mungkin dianggap string atau angka yang panjang
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    die("Error preparing statement: " . mysqli_error($koneksi));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Mahasiswa</h2>
    <a href="index.php" class="back-button">← Kembali</a>
    <form method="post">
        <input type="text" name="npm" value="<?= $data['npm'] ?>" readonly><br>
        <input type="text" name="namaMHS" value="<?= $data['namaMHS'] ?>" required><br>
        <input type="text" name="prodi" value="<?= $data['prodi'] ?>" required><br>
        <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required><br>
        <input type="text" name="noHP" value="<?= $data['noHP'] ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $npm = $_POST['npm'];
        $nama = $_POST['namaMHS'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHP = $_POST['noHP'];

        // Menggunakan prepared statement untuk UPDATE
        if ($stmt = mysqli_prepare($koneksi, "UPDATE t_mahasiswa SET namaMHS=?, prodi=?, alamat=?, noHP=? WHERE npm=?")) {
            mysqli_stmt_bind_param($stmt, "sssss", $nama, $prodi, $alamat, $noHP, $npm);
            $query_success = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($query_success) {
                header("Location: index.php");
                exit(); // Penting untuk menghentikan eksekusi setelah redirect
            } else {
                echo "<div class='error'>Gagal update data.</div>";
            }
        } else {
            echo "<div class='error'>Error preparing statement: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>
</div>
</body>
</html>