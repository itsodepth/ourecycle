<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk cek di tabel users
    $stmt_user = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $user = $result_user->fetch_assoc();

    // Query untuk cek di tabel admin
    $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    $admin = $result_admin->fetch_assoc();

    if ($user) {
        // Jika user ditemukan di tabel users
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan informasi user di session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => 'user',
            ];
            header("Location: ../index.php"); // Redirect ke halaman utama user
            exit;
        } else {
            $_SESSION['error'] = "Password yang Anda masukkan salah!";
            header("Location: ../index.php"); // Tetap di halaman index dengan popup login
            exit;
        }
    } elseif ($admin) {
        // Jika admin ditemukan di tabel admin
        if (password_verify($password, $admin['password'])) {
            // Login berhasil, simpan informasi admin di session
            $_SESSION['user'] = [
                'id' => $admin['id'],
                'username' => $admin['username'],
                'role' => 'admin',
            ];
            header("Location: ../admin_dashboard.php"); // Redirect ke halaman dashboard admin
            exit;
        } else {
            $_SESSION['error'] = "Password yang Anda masukkan salah!";
            header("Location: ../index.php"); // Tetap di halaman index dengan popup login
            exit;
        }
    } else {
        // Username tidak ditemukan
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
