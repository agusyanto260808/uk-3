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
    <h3>Edit Paket</h3>
    <form action="../../actions/data paket/update.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="form-group mb-2">
            <label>Kode</label>
            <input type="text" name="kode" value="<?= $data['kode'] ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Nama Paket</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Jenis</label>
            <select name="jenis" class="form-control" required>
                <option value="haji" <?= $data['jenis'] == 'haji' ? 'selected' : '' ?>>Haji</option>
                <option value="umroh" <?= $data['jenis'] == 'umroh' ? 'selected' : '' ?>>Umroh</option>
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Durasi (hari)</label>
            <input type="number" name="durasi_days" value="<?= $data['durasi_days'] ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>