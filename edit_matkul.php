<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['perbarui'])) {
        $id = $_POST['id'];
        $nama_matkul = $_POST['nama_matkul'];
        $nama_dosen = $_POST['nama_dosen'];

        // Lakukan validasi data

        // Lakukan query UPDATE ke database
        $query = "UPDATE matkul SET nama_matkul='$nama_matkul', nama_dosen='$nama_dosen' WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            header("location: lihat_matkul.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Ambil data mata kuliah yang akan diubah
$id = $_GET['id'];
$query = "SELECT * FROM matkul WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!-- edit_matkul.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mata Kuliah</title>
</head>
<body>

<h2>Edit Mata Kuliah</h2>

<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="nama_matkul">Nama Matkul</label>
    <input type="text" name="nama_matkul" value="<?php echo $row['nama_matkul']; ?>">
    <label for="nama_dosen">Nama Dosen</label>
    <input type="text" name="nama_dosen" value="<?php echo $row['nama_dosen']; ?>">
    <button type="submit" name="perbarui">Simpan</button>
</form>

</body>
</html>
