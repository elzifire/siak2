<?php
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("location: index.php");
exit;
?>
