<?php
session_start();
require_once 'proses/koneksi.php';

// Cek jika ada pesan error atau sukses
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="css/register_admin.css">
</head>
<body>
    <div class="login-container">
        <img src="assets/images/logo.png" alt="Logo" class="logo">
        <form method="POST" action="proses/admin.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>
        <div class="footer">
            <p>Sudah punya akun? <a href="index.php" class="register-link">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
