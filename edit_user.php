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
    if (empty($_POST['nama']) || empty($_POST['npm']) || empty($_POST['role'])) {
        $error = "Nama, NPM, dan peran pengguna harus diisi.";
    } else {
        $id = $_GET['id'];
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $role = $_POST['role'];
        $status = isset($_POST['status']) ? $_POST['status'] : null;

        // Lakukan query UPDATE ke database
        $query = "UPDATE users SET nama='$nama', npm='$npm', role='$role', status='$status' WHERE id='$id'";
        
        if (mysqli_query($conn, $query)) {
            header("location: lihat_user.php");
            exit();
        } else {
            $error = "Gagal memperbarui pengguna. Silakan coba lagi.";
        }
    }
}

// Ambil data pengguna yang akan diubah
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!-- edit_user.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<body>

<h2>Edit Pengguna</h2>

<form action="" method="post">
    Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br><br>
    NPM: <input type="text" name="npm" value="<?php echo $row['npm']; ?>"><br><br>
    Role: 
    <select name="role">
        <option value="admin" <?php if($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        <option value="mahasiswa" <?php if($row['role'] == 'mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
    </select><br><br>
    Status: 
    <input type="radio" name="status" value="aktif" <?php if($row['status'] == 'aktif') echo 'checked'; ?>> Aktif
    <input type="radio" name="status" value="tidak aktif" <?php if($row['status'] == 'tidak aktif') echo 'checked'; ?>> Tidak Aktif<br><br>
    <input type="submit" value="Simpan">
    <p style="color: red;"><?php echo $error; ?></p>
</form>

</body>
</html>
