<?php

// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Mengecek apakah di url ada nilai GET idDosen
if (isset($_GET['idDosen'])){
    // Ambil nilai idDosen dari url dan disimpan dalam variabel $id
    $id = $_GET["idDosen"];

    // Menampilkan data t_dosen dari database yang mempunyai idDosen=$id using prepared statement
    $query = "SELECT IdDosen, namaDosen, noHP FROM t_dosen WHERE IdDosen = ?"; // Use placeholder
    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die ("Query Error : ".mysqli_errno($link)." - ". mysqli_error($link));
    }

    // Bind parameter
    // 'i' denotes integer for idDosen
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Mengecek apakah query gagal
    if (!$result){
        die ("Query Error : ".mysqli_errno($link)." - ". mysqli_error($link));
    }

    // Mengambil data dari database dan membuat variabel-variabel untuk menampung data
    // Variabel ini nantinya akan ditampilkan pada form

    $data = mysqli_fetch_assoc($result);
    $idDosen = $data["IdDosen"];
    $namaDosen = $data["namaDosen"];
    $noHP = $data["noHP"];

    mysqli_stmt_close($stmt); // Close the statement

    } else{
        // Apabila tidak ada data GET id pada akan di redirect ke index.php
        header("location:viewdosen.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        h1{
            text-align: center;
        }
        .container{
            width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Edit Data</h1>
    <div class="container">
        <form id="form_mahasiswa"action="proses_editdosen.php" method="post">
            <fieldset>
                <legend>Edit Data Dosen</legend>
                <p>
                    <label for="idDosen">ID : </label>
                    <input type="hidden" name="idDosen" value="<?php echo htmlspecialchars($idDosen); ?>">
                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo htmlspecialchars($idDosen) ?>" disabled >
                </p>
                <p>
                    <label for="namaDosen">Nama Dosen : </label>
                    <input type="text" name="namaDosen" id="namaDosen" value="<?php echo htmlspecialchars($namaDosen) ?>">
                </p>
                <p>
                    <label for="noHP">No HP : </label>
                    <input type="text" name="noHP" id="noHP" value="<?php echo htmlspecialchars($noHP) ?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update Data">
            </p>
        </form>
    </div>
</body>
</html>