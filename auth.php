<?php
session_start();

// Data dummy pengguna (simulasikan seperti database)
$dummy_users = [
    'guru' => 'password123',
    'siswa' => 'siswa123',
    'admin' => 'admin'
];

// Terima data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi
if(isset($dummy_users[$username]) && $dummy_users[$username] === $password) {
    // Login sukses
    $_SESSION['user'] = $username;
    header("Location: welcome.php");
} else {
    // Login gagal
    header("Location: login.php?error=1");
}
exit;