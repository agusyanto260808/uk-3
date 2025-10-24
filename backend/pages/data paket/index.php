<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

$q = mysqli_query($conn, "SELECT * FROM paket ORDER BY created_at DESC");
?>

<div class="main-content">
    <div class="container py-4">
        <!-- Wrapper Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <!-- Card Header -->
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa fa-box me-2"></i> Data Paket
                </h5>
                <a href="create.php" class="btn btn-primary btn-sm px-3 fw-semibold shadow-sm">
                    <i class="fa fa-plus me-2"></i> Tambah Paket
                </a>
            </div>
        </div>

        <!-- Card Body (Table) -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table cslass="table align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Kode</th>
                                <th width="20%">Nama Paket</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">Durasi</th>
                                <th width="15%">Harga</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($q) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($q)): ?>
                                    <tr>
                                        <td colspan="7" class="p-3">
                                            <div class="card shadow-sm border-0 paket-card">
                                                <div class="card-body py-3 px-4">
                                                    <div class="row align-items-center text-center">
                                                        <div class="col-md-1 fw-bold text-muted">
                                                            <?= $no++ ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <span class="fw-semibold"><?= htmlspecialchars($row['kode']) ?></span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <span class="text-dark fw-semibold"><?= htmlspecialchars($row['nama']) ?></span>
                                                        </div>
                                                        <div class="col-md-1 text-capitalize">
                                                            <?= htmlspecialchars($row['jenis']) ?>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <?= htmlspecialchars($row['durasi_days']) ?> Hari
                                                        </div>
                                                        <div class="col-md-2 fw-bold text-success">
                                                            Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                                <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-eye me-1"></i> Detail
                                                                </a>
                                                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm text-white">
                                                                    <i class="fa fa-edit me-1"></i> Edit
                                                                </a>
                                                                <a href="../../actions/data paket/destroy.php?id=<?= $row['id'] ?>"
                                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                                    class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash me-1"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fa fa-info-circle me-2"></i>Belum ada data paket
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Style -->
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

    .card-header h5 {
        font-size: 1.1rem;
        letter-spacing: 0.3px;
    }

    .card-header {
        border-bottom: 3px solid #0d6efd;
    }

    .table thead th {
        background-color: #1a1a1a !important;
        color: #fff !important;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .paket-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        transition: all 0.2s ease-in-out;
    }

    .paket-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background-color: #f9fafb;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.05);
        opacity: 0.95;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .card {
        background: #ffffff;
    }
</style>

<?php include '../../partials/footer.php'; ?>