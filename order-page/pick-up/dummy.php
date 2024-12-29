<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
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
            <a href="javascript:history.back()" class="btn btn-apple mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <h2 class="text-center mb-4">Formulir Pick Up Sampah</h2>
            <form action="process_submission.php" method="post" enctype="multipart/form-data" class="mb-3">

                <!-- Nama Pemesan -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pemesan</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>

                <!-- Jenis Sampah -->
                <div class="mb-3" id="jenisSampahContainer">
                    <label for="jenisSampah" class="form-label">Jenis Sampah</label>
                    <select id="jenisSampah" name="jenisSampah" class="form-select" onchange="loadSubjenis(this.value)"
                        required>
                        <option value="">Pilih Jenis Sampah</option>
                        <?php
                    $conn = new mysqli("localhost", "root", "", "ourecycle");
                    if ($conn->connect_error) {
                        die("Koneksi ke database gagal: " . $conn->connect_error);
                    }

                    $query = "SELECT id_jenis, jenis_sampah FROM tb_jenis_sampah";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id_jenis']}'>{$row['jenis_sampah']}</option>";
                        }
                    } else {
                        echo "<option value=''>Jenis sampah tidak tersedia</option>";
                    }

                    $conn->close();
                    ?>
                    </select>
                </div>

                <!-- Berat Sampah -->
                <div class="mb-3">
                    <label for="beratSampah" class="form-label">Berat Sampah (kg)</label>
                    <input type="text" id="beratSampah" name="beratSampah" class="form-control" required
                        pattern="^\d+(\,\d+)?$" title="Masukkan angka dengan koma, misalnya 0,5">
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
                    <div class="position-relative">
                        <input type="text" id="alamat" name="alamat" class="form-control mb-3" required
                            placeholder="Ketik untuk mencari alamat">
                        <div id="searchResults" class="search-result"></div>
                    </div>
                    <!-- Hidden inputs to store coordinates -->
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

                <!-- Jam Mulai -->
                <div class="mb-3">
                    <label for="jamMulai" class="form-label">Jam Mulai</label>
                    <input type="time" id="jamMulai" name="jamMulai" class="form-control" required>
                </div>

                <!-- Jam Akhir -->
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
        <script>
        function loadSubjenis(jenisId) {
            if (!jenisId) {
                document.getElementById('subjenisContainer').style.display = 'none';
                document.getElementById('subjenisOptions').innerHTML = '';
                return;
            }

            fetch(`get_subjenis.php?id_jenis=${idJenis}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let options = data.map(subjenis => `
                            <div class="form-check">
                                <input type="checkbox" id="subjenis-${subjenis.id}" name="subjenisSampah[]" value="${subjenis.nama_subjenis}" class="form-check-input">
                                <label for="subjenis-${subjenis.id}" class="form-check-label">${subjenis.nama_subjenis}</label>
                            </div>
                        `).join('');
                        document.getElementById('subjenisOptions').innerHTML = options;
                        document.getElementById('subjenisContainer').style.display = 'block';
                    } else {
                        document.getElementById('subjenisContainer').style.display = 'none';
                        document.getElementById('subjenisOptions').innerHTML = '';
                    }
                })
                .catch(error => console.error('Error fetching subjenis:', error));
        }
        </script>
    </body>

</html>