<?php

// Buka koneksi dengan MySQL
include ("koneksi.php");

// Mengecek apakah di url ada get idDosen
if (isset($_GET['idDosen'])){
    // Menyimpan variabel id dari url ke dalam variabel $idDosen
    $id = $_GET["idDosen"];

    // Jalankan query DELETE untuk menghapus data using prepared statement
    $query = "DELETE FROM t_dosen WHERE IdDosen = ?"; // Use placeholder
    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die ("Gagal menghapus data : " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Bind parameter
    // 'i' denotes integer for idDosen
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the statement
    $hasil_query = mysqli_stmt_execute($stmt);

    // Periksa query, apakah ada kesalahan
    if (!$hasil_query){
        die ("Gagal menghapus data : " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    mysqli_stmt_close($stmt); // Close the statement
}

// Melakukan redirect ke halaman viewdosen.php
header("Location: viewdosen.php");
?>