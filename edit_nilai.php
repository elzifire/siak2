<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nilai'])) {
        $error = "Nilai harus diisi.";
    } else {
        $id = $_POST['id'];
        $nilai = $_POST['nilai'];

        // Lakukan query UPDATE ke database
        $query = "UPDATE nilai SET nilai='$nilai' WHERE id='$id'";
        
        if (mysqli_query($conn, $query)) {
            header("location: admin_nilai.php");
            exit();
        } else {
            $error = "Gagal memperbarui nilai. Silakan coba lagi.";
        }
    }
}

// Ambil data nilai yang akan diubah
$id = $_GET['id'];
$query = "SELECT * FROM nilai WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!-- edit_nilai.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Nilai</title>
</head>
<body>

<h2>Edit Nilai</h2>

<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    Nilai: <input type="text" name="nilai" value="<?php echo $row['nilai']; ?>"><br><br>
    <input type="submit" value="Simpan">
    <p style="color: red;"><?php echo $error; ?></p>
</form>

</body>
</html>
