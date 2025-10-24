<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$qPaket = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");
?>

<div class="container mt-5">
    <div class="card shadow-sm p-4" style="background-color: #f7f8fc;">
        <h4 class="mb-4">Tambah Keberangkatan</h4>
        <form action="../../actions/data keberangkatan/store.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Paket</label>
                <select name="paket_id" class="form-control" required>
                    <option value="">-- Pilih Paket --</option>
                    <?php while ($p = mysqli_fetch_assoc($qPaket)) : ?>
                        <option value="<?= $p['id'] ?>">
                            <?= $p['nama'] ?> (<?= strtoupper($p['jenis']) ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Berangkat</label>
                <input type="date" name="departure_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pulang</label>
                <input type="date" name="return_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kuota Jamaah</label>
                <input type="number" name="quota" class="form-control" placeholder="Masukkan jumlah kuota" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Keberangkatan</label>
                <select name="status" class="form-control">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="index.php" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>