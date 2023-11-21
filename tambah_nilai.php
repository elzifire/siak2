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
    if (empty($_POST['nilai']) || empty($_POST['matkul_id']) || empty($_POST['user_id'])) {
        $error = "Nilai, ID Mata Kuliah, dan ID Pengguna harus diisi.";
    } else {
        $nilai = $_POST['nilai'];
        $matkul_id = $_POST['matkul_id'];
        $user_id = $_POST['user_id'];

        // Periksa apakah user_id ada dalam tabel users
        $check_query = "SELECT id FROM users WHERE id = '$user_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Lakukan query INSERT ke database
            $query = "INSERT INTO nilai (nilai, matkul_id, user_id) VALUES ('$nilai', '$matkul_id', '$user_id')";
            
            if (mysqli_query($conn, $query)) {
                header("location: lihat_nilai.php");
                exit();
            } else {
                $error = "Gagal menambahkan nilai. Silakan coba lagi.";
            }
        } else {
            $error = "User dengan ID tersebut tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Nilai</title>
</head>
<body>

<h2>Tambah Nilai</h2>

<form action="" method="post">
    Nilai: <input type="text" name="nilai"><br><br>
    Mata Kuliah:
    <select name="matkul_id">
        <?php
            $query_matkul = "SELECT id, nama_matkul FROM matkul";
            $result_matkul = mysqli_query($conn, $query_matkul);
            while ($row_matkul = mysqli_fetch_assoc($result_matkul)) {
                echo "<option value='" . $row_matkul['id'] . "'>" . $row_matkul['nama_matkul'] . "</option>";
            }
        ?>
    </select>
    <br><br>
    ID Pengguna: <input type="text" name="user_id"><br><br>
    <input type="submit" value="Simpan">
    <p style="color: red;"><?php echo $error; ?></p>
</form>

</body>
</html>
