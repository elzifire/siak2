<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran mahasiswa
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'mahasiswa')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

// Ambil ID user yang sedang login
$user_id = $_SESSION['user_id'];

$query = "SELECT nilai.nilai, matkul.nama_matkul
          FROM nilai
          INNER JOIN matkul ON nilai.matkul_id = matkul.id
          WHERE nilai.user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Nilai Mahasiswa</title>
</head>
<body>

<h2>Daftar Nilai</h2>

<table border="1">
    <tr>
        <th>Nilai</th>
        <th>Mata Kuliah</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['nilai']; ?></td>
            <td><?php echo $row['nama_matkul']; ?></td>
        </tr>
    <?php } ?>

</table>

<button onclick="print()">PRINT</button>

</body>
</html>
