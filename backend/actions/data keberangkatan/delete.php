<?php
include '../../../config/connection.php';

$id = $_GET['id'];

// Pastikan data ada
$cek = mysqli_query($conn, "SELECT id FROM keberangkatan WHERE id='$id'");
if (mysqli_num_rows($cek) === 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Hapus data
$q = mysqli_query($conn, "DELETE FROM keberangkatan WHERE id='$id'");

if ($q) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='../../pages/data berangkat/index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='../../pages/data berangkat/index.php';</script>";
}
