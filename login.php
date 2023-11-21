<?php
// file ini untuk memproses login
include 'koneksi.php';

// Menerima input dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $password = $_POST['password'];

    // Mencegah SQL injection
    $npm = mysqli_real_escape_string($conn, $npm);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk memeriksa kecocokan data
    $sql = "SELECT * FROM users WHERE npm = '$npm' and password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data ditemukan, set session dan redirect ke halaman yang sesuai
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        // Redirect ke halaman yang sesuai berdasarkan peran
        if ($row['role'] == 'admin') {
            header("location: admin_dashboard.php");
        } elseif ($row['role'] == 'mahasiswa') {
            header("location: mahasiswa_dashboard.php");
        } else {
            echo "Role tidak valid.";
        }
    } else {
        echo "NPM atau kata sandi salah.";
    }
}
$conn->close();
?>
