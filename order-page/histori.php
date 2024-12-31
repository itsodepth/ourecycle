<?php
// Memulai session
session_start();

// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ourecycle";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Cek apakah ID pengguna ada di session
if (!isset($_SESSION['user']['id_user'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = '../index.php';</script>";
    exit;
}

// Ambil ID pengguna dari session
$id_user = $_SESSION['user']['id_user'];

// Query untuk mengambil histori order berdasarkan ID pengguna
$query = "
    SELECT h.id_histori, h.created_at, 
           p.id_pickup as pickup_id, p.id_jenis as pickup_id_jenis, p.id_subjenis as pickup_id_subjenis,
           p.berat_sampah as pickup_berat, p.nomor_telepon as pickup_telepon,
           p.alamat as pickup_alamat, p.patokan_rumah as pickup_patokan,
           p.tanggal_pengambilan as pickup_tanggal, p.jam_mulai as pickup_jam_mulai,
           p.jam_akhir as pickup_jam_akhir, p.pesan as pickup_pesan, p.status as pickup_status,
           d.id_dropoff as dropoff_id, d.id_jenis as dropoff_id_jenis, d.id_subjenis as dropoff_id_subjenis,
           d.berat_sampah as dropoff_berat, d.nomor_telepon as dropoff_telepon,
           d.kota as dropoff_kota, d.cabang as dropoff_cabang,
           d.tanggal_pengantaran as dropoff_tanggal, d.jam_mulai as dropoff_jam_mulai,
           d.jam_akhir as dropoff_jam_akhir, d.pesan as dropoff_pesan, d.status as dropoff_status
    FROM histori h
    LEFT JOIN tb_order_pickup p ON h.id_pickup = p.id_pickup
    LEFT JOIN tb_order_dropoff d ON h.id_dropoff = d.id_dropoff
    WHERE h.id_user = ?
    ORDER BY h.created_at DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Function to generate status badge
function getStatusBadge($status) {
    switch(strtolower($status)) {
        case 'pending':
            return '<span class="badge bg-warning">Pending</span>';
        case 'processed':
            return '<span class="badge bg-info">Processed</span>';
        case 'completed':
            return '<span class="badge bg-success">Completed</span>';
        case 'cancelled':
            return '<span class="badge bg-danger">Cancelled</span>';
        default:
            return '<span class="badge bg-secondary">' . htmlspecialchars($status) . '</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Histori Order</title>
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="../css/fonts.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <style>
        .btn-apple {
            background-color: #33ac41 !important;
            color: white !important;
        }

        .btn-apple:hover {
            background-color: #2f8038 !important;
        }

        .page-header {
            background: #33ac41;
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .order-card {
            transition: transform 0.2s;
            margin-bottom: 1rem;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .no-orders {
            padding: 3rem;
            text-align: center;
            background: #f8f9fa;
            border-radius: 15px;
            margin: 2rem 0;
        }
        </style>
    </head>

    <body class="bg-light">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="text-center mb-0">
                            Histori Order
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <a href="../index.php" class="btn btn-apple mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <div class="row">
                <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (isset($row['pickup_id'])) {
                        // Pickup Order Card
                        ?>
                <div class="col-12 mb-4">
                    <div class="card order-card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white d-flex align-items-center">
                            <div class="icon-circle bg-white text-primary">
                                <i class="bi bi-truck fs-4"></i>
                            </div>
                            <h5 class="mb-0">Pick Up Order #<?php echo htmlspecialchars($row['pickup_id']); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <h6 class="border-bottom pb-2">Informasi Pengambilan</h6>
                                    <p class="mb-2"><i class="bi bi-calendar3 me-2"></i><strong>Tanggal:</strong>
                                        <?php echo date('d M Y', strtotime($row['pickup_tanggal'])); ?></p>
                                    <p class="mb-2"><i class="bi bi-clock me-2"></i><strong>Waktu:</strong>
                                        <?php echo date('H:i', strtotime($row['pickup_jam_mulai'])) . ' - ' . 
                                                         date('H:i', strtotime($row['pickup_jam_akhir'])); ?></p>
                                    <p class="mb-2"><i class="bi bi-telephone me-2"></i><strong>Nomor Telepon:</strong>
                                        <?php echo htmlspecialchars($row['pickup_telepon']); ?></p>
                                    <p class="mb-2"><i class="bi bi-box me-2"></i><strong>Berat Sampah:</strong>
                                        <?php echo htmlspecialchars($row['pickup_berat']); ?> kg</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="border-bottom pb-2">Lokasi Pengambilan</h6>
                                    <p class="mb-2"><i class="bi bi-geo-alt me-2"></i><strong>Alamat:</strong>
                                        <?php echo htmlspecialchars($row['pickup_alamat']); ?></p>
                                    <p class="mb-2"><i class="bi bi-signpost-2 me-2"></i><strong>Patokan:</strong>
                                        <?php echo htmlspecialchars($row['pickup_patokan']); ?></p>
                                </div>
                                <div class="col-12">
                                    <h6 class="border-bottom pb-2">Informasi Tambahan</h6>
                                    <p class="mb-2"><i class="bi bi-chat-left-text me-2"></i><strong>Pesan:</strong>
                                        <?php echo htmlspecialchars($row['pickup_pesan']); ?></p>
                                    <p class="mb-2"><i class="bi bi-info-circle me-2"></i><strong>Status:</strong>
                                        <?php echo getStatusBadge($row['pickup_status']); ?></p>
                                    <p class="mb-2"><i class="bi bi-clock-history me-2"></i><strong>Dibuat
                                            pada:</strong>
                                        <?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    if (isset($row['dropoff_id'])) {
                        // Dropoff Order Card
                        ?>
                <div class="col-12 mb-4">
                    <div class="card order-card h-100 shadow-sm">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <div class="icon-circle bg-white text-success">
                                <i class="bi bi-box-arrow-in-down fs-4"></i>
                            </div>
                            <h5 class="mb-0">Drop Off Order #<?php echo htmlspecialchars($row['dropoff_id']); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <h6 class="border-bottom pb-2">Informasi Pengantaran</h6>
                                    <p class="mb-2"><i class="bi bi-calendar3 me-2"></i><strong>Tanggal:</strong>
                                        <?php echo date('d M Y', strtotime($row['dropoff_tanggal'])); ?></p>
                                    <p class="mb-2"><i class="bi bi-clock me-2"></i><strong>Waktu:</strong>
                                        <?php echo date('H:i', strtotime($row['dropoff_jam_mulai'])) . ' - ' . 
                                                         date('H:i', strtotime($row['dropoff_jam_akhir'])); ?></p>
                                    <p class="mb-2"><i class="bi bi-telephone me-2"></i><strong>Nomor Telepon:</strong>
                                        <?php echo htmlspecialchars($row['dropoff_telepon']); ?></p>
                                    <p class="mb-2"><i class="bi bi-box me-2"></i><strong>Berat Sampah:</strong>
                                        <?php echo htmlspecialchars($row['dropoff_berat']); ?> kg</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="border-bottom pb-2">Lokasi Pengantaran</h6>
                                    <p class="mb-2"><i class="bi bi-building me-2"></i><strong>Kota:</strong>
                                        <?php echo htmlspecialchars($row['dropoff_kota']); ?></p>
                                    <p class="mb-2"><i class="bi bi-shop me-2"></i><strong>Cabang:</strong>
                                        <?php echo htmlspecialchars($row['dropoff_cabang']); ?></p>
                                </div>
                                <div class="col-12">
                                    <h6 class="border-bottom pb-2">Informasi Tambahan</h6>
                                    <p class="mb-2"><i class="bi bi-chat-left-text me-2"></i><strong>Pesan:</strong>
                                        <?php echo htmlspecialchars($row['dropoff_pesan']); ?></p>
                                    <p class="mb-2"><i class="bi bi-info-circle me-2"></i><strong>Status:</strong>
                                        <?php echo getStatusBadge($row['dropoff_status']); ?></p>
                                    <p class="mb-2"><i class="bi bi-clock-history me-2"></i><strong>Dibuat
                                            pada:</strong>
                                        <?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
            } else {
                ?>
                <div class="col-12">
                    <div class="no-orders">
                        <i class="bi bi-inbox fs-1 d-block mb-3 text-muted"></i>
                        <h4>Tidak ada histori order ditemukan</h4>
                        <p class="text-muted">Anda belum memiliki riwayat order saat ini.</p>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>

        <!-- Bootstrap 5 JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/login.js"></script>
    </body>

</html>

<?php
$stmt->close();
$conn->close();
?>