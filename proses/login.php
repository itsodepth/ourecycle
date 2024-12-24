<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query ke database untuk cek apakah username ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Jika user ditemukan, cek password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan informasi user di session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
            ];
            header("Location: ../index.php"); // Redirect ke halaman utama setelah login
            exit;
        } else {
            // Password salah, simpan pesan error dalam session
            $_SESSION['error'] = "Password yang Anda masukkan salah!";
            header("Location: ../index.php"); // Tetap di halaman index dengan popup login
            exit;
        }
    } else {
        // Username tidak ditemukan, simpan pesan error dalam session
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: ../index.php"); // Tetap di halaman index dengan popup login
        exit;
    }
} else {
    // Jika bukan metode POST, redirect ke halaman index
    header("Location: ../index.php");
    exit;
}
?>
