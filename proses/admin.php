<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan confirm password cocok
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan Confirm Password tidak cocok!";
        header("Location: ../tambah_admin.php"); // Kembali ke form tambah admin
        exit;
    }

    // Cek apakah username sudah ada
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan!";
        header("Location: ../tambah_admin.php"); // Kembali ke form tambah admin
        exit;
    }

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data admin baru ke database
    $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();

    // Cek apakah insert berhasil
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = "Admin baru berhasil ditambahkan!";
        header("Location: ../admin_dashboard.php"); // Kembali ke halaman tambah admin
    } else {
        $_SESSION['error'] = "Gagal menambahkan admin!";
        header("Location: ../tambah_admin.php"); // Kembali ke form tambah admin
    }
    exit;
} else {
    header("Location: ../tambah_admin.php");
    exit;
}
?>
