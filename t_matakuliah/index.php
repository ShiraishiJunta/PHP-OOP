<?php
include 'koneksi.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$query = "SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Data Mata Kuliah</h2>
    <form method="get">
        <input type="text" name="keyword" placeholder="Cari nama matakuliah..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
    </form>
    <a href="tambah.php"><button>Tambah Matakuliah</button></a>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        <?php while($data = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $data['kodeMK'] ?></td>
            <td><?= $data['namaMK'] ?></td>
            <td><?= $data['sks'] ?></td>
            <td><?= $data['jam'] ?></td>
            <td>
                <a href="edit.php?kodeMK=<?= $data['kodeMK'] ?>">Edit</a> |
                <a href="hapus.php?kodeMK=<?= $data['kodeMK'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
