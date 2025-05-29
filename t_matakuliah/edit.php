<?php include 'koneksi.php'; ?>
<?php
$kodeMK = $_GET['kodeMK'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM t_matakuliah WHERE kodeMK=$kodeMK"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mata Kuliah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Mata Kuliah</h2>
    <a href="index.php" class="back-button">← Kembali</a>
    <form method="post">
        <input type="text" name="kodeMK" value="<?= $data['kodeMK'] ?>" readonly><br>
        <input type="text" name="namaMK" value="<?= $data['namaMK'] ?>" required><br>
        <input type="text" name="sks" value="<?= $data['sks'] ?>" required><br>
        <input type="text" name="jam" value="<?= $data['jam'] ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $kode = $_POST['kodeMK'];
        $nama = $_POST['namaMK'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];

        $query = mysqli_query($koneksi, "UPDATE t_matakuliah SET
            namaMK='$nama', sks='$sks', jam='$jam' WHERE kodeMK='$kode'");

        if ($query) {
            header("Location: index.php");
        } else {
            echo "Gagal update data.";
        }
    }
    ?>
</div>
</body>
</html>
