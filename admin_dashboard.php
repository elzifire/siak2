<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html>
<body>

<header>
    <ul>
        <li><a href="lihat_matkul.php">Mata Kuliah</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="admin_nilai.php">Nilai</a></li>
    </ul>
</header>


<h1>HALAMAN ADMIN</h1>

<a href="logout.php">Logout</a>

</body>
</html>
