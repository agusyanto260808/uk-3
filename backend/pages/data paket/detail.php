<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

$id = $_GET['id'];
$q = $conn->prepare("SELECT * FROM paket WHERE id = ?");
$q->bind_param("i", $id);
$q->execute();
$data = $q->get_result()->fetch_assoc();
?>

<div class="container mt-4">
    <h3>Detail Paket</h3>
    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <td><?= $data['kode'] ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= $data['nama'] ?></td>
        </tr>
        <tr>
            <th>Jenis</th>
            <td><?= ucfirst($data['jenis']) ?></td>
        </tr>
        <tr>
            <th>Durasi</th>
            <td><?= $data['durasi_days'] ?> hari</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp<?= number_format($data['harga'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td><?= nl2br($data['deskripsi']) ?></td>
        </tr>
        <tr>
            <th>Dibuat</th>
            <td><?= $data['created_at'] ?></td>
        </tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>