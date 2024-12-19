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
        <div id="bannerCarousel" class="carousel slide mt-5 pt-4" data-bs-ride="carousel">
            <div class="carousel-inner" style="max-height: 580px;">
                <div class="carousel-item active" style="max-height: 580px;">
                    <img src="assets/images/banner 1.jpg" class="d-block w-100" alt="Banner 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Recycling for Everyone</h5>
                        <p>#ubahjadikebaikan</p>
                    </div>
                </div>
                <div class="carousel-item" style="max-height: 580px;">
                    <img src="assets/images/banner 2.jpg" class="d-block w-100" alt="Banner 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Make Recycling Easy</h5>
                        <p>Join us in making the world cleaner.</p>
                    </div>
                </div>
                <div class="carousel-item" style="max-height: 580px;">
                    <img src="assets/images/banner 3.jpg" class="d-block w-100" alt="Banner 3">
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

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>