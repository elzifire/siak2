<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran mahasiswa
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'mahasiswa')) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Welcome Mahasiswa</h2>

    <a href="cetak_nilai.php">Cetak Nilai</a>



<a href="logout.php">Logout</a>

</body>
</html>
