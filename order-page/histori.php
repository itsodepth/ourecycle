<?php
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

// Ambil data dari database
$sql = "SELECT * FROM tb_order ORDER BY tanggal_pengambilan DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="../css/styles.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <title>Histori Pick Up Sampah</title>
    </head>

    <body>
        <div class="container mt-4">
            <h2 class="text-center mb-4">Histori Pick Up Sampah</h2>
            <!-- Tombol Back -->
            <a href="../index.php" class="btn btn-apple mb-4">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <a href="pick-up/form-pick-up.php" class="btn btn-primary mb-4">Tambah Baru</a>

            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-dark">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama']); ?></h5>
                            <p class="card-text">
                                <strong>Jenis Sampah:</strong> <?= htmlspecialchars($row['jenis_sampah']); ?><br>
                                <strong>Subjenis Sampah:</strong> <?= htmlspecialchars($row['subjenis_sampah']); ?><br>
                                <strong>Berat:</strong> <?= htmlspecialchars($row['berat_sampah']); ?> kg<br>
                                <strong>Alamat:</strong> <?= htmlspecialchars($row['alamat']); ?><br>
                                <strong>Tanggal:</strong> <?= htmlspecialchars($row['tanggal_pengambilan']); ?><br>
                                <strong>Jam:</strong>
                                <?= htmlspecialchars($row['jam_mulai'] . ' - ' . $row['jam_akhir']); ?><br>
                                <strong>Status:</strong>
                                <?php 
                                    $status = htmlspecialchars($row['status']);
                                    $statusClass = '';
                                    if ($status == 'Menunggu Konfirmasi') {
                                        $statusClass = 'bg-danger text-white'; // Merah
                                    } elseif ($status == 'Diproses') {
                                        $statusClass = 'bg-warning text-dark'; // Kuning
                                    } elseif ($status == 'Selesai') {
                                        $statusClass = 'bg-success text-white'; // Hijau
                                    }
                                ?>
                                <span class="badge <?= $statusClass; ?>"><?= $status; ?></span>
                            </p>
                            <div>
                                <strong>Foto:</strong><br>
                                <?php $fotoPaths = explode(", ", $row['foto_sampah']); ?>
                                <?php foreach ($fotoPaths as $path): ?>
                                <a href="uploads/<?= htmlspecialchars($path); ?>" target="_blank">
                                    <img src="uploads/<?= htmlspecialchars($path); ?>" alt="Foto Sampah" width="100"
                                        style="margin: 5px; border-radius: 5px;">
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                <div class="col-12 text-center">
                    <p>Tidak ada data.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </body>

</html>

<?php
$conn->close();
?>