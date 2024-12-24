<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username Anda
$password = ""; // Ganti dengan password Anda
$dbname = "db_sampah"; // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tangkap input dari form
$jenisSampah = $_POST['jenisSampah'];
$subjenisSampah = isset($_POST['subjenisSampah']) ? implode(", ", $_POST['subjenisSampah']) : '';
$fotoSampah = $_FILES['fotoSampah']['name'];
$nomorTelepon = $_POST['nomorTelepon'];
$alamat = $_POST['alamat'];
$patokan = $_POST['patokan'];
$tanggalPengambilan = $_POST['tanggalPengambilan'];
$jamMulai = $_POST['jamMulai'];
$jamAkhir = $_POST['jamAkhir'];
$pesan = $_POST['pesan'];

// Format alamat dan patokan
$alamatPatokan = $alamat . " (" . $patokan . ")";

// Format jam pengambilan
$waktuPengambilan = date('H.i', strtotime($jamMulai)) . '-' . date('H.i', strtotime($jamAkhir));

// Proses upload foto
$targetDir = "uploads/"; // Pastikan folder ini ada dan memiliki izin yang benar
$targetFile = $targetDir . basename($fotoSampah);
move_uploaded_file($_FILES['fotoSampah']['tmp_name'], $targetFile);

// Query untuk menyimpan data
$sql = "INSERT INTO order_sampah (jenis_sampah, subjenis_sampah, foto_sampah, nomor_telepon, alamat, waktu_pengambilan, pesan)
VALUES ('$jenisSampah', '$subjenisSampah', '$targetFile', '$nomorTelepon', '$alamatPatokan', '$waktuPengambilan', '$pesan')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>