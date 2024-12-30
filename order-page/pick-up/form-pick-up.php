<?php
session_start();
$is_logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="../../css/styles.css">
        <!-- Link Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <title>Form Sampah</title>
        <style>
        * {
            font-family: "Quicksand";
        }

        #map {
            height: 300px;
            width: 100%;
            margin-bottom: 15px;
        }
        </style>
    </head>

    <body class="custom-font">
        <div class="container mt-4">
            <!-- Tombol Back -->
            <a href="javascript:history.back()" class="btn btn-apple mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <!-- Judul Form -->
            <h2 class="text-center mb-4">Formulir Pick Up Sampah</h2>
            <form action="process_submission.php" method="post" enctype="multipart/form-data" class="mb-3">
                <!-- Nama Pemesan -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pemesan</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>

                <!-- Jenis Sampah -->
                <div class="mb-3">
                    <label for="jenisSampah" class="form-label">Jenis Sampah</label>
                    <select id="jenisSampah" name="jenisSampah" class="form-select" onchange="loadSubjenis(this.value)"
                        required>
                        <option value="">Pilih Jenis Sampah</option>
                        <?php
                    // Koneksi database
                    require '../../profile/db.php'; // Pastikan path ke db.php benar
                    $stmt = $pdo->query("SELECT id_jenis, jenis_sampah FROM tb_jenis_sampah");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id_jenis']) . '">' . ucfirst(htmlspecialchars($row['jenis_sampah'])) . '</option>';
                    }
                    ?>
                    </select>
                </div>

                <!-- Subjenis Sampah -->
                <div class="mb-3" id="subjenisContainer">
                    <label class="form-label">Subjenis Sampah</label>
                    <div id="subjenisCheckboxes">
                        <!-- Checkbox akan dimuat di sini -->
                    </div>
                </div>

                <!-- Berat Sampah -->
                <div class="mb-3">
                    <label for="beratSampah" class="form-label">Berat Sampah (kg)</label>
                    <input type="text" id="beratSampah" name="beratSampah" class="form-control" required
                        pattern="^\d+(,\d+)?$" title="Masukkan angka dengan koma, misalnya 0,5">
                    <small class="form-text text-muted">*0 - 1kg = Rp10.000</small>
                </div>

                <!-- Foto Sampah -->
                <div class="mb-3">
                    <label for="fotoSampah" class="form-label">Foto Sampah</label>
                    <input type="file" id="fotoSampah" name="fotoSampah[]" class="form-control" accept="image/*"
                        multiple required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                    <input type="tel" id="nomorTelepon" name="nomorTelepon" class="form-control" required>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Rumah</label>
                    <div id="map"></div>
                    <input type="text" id="alamat" name="alamat" class="form-control mb-3" required
                        placeholder="Ketik untuk mencari alamat">
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    <!-- Patokan Rumah -->
                    <input type="text" id="patokanRumah" name="patokanRumah" class="form-control"
                        placeholder="Masukkan patokan rumah">
                </div>

                <!-- Tanggal Pengambilan -->
                <div class="mb-3">
                    <label for="tanggalPengambilan" class="form-label">Tanggal Pengambilan Sampah</label>
                    <input type="date" id="tanggalPengambilan" name="tanggalPengambilan" class="form-control" required>
                </div>

                <!-- Jam Mulai & Akhir -->
                <div class="mb-3">
                    <label for="jamMulai" class="form-label">Jam Mulai</label>
                    <input type="time" id="jamMulai" name="jamMulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jamAkhir" class="form-label">Jam Akhir</label>
                    <input type="time" id="jamAkhir" name="jamAkhir" class="form-control" required>
                </div>

                <!-- Pesan Tambahan -->
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan Tambahan</label>
                    <textarea id="pesan" name="pesan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-apple">Kirim</button>
            </form>
        </div>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../js/script.js"></script>
        <script src="../../js/login.js"></script>
    </body>

</html>