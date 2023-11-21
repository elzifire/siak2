<?php

// file ini menghandle koneksi ke databases
$servername = "localhost:3307";
$username = "root"; // ganti dengan username Anda
$password = ""; // ganti dengan password Anda
$dbname = "siak";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}