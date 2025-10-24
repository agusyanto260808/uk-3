<?php
include '../../../config/connection.php';
$id = $_GET['id'];

// Ambil data keberangkatan berdasarkan ID
$q = mysqli_query($conn, "
  SELECT * FROM keberangkatan WHERE id = '$id'
");
$d = mysqli_fetch_assoc($q);

// Ambil daftar paket untuk dropdown
$qPaket = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");
?>

<div class="container mt-5">
    <h3>Edit Data Keberangkatan</h3>

    <?php if (!$d): ?>
        <div class="alert alert-danger">Data tidak ditemukan.</div>
    <?php else: ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $d['id'] ?>">

            <div class="mb-3">
                <label>Paket</label>
                <select name="paket_id" class="form-control" required>
                    <option value="">-- Pilih Paket --</option>
                    <?php while ($p = mysqli_fetch_assoc($qPaket)) : ?>
                        <option value="<?= $p['id'] ?>" <?= $p['id'] == $d['paket_id'] ? 'selected' : '' ?>>
                            <?= $p['nama'] ?> (<?= strtoupper($p['jenis']) ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Berangkat</label>
                <input type="date" name="departure_date" class="form-control" value="<?= $d['departure_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Pulang</label>
                <input type="date" name="return_date" class="form-control" value="<?= $d['return_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Kuota Jamaah</label>
                <input type="number" name="quota" class="form-control" value="<?= $d['quota'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Terdaftar</label>
                <input type="number" name="booked" class="form-control" value="<?= $d['booked'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="open" <?= $d['status'] == 'open' ? 'selected' : '' ?>>Open</option>
                    <option value="closed" <?= $d['status'] == 'closed' ? 'selected' : '' ?>>Closed</option>
                    <option value="canceled" <?= $d['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    <?php endif; ?>
</div>