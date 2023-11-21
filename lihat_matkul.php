<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

$query = "SELECT * FROM matkul";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mata Kuliah</title>
</head>
<body>

<h2>Daftar Mata Kuliah</h2>

<a href="tambah_matkul.php">Tambah Mata Kuliah</a>
<br>
<br>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Mata Kuliah</th>
        <th>Nama Dosen</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama_matkul']; ?></td>
            <td><?php echo $row['nama_dosen']; ?></td>
            <td> <a href="edit_matkul.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="hapus_matkul.php?id=<?php echo $row['id']; ?>">Hapus</a>
        </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
