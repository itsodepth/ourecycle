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
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <title>Admin - Kelola Status Pesanan</title>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Kelola Status Pesanan</h2>
        <a href="index.php" class="btn btn-primary mb-3">Kembali ke Halaman Utama</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis Sampah</th>
                    <th>Tanggal</th>
                    <th>Status Pemesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['jenis_sampah']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_pengambilan']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td>
                                <form action="update_status.php" method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                                    <select name="status" class="form-control form-control-sm mb-2">
                                        <option value="Diproses" <?= $row['status'] == "Diproses" ? "selected" : ""; ?>>Diproses</option>
                                        <option value="Selesai" <?= $row['status'] == "Selesai" ? "selected" : ""; ?>>Selesai</option>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-sm">Ubah Status</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>
