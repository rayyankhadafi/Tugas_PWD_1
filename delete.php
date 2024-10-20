<?php
session_start();
include 'koneksi.php';

// Mengecek apakah user sudah login
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Mendapatkan ID dari parameter URL
$id = $_GET['id'];

// Menggunakan prepared statement untuk update is_deleted
$sql = "UPDATE registration SET is_deleted = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);  // 'i' untuk tipe data integer

if ($stmt->execute()) {
    header('Location: admin.php');
    exit;
} else {
    echo 'Error: ' . $conn->error;
}

$stmt->close();
$conn->close();
?>
