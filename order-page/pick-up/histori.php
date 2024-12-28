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
        <title>Histori Pick Up Sampah</title>
    </head>

    <body>

        <div class="container mt-4">
            <h2 class="text-center mb-4">Histori Pick Up Sampah</h2>
            <a href="form_sampah.html" class="btn btn-primary mb-3">Tambah Baru</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Sampah</th>
                        <th>Subjenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Foto</th>
                        <th>Status Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1;
                    while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_sampah']); ?></td>
                        <td><?= htmlspecialchars($row['subjenis_sampah']); ?></td>
                        <td><?= htmlspecialchars($row['berat_sampah']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_pengambilan']); ?></td>
                        <td><?= htmlspecialchars($row['jam_mulai'] . ' - ' . $row['jam_akhir']); ?></td>
                        <td>
                            <?php $fotoPaths = explode(", ", $row['foto_sampah']); ?>
                            <?php foreach ($fotoPaths as $path): ?>
                            <a href="<?= htmlspecialchars($path); ?>" target="_blank">
                                <img src="<?= htmlspecialchars($path); ?>" alt="Foto Sampah" width="100"
                                    style="margin: 5px;">
                            </a>
                            <?php endforeach; ?>

                        </td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data.</td>
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