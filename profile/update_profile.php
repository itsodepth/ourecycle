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
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $userId = $_SESSION['user']['id_user']; // Misalkan Anda menyimpan ID pengguna di session

    // Validasi input
    if (!empty($username)) {
        // Update username di database
        $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id_user = :id_user");
        $stmt->execute(['username' => $username, 'id_user' => $userId]);

        // Simpan perubahan ke session
        $_SESSION['user']['username'] = $username;

        // Redirect kembali ke halaman profil dengan parameter 'updated'
        header("Location: info.php?updated=true");
        exit;
    } else {
        // Tangani kesalahan jika input tidak valid
        echo "Username harus diisi.";
    }
}
?>