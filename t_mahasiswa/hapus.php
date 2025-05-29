<?php
include 'koneksi.php';
$npm = $_GET['npm'];

// Menggunakan prepared statement untuk DELETE
if ($stmt = mysqli_prepare($koneksi, "DELETE FROM t_mahasiswa WHERE npm=?")) {
    mysqli_stmt_bind_param($stmt, "s", $npm); // 's' karena NPM mungkin dianggap string atau angka yang panjang
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} else {
    die("Error preparing statement: " . mysqli_error($koneksi));
}

header("Location: index.php");
exit(); // Penting untuk menghentikan eksekusi setelah redirect
?>