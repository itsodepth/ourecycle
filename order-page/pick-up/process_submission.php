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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir dan validasi
    $nama = htmlspecialchars(trim($_POST['nama']));
    $jenisSampah = htmlspecialchars(trim($_POST['jenisSampah']));
    $subjenisSampah = isset($_POST['subjenisSampah']) ? $_POST['subjenisSampah'] : [];
    $beratSampah = filter_var($_POST['beratSampah'], FILTER_VALIDATE_FLOAT);
    $nomorTelepon = htmlspecialchars(trim($_POST['nomorTelepon']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $patokanRumah = htmlspecialchars(trim($_POST['patokanRumah']));
    $latitude = filter_var($_POST['latitude'], FILTER_VALIDATE_FLOAT);
    $longitude = filter_var($_POST['longitude'], FILTER_VALIDATE_FLOAT);
    $tanggalPengambilan = htmlspecialchars(trim($_POST['tanggalPengambilan']));
    $jamMulai = htmlspecialchars(trim($_POST['jamMulai']));
    $jamAkhir = htmlspecialchars(trim($_POST['jamAkhir']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));

    // Validasi input wajib
    if (empty($nama) || empty($jenisSampah) || empty($beratSampah) || empty($nomorTelepon) || empty($alamat) || empty($tanggalPengambilan) || empty($jamMulai) || empty($jamAkhir)) {
        echo "<script>alert('Harap lengkapi semua data yang diperlukan!'); window.history.back();</script>";
        exit;
    }

    // Cek apakah ID pengguna ada di session
    if (!isset($_SESSION['user']['id_user'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = '../login.php';</script>";
        exit;
    }

    // Upload foto sampah
    $fotoPaths = [];
    if (!empty($_FILES['fotoSampah']['name'][0])) {
        $uploadDir = "../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['fotoSampah']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['fotoSampah']['name'][$key]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $targetFilePath = $uploadDir . uniqid() . '.' . $fileType;

            // Validasi tipe file
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($fileType), $allowedTypes)) {
                echo "<script>alert('Hanya file gambar yang diizinkan (jpg, jpeg, png, gif).'); window.history.back();</script>";
                exit;
            }

            // Pindahkan file
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $fotoPaths[] = $targetFilePath;
            }
        }
    }
    $fotoSampah = implode(", ", $fotoPaths);

    // Menggunakan id_subjenis pertama jika ada beberapa subjenis
    $id_subjenis = !empty($subjenisSampah) ? $subjenisSampah[0] : null; // Ambil subjenis pertama

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO tb_order_pickup (id_user, nama, id_jenis, id_subjenis, berat_sampah, nomor_telepon, foto_sampah, foto_type, alamat, patokan_rumah, latitude, longitude, tanggal_pengambilan, jam_mulai, jam_akhir, pesan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Menggunakan foto_type untuk menyimpan tipe foto
    $fotoType = !empty($fotoPaths) ? pathinfo($fotoPaths[0], PATHINFO_EXTENSION) : null;

    $stmt->bind_param("issdssssssssssss", $_SESSION['user']['id_user'], $nama, $jenisSampah, $id_subjenis, $beratSampah, $nomorTelepon, $fotoSampah, $fotoType, $alamat, $patokanRumah, $latitude, $longitude, $tanggalPengambilan, $jamMulai, $jamAkhir, $pesan);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = '../histori.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>