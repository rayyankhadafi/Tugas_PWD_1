<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'seminar';

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Cek apakah terjadi error dalam koneksi
if ($conn->connect_error) {
    die('Koneksi Gagal: ' . $conn->connect_error);
}
?>
