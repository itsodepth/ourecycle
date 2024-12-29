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
$username = isset($user['username']) ? $user['username'] : 'Pengguna'; // Menangani jika username tidak ada
$role = isset($user['role']) ? $user['role'] : 'Tidak Diketahui'; // Menangani jika role tidak ada

// Cek jika ada parameter untuk menampilkan modal
$showModal = isset($_GET['updated']) && $_GET['updated'] === 'true';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil Pengguna</title>
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="../css/fonts.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body class="bg-light">
        <div class="container py-5">
            <a href="../index.php" class="btn btn-primary mb-4">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <!-- Profile Header Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center bg-primary text-white py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-circle fa-5x"></i>
                    </div>
                    <h2 class="card-title mb-0"><?= htmlspecialchars($username) ?></h2>
                    <p class="card-text"><?= htmlspecialchars($role) ?></p>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile" type="button">
                        <i class="fas fa-user me-2"></i>Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit" type="button">
                        <i class="fas fa-edit me-2"></i>Edit Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password" type="button">
                        <i class="fas fa-lock me-2"></i>Edit Password
                    </button>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile">
                    <div class="card shadow">
                        <div class="card-body">


                            <h5 class="card-title mb-4"><i class="fas fa-user me-2"></i>Informasi Pribadi</h5>
                            <div class="mb-3">
                                <label class="text-muted">Nama Lengkap</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($username) ?></p>
                            </div>
                            <h5 class="card-title mb-4"><i class="fas fa-user me-2"></i>Informasi Lainnya</h5>
                            <div class="mb-3">
                                <label class="text-muted">Role</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($role) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Tab -->
                <div class="tab-pane fade" id="edit">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-edit me-2"></i>Edit Profil</h5>
                            <form action="update_profile.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= htmlspecialchars($username) ?>" required>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Tab -->
                <div class="tab-pane fade" id="password">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-lock me-2"></i>Ubah Password</h5>
                            <form action="update_password.php" method="POST">
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Password Saat Ini</label>
                                    <input type="password" class="form-control" id="currentPassword"
                                        name="currentPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="confirmPassword" required>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="text-center mt-4">
                <a href="../proses/logout.php" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>

        <script>
        // Tampilkan modal jika parameter 'updated' ada
        <?php if ($showModal): ?>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
        <?php endif; ?>
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/login.js"></script>
    </body>

</html>