<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil data jamaah, paket, dan jadwal keberangkatan
$qJamaah = mysqli_query($conn, "SELECT * FROM jamaah ORDER BY nama ASC");
$qPaket = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");
$qKeberangkatan = mysqli_query($conn, "SELECT * FROM keberangkatan WHERE status='open'");
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Pendaftaran Jamaah</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="../../actions/pendaftaran/store.php" method="POST">

                            <div class="mb-3">
                                <label><strong>Nama Jamaah</strong></label>
                                <select name="jamaah_id" class="form-control" required>
                                    <option value="">-- Pilih Jamaah --</option>
                                    <?php while ($j = mysqli_fetch_assoc($qJamaah)) : ?>
                                        <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['nama']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label><strong>Paket</strong></label>
                                <select name="paket_id" class="form-control" required>
                                    <option value="">-- Pilih Paket --</option>
                                    <?php while ($p = mysqli_fetch_assoc($qPaket)) : ?>
                                        <option value="<?= $p['id'] ?>">
                                            <?= htmlspecialchars($p['nama']) ?> (<?= strtoupper($p['jenis']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label><strong>Keberangkatan</strong></label>
                                <select name="keberangkatan_id" class="form-control" required>
                                    <option value="">-- Pilih Jadwal Keberangkatan --</option>
                                    <?php while ($k = mysqli_fetch_assoc($qKeberangkatan)) : ?>
                                        <option value="<?= $k['id'] ?>">
                                            <?= date('d M Y', strtotime($k['departure_date'])) ?> s.d <?= date('d M Y', strtotime($k['return_date'])) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label><strong>Total Harga</strong></label>
                                <input type="number" name="total_price" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label><strong>Catatan</strong></label>
                                <textarea name="notes" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* 🔹 Sejajar dengan sidebar & navbar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
        transition: all 0.3s ease;
    }

    /* 🔹 Jika sidebar di-collapse */
    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .card {
        background-color: #fff;
    }

    .card-header {
        padding: 15px 20px;
        font-weight: 600;
    }

    label {
        color: #333;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }
</style>

<?php include '../../partials/footer.php'; ?>