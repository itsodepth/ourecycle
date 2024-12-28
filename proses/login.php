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
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'], // Tambahkan role ke session
            ];

            // Periksa apakah username diawali dengan 'emp_'
            if (strpos($username, 'emp_') === 0) {
                // Jika username diawali dengan 'emp_', redirect ke admin-dashboard.php
                header("Location: ../admin/admin_dashboard.php");
                exit;
            }

            // Redirect ke halaman utama untuk pengguna biasa
            $_SESSION['success'] = "Selamat datang, " . ($user['role'] === 'karyawan' ? "Karyawan" : "Pengguna") . "!";
            header("Location: ../index.php");
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