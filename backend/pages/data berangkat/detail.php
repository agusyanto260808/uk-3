<?php
include '../../../config/connection.php';
$id = $_GET['id'];
$q = mysqli_query($conn, "
  SELECT k.*, p.nama AS nama_paket, p.jenis, p.harga
  FROM keberangkatan k
  JOIN paket p ON k.paket_id = p.id
  WHERE k.id = '$id'
");
$d = mysqli_fetch_assoc($q);
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-3">Detail Keberangkatan</h3>
        <p><strong>Paket:</strong> <?= htmlspecialchars($d['nama_paket']) ?> (<?= strtoupper($d['jenis']) ?>)</p>
        <p><strong>Harga Paket:</strong> Rp <?= number_format($d['harga'], 0, ',', '.') ?></p>
        <p><strong>Tanggal Berangkat:</strong> <?= $d['departure_date'] ?></p>
        <p><strong>Tanggal Pulang:</strong> <?= $d['return_date'] ?></p>
        <p><strong>Kuota:</strong> <?= $d['quota'] ?></p>
        <p><strong>Telah Terdaftar:</strong> <?= $d['booked'] ?></p>
        <p><strong>Status:</strong> <?= ucfirst($d['status']) ?></p>
        <p><strong>Dibuat:</strong> <?= $d['created_at'] ?></p>
        <p><strong>Diperbarui:</strong> <?= $d['updated_at'] ?></p>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>