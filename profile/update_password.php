<?php
session_start(); // Memulai session
require 'db.php'; // Menghubungkan ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = isset($_POST['currentPassword']) ? trim($_POST['currentPassword']) : '';
    $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $userId = $_SESSION['user']['id_user']; // Misalkan Anda menyimpan ID pengguna di session

    // Validasi input
    if (!empty($currentPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        // Verifikasi password saat ini (misalnya, dengan membandingkan dengan password yang disimpan di database)
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $userId]);
        $storedPassword = $stmt->fetchColumn();

        // Cek apakah password saat ini benar
        if (password_verify($currentPassword, $storedPassword)) {
            // Cek apakah password baru dan konfirmasi password sama
            if ($newPassword === $confirmPassword) {
                // Hash password baru sebelum menyimpannya
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id_user = :id_user");
                $stmt->execute(['password' => $hashedPassword, 'id_user' => $userId]);

                // Redirect kembali ke halaman profil dengan parameter 'updated'
                header("Location: info.php?updated=true");
                exit;
            } else {
                echo "Password baru dan konfirmasi password tidak cocok.";
            }
        } else {
            echo "Password saat ini salah.";
        }
    } else {
        echo "Semua field harus diisi.";
    }
}
?>