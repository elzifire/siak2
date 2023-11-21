<?php 
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nama'])) {
        $errors[] = "Nama tidak boleh kosong";
    } else {
        $nama = $_POST['nama'];
    }

    if (empty($_POST['npm'])) {
        $errors[] = "NPM tidak boleh kosong";
    } else {
        $npm = $_POST['npm'];
    }

    if (empty($_POST['password'])) {
        $errors[] = "Password tidak boleh kosong";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['role'])) {
        $errors[] = "Role tidak boleh kosong";
    } else {
        $role = $_POST['role'];
    }

    if (empty($_POST['status'])) {
        $errors[] = "Status tidak boleh kosong";
    } else {
        $status = $_POST['status'];
    }

    // Jika tidak ada kesalahan, tambahkan user
    if (empty($errors)) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $npm = mysqli_real_escape_string($conn, $npm);
        $password = mysqli_real_escape_string($conn, $password);
        $role = mysqli_real_escape_string($conn, $role);
        $status = mysqli_real_escape_string($conn, $status);

        $query = "INSERT INTO users (nama, npm, password, role, status) VALUES ('$nama', '$npm', '$password', '$role', '$status')";
        
        if (mysqli_query($conn, $query)) {
            header("location: user.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
    <h2>Tambah User</h2>

    <?php if (!empty($errors)) { ?>
        <div>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="npm">NPM:</label><br>
        <input type="text" id="npm" name="npm"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="role">Role:</label><br>
        <!-- <input type="text" id="role" name="role"><br> -->
        <select name="role" id="">
        <option value="mahasiswa">mahasiswa</option>

        <option value="admin">admin</option>
        </select><br>
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
