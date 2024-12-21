<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ourecycle</title>
        <!-- Link Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="css/styles.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    </head>

    <body>
        <!-- Bootstrap Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-nav-apple py-3 fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand ps-2 ps-lg-5 fw-bold fs-4" href="#">Ourecycle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto fw-semibold">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item ms-0 mx-lg-3">
                            <!-- Login Button -->
                            <a class="btn btn-light px-3" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Banner Section -->
        <div id="bannerCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/banner 1.jpg" class="d-block w-100 img-fluid" alt="Banner 1"
                        style="object-fit: cover; height: 100vh;">
                    <div class="carousel-caption text-start justify-content-center d-none d-md-block">
                        <h5 class="display-1">Recycling for Everyone</h5>
                        <p>#ubahjadikebaikan</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/banner 2.jpg" class="d-block w-100 img-fluid" alt="Banner 2"
                        style="object-fit: cover; height: 100vh;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Make Recycling Easy</h5>
                        <p>Join us in making the world cleaner.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/banner 3.jpg" class="d-block w-100 img-fluid" alt="Banner 3"
                        style="object-fit: cover; height: 100vh;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Get Rewarded</h5>
                        <p>Earn rewards while saving the planet.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Our Mission -->
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>We are The Recycling Network</h2>
                    <p>#ubahjadikebaikan</p>
                    <h4>Misi Kami Menyediakan Akses Daur Ulang Bagi Semua Orang</h4>
                    <p>Teknologi Mallsampah didesain untuk menangkap limbah dari sumber timbulnya, dengan menggunakan
                        jejaring pengepul dan pemulung lokal sebagai kunci dari rantai daur ulang di Indonesia.</p>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/test.svg" alt="Recycling" class="img-fluid rounded">
                </div>
            </div>
            <div class="row mt-4 text-center">
                <div class="col">
                    <div class="row">
                        <div class="col stat-item">
                            <h3>1jt Kg+</h3>
                            <p>Sampah di Daur Ulang</p>
                        </div>
                        <div class="col stat-item">
                            <h3>100+</h3>
                            <p>Gudang Sortir</p>
                        </div>
                        <div class="col stat-item">
                            <h3>500+</h3>
                            <p>Kolektor Lokal</p>
                        </div>
                        <div class="col stat-item">
                            <h3>30rb+</h3>
                            <p>Pengguna</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary mt-3">Semua Tentang Kami di sini</a>
                </div>
            </div>
        </div>

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>