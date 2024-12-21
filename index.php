<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ourecycle</title>
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
                            <a class="nav-link" href="#layanan">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Histori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Order</a>
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
                    <img src="assets/images/banner1.jpg" class="d-block w-100 img-fluid" alt="Banner 1"
                        id="carouselImg">
                    <div class="overlay"></div>
                    <div class="carousel-caption text-start mb-4 pb-3 mb-sm-5 pb-sm-5 d-inline-block d-md-block"
                        style="z-index: 3;">
                        <h5 class="display-3 caption-heading">Recycling for Everyone</h5>
                        <p class="display-6 caption-text">#ubahjadikebaikan</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/banner2.jpg" class="d-block w-100 img-fluid" alt="Banner 2"
                        id="carouselImg">
                    <div class="overlay"></div>
                    <div class="carousel-caption text-start mb-4 pb-3 mb-sm-5 pb-sm-5 d-inline-block d-md-block"
                        style="z-index: 3;">
                        <h5 class="display-3 caption-heading">Make Recycling Easy</h5>
                        <p class="display-6 caption-text">Join us in making the world cleaner.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/banner3.jpg" class="d-block w-100 img-fluid" alt="Banner 3"
                        id="carouselImg">
                    <div class="overlay"></div>
                    <div class="carousel-caption text-start mb-4 pb-3 mb-sm-5 pb-sm-5 d-inline-block d-md-block"
                        style="z-index: 3;">
                        <h5 class="display-3 caption-heading">Get Rewarded</h5>
                        <p class="display-6 caption-text">Earn rewards while saving the planet.</p>
                    </div>
                </div>
            </div>

            <!-- Indikator Carousel -->
            <ol class="carousel-indicators mb-3 mb-sm-5">
                <li data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#bannerCarousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#bannerCarousel" data-bs-slide-to="2"></li>
            </ol>

            <button class="carousel-control-prev d-none" type="button" data-bs-target="#bannerCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none" type="button" data-bs-target="#bannerCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Our Mission -->
        <div class="container mt-3 mt-sm-5 mb-3 mb-sm-5">
            <div class="row align-items-center mb-3 mb-sm-5">
                <div class="col-md-6 mb-3 mb-sm-0">
                    <img src="assets/images/info.png" alt="Recycling" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2 class="fw-bold">Bersama Ourecycle, sampah dirumah kamu bisa jadi uang dalam sekejap😎</h2>
                    <p class="text-justify">Teknologi Ourecycle dirancang untuk mengelola sampah langsung dari
                        sumbernya, dengan melibatkan
                        jejaring pengepul dan pemulung lokal sebagai penggerak utama dalam rantai daur ulang di
                        Indonesia, sekaligus memberikan peluang untuk mengubah sampah menjadi penghasilan tambahan.</p>
                    <a href="#" class="btn" style="background-color: #33ac41; color: white; border: none;">Order Layanan
                        Ourecycle!</a>
                </div>
            </div>
            <div class="row mt-3 mx-0 mx-sm-3 text-center text-white text-break stat-background">
                <div class="col">
                    <div class="row d-flex flex-column flex-sm-row">
                        <div class="col stat-item mb-3 mb-sm-0">
                            <h3 class="count" data-count="2319">0</h3>
                            <p>Sampah di Daur Ulang</p>
                        </div>
                        <hr class="d-sm-none">
                        <div class="col stat-item mb-3 mb-sm-0">
                            <h3 class="count" data-count="10">0</h3>
                            <p>Gudang Sortir</p>
                        </div>
                        <hr class="d-sm-none">
                        <div class="col stat-item mb-3 mb-sm-0">
                            <h3 class="count" data-count="109">0</h3>
                            <p>Kolektor Lokal</p>
                        </div>
                        <hr class="d-sm-none">
                        <div class="col stat-item mb-3 mb-sm-0">
                            <h3 class="count" data-count="25401">0</h3>
                            <p>Pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Services -->
        <div class="container mt-5" id="layanan">
            <h2 class="text-center">Layanan</h2>
            <p class="text-center">Revolusi daur ulang dari Ourecycle untuk semua orang.</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-2 mb-sm-0">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-box"></i> Pick Up</h5>
                            <p class="card-text">Sampah milik pengguna akan diambil oleh OurTeam (karyawan Ourecycle).
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2 mb-sm-0">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bus"></i> Drop Off</h5>
                            <p class="card-text">User langsung mengantarkan sampah ke Recycling Centre Ourecycle
                                terdekat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2 mb-sm-0">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Cash</h5>
                            <p class="card-text">Dapatkan imbalan tunai untuk sampah yang didaur ulang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jenis Sampah -->
        <div class="container mt-5">
            <h2 class="text-center">Jenis Sampah</h2>
            <p class="text-center">Lihat semua jenis sampah yang kami daur ulang.</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <a href="kertas.html" class="card text-center text-decoration-none text-reset">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-3x text-warning"></i>
                            <h5 class="card-title mt-3">Kertas</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="plastik.html" class="card text-center text-decoration-none text-reset">
                        <div class="card-body">
                            <i class="fas fa-recycle fa-3x text-success"></i>
                            <h5 class="card-title mt-3">Plastik</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="elektronik.html" class="card text-center text-decoration-none text-reset">
                        <div class="card-body">
                            <i class="fas fa-plug fa-3x text-info"></i>
                            <h5 class="card-title mt-3">Elektronik</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="botol-kaca.html" class="card text-center text-decoration-none text-reset">
                        <div class="card-body">
                            <i class="fas fa-glass-whiskey fa-3x text-danger"></i>
                            <h5 class="card-title mt-3">Botol Kaca</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="besi-logam.html" class="card text-center text-decoration-none text-reset">
                        <div class="card-body">
                            <i class="fas fa-tools fa-3x text-danger"></i>
                            <h5 class="card-title mt-3">Besi & Logam</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="khusus.html" class="card text-center text-decoration-none">
                        <div class="card-body">
                            <i class="fas fa-leaf fa-3x text-brown"></i>
                            <h5 class="card-title mt-3">Khusus</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-nav-apple text-white mt-5">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Contact Me</h3>
                        <p>Email: <a href="mailto:info@ourecycle.com" class="text-white">info@ourecycle.com</a></p>
                        <p>Phone: <a href="tel:+628976343725" class="text-white">+62 897-6343-725</a></p>
                    </div>
                    <div class="col-md-6">
                        <h3>Follow Us</h3>
                        <ul class="list-unstyled d-flex">
                            <li class="me-3">
                                <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="text-white"><i class="fab fa-linkedin fa-2x"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="bg-white">
                <div class="text-center">
                    <p>© 2023 Ourecycle. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
    </body>

</html>