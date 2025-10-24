<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM jamaah WHERE id='$id'");
$d = mysqli_fetch_assoc($q);
?>

<div class="container mt-4">
    <h3>Edit Data Jamaah</h3>
    <form action="../../actions/data jamaah/update.php" method="POST">
        <input type="hidden" name="id" value="<?= $d['id'] ?>">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="<?= $d['nik'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $d['tanggal_lahir'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L" <?= $d['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $d['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $d['alamat'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $d['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control" value="<?= $d['phone'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>