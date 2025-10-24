<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

// Ambil semua data jamaah
$q = mysqli_query($conn, "SELECT * FROM jamaah ORDER BY created_at DESC");
?>

<div class="main-content">
    <div class="container py-4">

        <!-- Wrapper Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <!-- Card Header -->
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa fa-users me-2"></i> Data Jamaah
                </h5>
                <a href="create.php" class="btn btn-primary btn-sm px-3 fw-semibold shadow-sm">
                    <i class="fa fa-plus me-2"></i> Tambah Jamaah
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">NO</th>
                                <th width="20%">NAMA</th>
                                <th width="15%">NIK</th>
                                <th width="15%">TELEPON</th>
                                <th width="15%">ALAMAT</th>
                                <th width="30%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($q) > 0):
                                while ($d = mysqli_fetch_assoc($q)):
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($d['nama']) ?></td>
                                        <td><?= htmlspecialchars($d['nik']) ?></td>
                                        <td><?= htmlspecialchars($d['phone']) ?></td>
                                        <td><?= htmlspecialchars($d['alamat']) ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                <a href="detail.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye me-1"></i> Detail
                                                </a>
                                                <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm text-white">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>
                                                <a href="../../actions/data jamaah/delete.php?id=<?= $d['id'] ?>"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash me-1"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fa fa-info-circle me-2"></i> Belum ada data jamaah
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- CSS -->
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

        table th {
            background-color: #1a1a1a !important;
            color: white !important;
            vertical-align: middle !important;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        table td {
            vertical-align: middle !important;
        }

        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
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

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .card {
            background: #ffffff;
        }
    </style>

    <?php include '../../partials/footer.php'; ?>