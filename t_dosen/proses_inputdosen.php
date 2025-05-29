<?php

// Memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// Mengecek apakah tombol input dari form telah diklik
if (isset($_POST['input'])){

    // Membuat variabel untuk menampung data dari form
    $namaDosen = $_POST['namaDosen'];
    $noHP = $_POST['noHP'];

    // Jalankan query INSERT untuk menambah data ke database using prepared statement
    $query = "INSERT INTO t_dosen (namaDosen, noHP) VALUES (?, ?)"; // Use placeholders
    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die ("Query gagal dijalankan: ".mysqli_errno($link) . " - ".mysqli_error($link));
    }

    // Bind parameters
    // 'ss' denotes string, string for namaDosen and noHP
    mysqli_stmt_bind_param($stmt, 'ss', $namaDosen, $noHP);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Periksa query apakah ada error
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($link) . " - ".mysqli_error($link));
    }

    mysqli_stmt_close($stmt); // Close the statement
}

// Melakukan redirect (mengalihkan) ke halaman viewdosen.php
header("location:viewdosen.php");
?>