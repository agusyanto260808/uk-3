<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
?>

<div class="container mt-4">
    <h3>Tambah Paket</h3>
    <form action="../../actions/data paket/store.php" method="POST">
        <div class="form-group mb-2">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Nama Paket</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Jenis</label>
            <select name="jenis" class="form-control" required>
                <option value="haji">Haji</option>
                <option value="umroh">Umroh</option>
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Durasi (hari)</label>
            <input type="number" name="durasi_days" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Harga</label>
            <input type="number" name="harga" step="0.01" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>