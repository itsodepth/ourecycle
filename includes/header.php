<?php
session_start();
$is_logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OuRecycle</title>
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="css/styles.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body>
        <!-- Bootstrap Navbar -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-nav-apple py-3 fixed-top">
                <div class="container-fluid">
                    <?php
                function getBrandLink($currentPage)
                {
                    return ($currentPage === 'index.php') ? '#' : '../index.php';
                }

                // Contoh penggunaan
                $currentPage = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file aktif
                $brandLink = getBrandLink($currentPage);
                ?>
                    <a class="navbar-brand ps-2 ps-lg-5 fw-bold fs-4" href="<?php echo $brandLink; ?>">OuRecycle</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto fw-semibold">
                            <?php
                            // Dapatkan nama file aktif
                            $currentPage = basename($_SERVER['PHP_SELF']);

                            // Tentukan navigasi
                            $navigation = [
                                'Home' => ($currentPage === 'index.php') ? '#home' : '../index.php#home',
                                'Layanan' => ($currentPage === 'index.php') ? '#layanan' : '../index.php#layanan',
                                'Jenis Sampah' => ($currentPage === 'index.php') ? '#jenisSampah' : '../index.php#jenisSampah',
                                'Histori' => $is_logged_in ? 'histori.php' : 'login.php',
                                'Order' => $is_logged_in ? 'order-page/pilih.php' : 'login.php',
                            ];

                            // Generate navigasi
                            foreach ($navigation as $label => $link) {
                                $activeClass = ($currentPage === basename($link)) ? 'active' : '';
                                $onclick = ($label === 'Order' && $currentPage === 'pilih.php') ? 'event.preventDefault();' : '';
                                echo "<li class='nav-item'>
                                        <a class='nav-link $activeClass' href='$link' onclick='closeNavbar(); $onclick'>$label</a>
                                    </li>";
                            }
                            ?>
                            <li class="nav-item ms-0 mx-lg-3 dropdown">
                                <?php if ($is_logged_in): ?>
                                <a href="#" class="nav-link nav-icon dropdown-toggle no-caret" id="userDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle custom-icon"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profile/edit-profile.php">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="proses/logout.php">Logout</a></li>
                                </ul>
                                <?php else: ?>
                                <a class="btn btn-light px-3" id="show-login" onclick="closeNavbar()">Login</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Popup Overlay -->
        <div class="popup-overlay" id="popup-overlay"></div>

        <!-- Pop-up Login -->
        <div class="popup" id="popup-login">
            <div class="close-btn" id="close-popup">&times;</div>
            <div class="form">
                <img src="assets/images/logo.png" alt="Logo" id="login-logo">
                <form method="POST" action="proses/login.php">
                    <div class="form-element">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-element">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                    </div>

                    <!-- Menampilkan pesan error jika ada -->
                    <?php if (isset($_SESSION['error'])): ?>
                    <div class="form-element">
                        <p class="text-danger"><?= $_SESSION['error'] ?></p> <!-- Menampilkan pesan error -->
                    </div>
                    <?php unset($_SESSION['error']); ?>
                    <!-- Hapus pesan setelah ditampilkan -->
                    <?php endif; ?>

                    <div class="form-element">
                        <button type="submit" class="btn btn-apple px-3">Sign in</button>
                    </div>
                    <div class="form-element">
                        <a href="#">Lupa Password?</a>
                    </div>
                    <div class="form-element">
                        <p>Belum punya akun? <a href="#" id="show-register">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup Form Register -->
        <div class="popup" id="popup-register">
            <div class="close-btn" id="close-register-popup">&times;</div>
            <div class="form">
                <img src="assets/images/logo.png" alt="Logo" id="login-logo">
                <form method="post" action="proses/register.php">
                    <div class="form-element">
                        <label for="username-register">Username</label>
                        <input type="text" id="username-register" name="username-register"
                            placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-element">
                        <label for="password-register">Password</label>
                        <input type="password" id="password-register" name="password-register"
                            placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-element">
                        <label for="confirm-password-register">Confirm Password</label>
                        <input type="password" id="confirm-password-register" name="confirm-password-register"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-element">
                        <button type="submit" name="register" class="btn btn-apple px-3">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Ubah Password -->
        <div id="modal-ubah-password" class="modal">
            <div class="modal-content">
                <span class="close" id="close-ubah-password">&times;</span>
                <h2>Ubah Password</h2>
                <form method="post" action="proses/ubah_password.php">
                    <input type="password" name="password-lama" placeholder="Password Lama" required>
                    <input type="password" name="password-baru" placeholder="Password Baru" required>
                    <button type="submit">Ubah</button>
                </form>
            </div>
        </div>

        <!-- Modal Ganti Foto -->
        <div id="modal-ganti-foto" class="modal">
            <div class="modal-content">
                <span class="close" id="close-ganti-foto">&times;</span>
                <h2>Ganti Foto</h2>
                <form method="post" action="proses/ganti_foto.php" enctype="multipart/form-data">
                    <input type="file" name="foto" required>
                    <button type="submit">Ganti</button>
                </form>
            </div>
        </div>