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

        .search-result {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
            display: none;
        }

        .search-result div {
            padding: 8px 12px;
            cursor: pointer;
        }

        .search-result div:hover {
            background-color: #f5f5f5;
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
            <h2 class="text-center mb-4">Formulir Drop Off Sampah</h2>
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
                        pattern="^\d+(\,\d+)?$" title="Masukkan angka dengan koma, misalnya 0,5">
                    <small class="form-text text-muted">*0 - 1kg = Rp10.000</small>
                </div>

                <!-- Modal untuk Peringatan -->
                <div class="modal fade" id="weightModal" tabindex="-1" aria-labelledby="weightModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="weightModalLabel">Peringatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Jika berat sampah kurang dari 5kg, maka uang akan dipotong ongkir.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
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
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <select id="kota" name="kota" class="form-select" onchange="updateCabang()">
                            <option value="">Pilih Kota</option>
                            <option value="surakarta">Surakarta</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="bandung">Bandung</option>
                            <!-- Tambahkan kota lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cabang" class="form-label">Cabang OuRecycle</label>
                        <select id="cabang" name="cabang" class="form-select" required>
                            <option value="">Pilih Cabang</option>
                            <!-- Cabang akan diisi melalui JavaScript -->
                        </select>
                    </div>
                </div>

                <!-- Tanggal Pengambilan -->
                <div class="mb-3">
                    <label for="tanggalPengantaran" class="form-label">Tanggal Pengantaran Sampah</label>
                    <input type="date" id="tanggalPengantaran" name="tanggalPengantaran" class="form-control" required>
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
        <script src="../../js/form-drop-off.js"></script>
    </body>

</html>