<?php
include '../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $durasi = $_POST['durasi_days'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $conn->prepare("INSERT INTO paket (kode, nama, jenis, durasi_days, harga, deskripsi, created_at)
                            VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('sssids', $kode, $nama, $jenis, $durasi, $harga, $deskripsi);

    if ($stmt->execute()) {
        header("Location: ../../pages/data paket/index.php?success=1");
    } else {
        header("Location: ../../pages/data paket/create.php?error=1");
    }
}
