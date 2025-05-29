<?php

// Mengecek apakah tombol edit telah diklik
if (isset($_POST['edit'])){
    // Buat koneksi dengan database
    include("koneksi.php");

    // Membuat variabel untuk menampung data dari form edit
    $id = $_POST['idDosen'];
    $namaDosen = $_POST['namaDosen'];
    $noHP = $_POST['noHP'];

    // Buat dan jalankan query update using prepared statement
    $query = "UPDATE t_dosen SET namaDosen = ?, noHP = ? WHERE IdDosen = ?"; // Use placeholders
    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die ("Query gagal dijalankan : " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Bind parameters
    // 'ssi' denotes string, string, integer for namaDosen, noHP, and idDosen respectively
    mysqli_stmt_bind_param($stmt, 'ssi', $namaDosen, $noHP, $id);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Periksa hasil query apakah ada error
    if(!$result){
        die ("Query gagal dijalankan : " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    mysqli_stmt_close($stmt); // Close the statement
}

// Lakukan redirect ke halaman viewdosen.php
header("Location: viewdosen.php");
?>