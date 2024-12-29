<?php
require '../../profile/db.php'; // Pastikan path ke db.php benar

if (isset($_GET['jenis'])) {
    $jenis = $_GET['jenis'];

    // Ambil subjenis berdasarkan jenis
    $stmt = $pdo->prepare("SELECT id_subjenis, subjenis_sampah FROM tb_subjenis_sampah WHERE id_jenis = :id_jenis");
    $stmt->execute(['id_jenis' => $jenis]);
    $subjenis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kembalikan data dalam format JSON
    echo json_encode($subjenis);
}
?>