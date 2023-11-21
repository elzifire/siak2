<?php
session_start();

// Periksa apakah pengguna telah login dan memiliki peran admin
if (!(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin')) {
    header("location: index.php");
    exit();
}

include 'koneksi.php';

// Proses pencarian
if (isset($_GET['search'])) {
    $searchKey = $_GET['search'];
    $query = "SELECT * FROM users WHERE nama LIKE '%$searchKey%' OR npm LIKE '%$searchKey%' OR role LIKE '%$searchKey%' OR status LIKE '%$searchKey%'";
} else {
    $query = "SELECT * FROM users";
}
    
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
</head>
<body>
    <a href="tambah_user.php">Tambah User</a>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari berdasarkan nama, npm, role, atau status">
        <input type="submit" value="Cari">
    </form>

    <table>
        <tr>
            <th>NAMA</th>
            <th>NPM</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["npm"]; ?></td>
                <td><?php echo $row["role"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <button onclick="hapusUser(<?php echo $row['id']; ?>)">Hapus</button>
                </td>
            </tr>
        <?php } ?>

    </table>

    <script>
        function hapusUser(id) {
            if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
                window.location = "hapus_user.php?id=" + id;
            }
        }
    </script>

</body>
</html>
