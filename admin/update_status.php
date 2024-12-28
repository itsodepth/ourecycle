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

// Ambil data dari form
$order_id = $_POST['order_id'];
$status = $_POST['status'];

// Update status di database
$sql = "UPDATE tb_order SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $order_id);

if ($stmt->execute()) {
    echo "Status berhasil diperbarui!";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect kembali ke halaman admin
header("Location: ../admin/admin_dashboard.php");
exit;
?>
