<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin atau mahasiswa
if (!(isset($_SESSION['user_id']) && (($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'mahasiswa')))) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

$query = "SELECT nilai.id, nilai.nilai, matkul.nama_matkul, users.nama
          FROM nilai
          INNER JOIN matkul ON nilai.matkul_id = matkul.id
          INNER JOIN users ON nilai.user_id = users.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Nilai</title>
</head>
<body>

<h2>Daftar Nilai</h2>

<a href="tambah_nilai.php">Tambah Nilai</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nilai</th>
        <th>Mata Kuliah</th>
        <th>Nama Mahasiswa</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nilai']; ?></td>
            <td><?php echo $row['nama_matkul']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td> <a href="edit_nilai.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="hapus_nilai.php?id="></a>

        </tr>
    <?php } ?>

</table>

</body>
</html>
