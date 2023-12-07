<?php

// Informasi mengenai koneksi ke database
$host = "localhost"; // Nama host database
$user = "root"; // Username database
$password = ""; // Password database
$db = "crud"; // Nama database

// Melakukan koneksi ke database MySQL
$kon = mysqli_connect($host, $user, $password, $db);

// Memeriksa apakah koneksi berhasil atau tidak
if (!$kon){
    die("Koneksi Gagal: " . mysqli_connect_error()); // Menampilkan pesan jika koneksi gagal
}
?>
