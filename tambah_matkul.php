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
    if (empty($_POST['nama_matkul']) || empty($_POST['nama_dosen'])) {
        $error = "Nama mata kuliah dan nama dosen harus diisi.";
    } else {
        $nama_matkul = $_POST['nama_matkul'];
        $nama_dosen = $_POST['nama_dosen'];

        // Periksa apakah data sudah ada di database
        $check_query = "SELECT * FROM matkul WHERE nama_matkul='$nama_matkul' AND nama_dosen='$nama_dosen'";
        $result = mysqli_query($conn, $check_query);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $error = "Data sudah ada di database.";
        } else {
            // Lakukan query INSERT ke database
            $query = "INSERT INTO matkul (nama_matkul, nama_dosen) VALUES ('$nama_matkul', '$nama_dosen')";
            
            if (mysqli_query($conn, $query)) {
                header("location: lihat_matkul.php");
                exit();
            } else {
                $error = "Gagal menambahkan mata kuliah. Silakan coba lagi.";
            }
        }
    }
}
?>

<!-- tambah_matkul.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
</head>
<body>

<h2>Tambah Mata Kuliah</h2>

<form action="" method="post">
    <label for="nama_matkul">Nama Mata Kuliah</label>
    <input type="text" name="nama_matkul">
    <label for="nama_dosen">Nama Dosen</label>
    <input type="text" name="nama_dosen">
    <button type="submit"> Simpan</button>
    <!-- Nama Mata Kuliah: <input type="text" name="nama_matkul"><br><br>
    Nama Dosen: <input type="text" name="nama_dosen"><br><br>
    <input type="submit" value="Simpan"> -->
    <p style="color: red;"><?php echo $error; ?></p>
</form>

</body>
</html>
