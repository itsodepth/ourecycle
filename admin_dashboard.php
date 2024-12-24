<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin-style.css">
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
            <h1>Konfirmasi Order</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (Kg)</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Alif</td>
                        <td>Plastik</td>
                        <td>5</td>
                        <td>Rp50,000</td>
                        <td>Menunggu Konfirmasi</td>
                        <td>
                            <button class="btn-confirm">Konfirmasi</button>
                            <button class="btn-cancel">Tolak</button>
                        </td>
                    </tr>
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
</div>
