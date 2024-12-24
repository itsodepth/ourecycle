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
            <h2 class="text-center mb-4">Formulir Pick Up Sampah</h2>

            <form action="process_submission.php" method="post" enctype="multipart/form-data" class="mb-3">
                <!-- Jenis Sampah -->
                <div class="mb-3" id="jenisSampahContainer">
                    <label for="jenisSampah" class="form-label">Jenis Sampah</label>
                    <select id="jenisSampah" name="jenisSampah" class="form-select" onchange="showSubjenisContainer()">
                        <option value="">Pilih Jenis Sampah</option>
                        <option value="organik">Organik</option>
                        <option value="anorganik">Anorganik</option>
                        <option value="b3">B3</option>
                    </select>
                </div>

                <div class="mb-3" id="subjenisContainer" style="display: none;">
                    <label class="form-label">Subjenis Sampah</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="subjenis1" name="subjenisSampah[]"
                            value="plastik">
                        <label class="form-check-label" for="subjenis1">Plastik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="subjenis2" name="subjenisSampah[]"
                            value="kertas">
                        <label class="form-check-label" for="subjenis2">Kertas</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="subjenis3" name="subjenisSampah[]"
                            value="logam">
                        <label class="form-check-label" for="subjenis3">Logam</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="beratSampah" class="form-label">Berat Sampah (kg)</label>
                    <input type="number" id="beratSampah" name="beratSampah" class="form-control" required>
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

                <!-- Input Gambar -->
                <div class="mb-3">
                    <label for="fotoSampah" class="form-label">Foto Sampah</label>
                    <input type="file" id="fotoSampah" name="fotoSampah[]" class="form-control" accept="image/*"
                        multiple required>
                </div>

                <div class="mb-3">
                    <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                    <input type="tel" id="nomorTelepon" name="nomorTelepon" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Rumah</label>
                    <div id="map"></div>
                    <div class="position-relative">
                        <input type="text" id="alamat" name="alamat" class="form-control mb-3" required
                            placeholder="Ketik untuk mencari alamat">
                        <div id="searchResults" class="search-result"></div>
                    </div>
                    <!-- Hidden inputs to store coordinates -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <!-- Input untuk Patokan Rumah -->
                    <input type="text" id="alamat" name="alamat" class="form-control"
                        placeholder="Masukkan patokan rumah">
                </div>

                <div class="mb-3">
                    <label for="tanggalPengambilan" class="form-label">Tanggal Pengambilan Sampah</label>
                    <input type="date" id="tanggalPengambilan" name="tanggalPengambilan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jamMulai" class="form-label">Jam Mulai</label>
                    <input type="time" id="jamMulai" name="jamMulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jamAkhir" class="form-label">Jam Akhir</label>
                    <input type="time" id="jamAkhir" name="jamAkhir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan Tambahan</label>
                    <textarea id="pesan" name="pesan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-apple">Kirim</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../js/script.js"></script>
    </body>

</html>