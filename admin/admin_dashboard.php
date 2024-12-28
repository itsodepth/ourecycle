<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ourecycle";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM tb_order ORDER BY tanggal_pengambilan DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>
<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>
        <ul class="menu">
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#orders">Konfirmasi Order</a></li>
            <li><a href="#history">Riwayat Order</a></li>
            <li><a href="#reports">Laporan</a></li>
            <li><a href="tambah_admin.php">Tambah Admin</a></li> <!-- Menu untuk menambah admin -->
            <li><a href="proses/admin_logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Content -->
        <div id="dashboard" class="content-section">
            <h1>Dashboard</h1>
            <p>Selamat datang di panel admin. Gunakan menu di sisi kiri untuk navigasi.</p>
        </div>

        <!-- Konfirmasi Order -->
        <div id="orders" class="content-section">
            <h1>Konfirmasi Order (Pick Up)</h1>

            <?php
            session_start();
            if (isset($_SESSION['message'])) {
                echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            ?>

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

        <!-- Riwayat Order -->
        <div id="history" class="content-section">
            <h1>Riwayat Order</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (Kg)</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal Konfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data riwayat order di sini -->
                    <!-- Contoh data -->
                    <tr>
                        <td>1</td>
                        <td>Alif</td>
                        <td>Plastik</td>
                        <td>5</td>
                        <td>Rp50,000</td>
                        <td>Dikonfirmasi</td>
                        <td>24 Desember 2024</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Laporan -->
        <div id="reports" class="content-section">
            <h1>Laporan</h1>
            <p>Menampilkan laporan penjualan atau transaksi sampah.</p>
        </div>

    </div>

    <!-- CSS untuk alert pesan -->
    <style type="text/css">
        .alert {
            padding: 10px;
            background-color: #f44336; /* Merah */
            color: white;
            margin-bottom: 15px;
        }
    </style>

</div>

<script src="../js/admin-script.js"></script> <!-- Jika ada script tambahan -->
</body>
</html>

