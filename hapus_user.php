<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan ID
    $query = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Redirect kembali ke halaman admin setelah penghapusan berhasil
        header("location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
