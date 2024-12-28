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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $jenisSampah = $_POST['jenisSampah'];
    $subjenisSampah = isset($_POST['subjenisSampah']) ? implode(", ", $_POST['subjenisSampah']) : null;
    $beratSampah = $_POST['beratSampah'];
    $nomorTelepon = $_POST['nomorTelepon'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $patokanRumah = $_POST['patokanRumah'];
    $tanggalPengambilan = $_POST['tanggalPengambilan'];
    $jamMulai = $_POST['jamMulai'];
    $jamAkhir = $_POST['jamAkhir'];
    $pesan = $_POST['pesan'];

    // Upload foto sampah
    $fotoPaths = [];
    if (!empty($_FILES['fotoSampah']['name'][0])) {
        $uploadDir = "../uploads/";
        foreach ($_FILES['fotoSampah']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['fotoSampah']['name'][$key]);
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $fotoPaths[] = $targetFilePath;
            }
        }
    }
    $fotoSampah = implode(", ", $fotoPaths);

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO tb_order (nama, jenis_sampah, subjenis_sampah, berat_sampah, nomor_telepon, alamat, latitude, longitude, patokan_rumah, tanggal_pengambilan, jam_mulai, jam_akhir, pesan, foto_sampah) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $nama, $jenisSampah, $subjenisSampah, $beratSampah, $nomorTelepon, $alamat, $latitude, $longitude, $patokanRumah, $tanggalPengambilan, $jamMulai, $jamAkhir, $pesan, $fotoSampah);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = '../histori.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>