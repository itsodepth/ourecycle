<?php
session_start(); // Memulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../index.php");
    exit;
}

// Ambil informasi pengguna dari session
$user = $_SESSION['user'];
$username = $user['username'];
$role = $user['role']; // Peran pengguna: karyawan atau pengguna
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Link Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Profil Pengguna</h1>
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($role) ?></p>

        <?php if ($role === 'karyawan'): ?>
            <p>Anda adalah karyawan di sistem ini.</p>
        <?php else: ?>
            <p>Anda adalah pengguna biasa di sistem ini.</p>
        <?php endif; ?>

        <a href="../proses/logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
