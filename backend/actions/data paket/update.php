<?php
include '../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $durasi = $_POST['durasi_days'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $conn->prepare("UPDATE paket 
        SET kode=?, nama=?, jenis=?, durasi_days=?, harga=?, deskripsi=?, updated_at=NOW()
        WHERE id=?");
    $stmt->bind_param('sssidsi', $kode, $nama, $jenis, $durasi, $harga, $deskripsi, $id);

    if ($stmt->execute()) {
        header("Location: ../../pages/data paket/index.php?success=1");
    } else {
        header("Location: ../../pages/data paket/edit.php?id=$id&error=1");
    }
}
