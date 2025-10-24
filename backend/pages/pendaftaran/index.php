<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// 🔹 Ambil semua data pendaftaran
$q = mysqli_query($conn, "
    SELECT r.*, 
           j.nama AS nama_jamaah, 
           p.nama AS nama_paket, 
           k.departure_date, 
           k.return_date
    FROM registrations r
    JOIN jamaah j ON j.id = r.jamaah_id
    JOIN paket p ON p.id = r.paket_id
    JOIN keberangkatan k ON k.id = r.keberangkatan_id
    ORDER BY r.registration_date DESC
");
?>

<div class="main-content">
    <div class="container mt-4 pt-3">

        <!-- 🔹 Card Judul -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h4 class="fw-bold text-primary mb-0">
                    📋 Data Pendaftaran Haji / Umroh
                </h4>
                <a href="create.php" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Tambah Pendaftaran
                </a>
            </div>
        </div>

        <!-- 🔹 Card Tabel -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="17%">Nama Jamaah</th>
                                <th width="12%">Paket</th>
                                <th width="15%">Tanggal Berangkat</th>
                                <th width="15%">Tanggal Pulang</th>
                                <th width="15%">Total Harga</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if (mysqli_num_rows($q) > 0): ?>
                                <?php while ($r = mysqli_fetch_assoc($q)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($r['nama_jamaah']) ?></td>
                                        <td><?= htmlspecialchars($r['nama_paket']) ?></td>
                                        <td><?= date('d M Y', strtotime($r['departure_date'])) ?></td>
                                        <td><?= date('d M Y', strtotime($r['return_date'])) ?></td>
                                        <td>Rp <?= number_format($r['total_price'], 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge 
                                                <?= $r['status'] == 'pending' ? 'bg-warning text-dark' : ($r['status'] == 'confirmed' ? 'bg-success' : 'bg-info') ?>">
                                                <?= ucfirst($r['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit me-1"></i> Ubah Status
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        Belum ada data pendaftaran.
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

<style>
    /* 🔹 Layout utama */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 75px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* 🔹 Header tabel */
    table th {
        background-color: #1a1a1a !important;
        color: #fff !important;
        vertical-align: middle !important;
    }

    /* 🔹 Isi tabel */
    table td {
        vertical-align: middle !important;
    }

    /* 🔹 Card umum */
    .card {
        background-color: #ffffff;
        border-radius: 10px;
        transition: 0.3s;
    }

    .card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* 🔹 Tombol */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn:hover {
        opacity: 0.9;
    }

    /* 🔹 Badge status */
    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 6px;
    }
</style>

<?php include '../../partials/footer.php'; ?>