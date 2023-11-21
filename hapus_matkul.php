<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lakukan query DELETE dari database
    $query = "DELETE FROM matkul WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("location: lihat_matkul.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("location: lihat_matkul.php");
    exit();
}

?>
