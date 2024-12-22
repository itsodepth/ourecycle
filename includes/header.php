<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OuRecycle</title>
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
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
                            'Histori' => '#',
                            'Order' => '#',
                        ];

                        // Generate navigasi
                        foreach ($navigation as $label => $link) {
                            $activeClass = ($currentPage === 'index.php' && $link === '/') ? 'active' : '';
                            echo "<li class='nav-item'>
                                    <a class='nav-link $activeClass' href='$link'>$label</a>
                                </li>";
                        }
                        ?>
                            <li class="nav-item ms-0 mx-lg-3">
                                <!-- Login Button -->
                                <a class="btn btn-light px-3" href="/login.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>