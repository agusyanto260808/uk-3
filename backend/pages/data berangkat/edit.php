<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'];

// Ambil data keberangkatan berdasarkan ID
$q = mysqli_query($conn, "SELECT * FROM keberangkatan WHERE id = '$id'");
$d = mysqli_fetch_assoc($q);

// Ambil daftar paket untuk dropdown
$qPaket = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Data Keberangkatan</h5>
                    </div>

                    <div class="card-body p-4" style="background-color: #f9fafc;">
                        <?php if (!$d): ?>
                            <div class="alert alert-danger">Data keberangkatan tidak ditemukan.</div>
                        <?php else: ?>
                            <form action="../../actions/data keberangkatan/update.php" method="POST">
                                <input type="hidden" name="id" value="<?= $d['id'] ?>">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Paket</label>
                                    <select name="paket_id" class="form-control" required>
                                        <option value="">-- Pilih Paket --</option>
                                        <?php while ($p = mysqli_fetch_assoc($qPaket)) : ?>
                                            <option value="<?= $p['id'] ?>" <?= $p['id'] == $d['paket_id'] ? 'selected' : '' ?>>
                                                <?= $p['nama'] ?> (<?= strtoupper($p['jenis']) ?>)
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">Tanggal Berangkat</label>
                                        <input type="date" name="departure_date" class="form-control"
                                            value="<?= htmlspecialchars($d['departure_date']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">Tanggal Pulang</label>
                                        <input type="date" name="return_date" class="form-control"
                                            value="<?= htmlspecialchars($d['return_date']) ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">Kuota Jamaah</label>
                                        <input type="number" name="quota" class="form-control"
                                            value="<?= htmlspecialchars($d['quota']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">Terdaftar</label>
                                        <input type="number" name="booked" class="form-control"
                                            value="<?= htmlspecialchars($d['booked']) ?>" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Status Keberangkatan</label>
                                    <select name="status" class="form-control">
                                        <option value="open" <?= $d['status'] == 'open' ? 'selected' : '' ?>>Open</option>
                                        <option value="closed" <?= $d['status'] == 'closed' ? 'selected' : '' ?>>Closed</option>
                                        <option value="canceled" <?= $d['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                    </select>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fa fa-save me-1"></i> Update
                                    </button>
                                    <a href="index.php" class="btn btn-secondary px-4">
                                        <i class="fa fa-times me-1"></i> Batal
                                    </a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .card-header {
        padding: 15px 20px;
        font-weight: 600;
    }

    .card-body label {
        color: #555;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }
</style>

<?php include '../../partials/footer.php'; ?>