<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Hitung total data
$totalJamaah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM jamaah"))['total'];
$totalPendaftaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations"))['total'];
$totalPembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments"))['total'];
$totalPaket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM paket"))['total'];
$totalKeberangkatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM keberangkatan"))['total'];

// Hitung statistik tambahan
$pembayaranSukses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments WHERE status = 'success'"))['total'];
$pembayaranPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments WHERE status = 'pending'"))['total'];

// Ambil 5 aktivitas log terbaru hanya untuk admin
if ($_SESSION['role_name'] === 'admin') {
    $qLogs = mysqli_query($conn, "
        SELECT a.*, u.full_name 
        FROM audit_logs a
        LEFT JOIN users u ON u.id = a.user_id
        ORDER BY a.created_at DESC
        LIMIT 5
    ");
}
?>

<!-- Main Content -->
<main class="main-content">
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 pt-3">
            <div>
                <h2 class="mb-1">Dashboard <?= ucfirst($_SESSION['role_name']) ?></h2>
                <p class="text-muted mb-0">Selamat datang, <?= $_SESSION['full_name'] ?>!</p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary"><?= date('l, d F Y') ?></span>
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-primary text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Jamaah</h5>
                                <h2 class="mb-0"><?= $totalJamaah ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75"><i class="fas fa-arrow-up text-success me-1"></i> Data terupdate</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-success text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Pendaftaran</h5>
                                <h2 class="mb-0"><?= $totalPendaftaran ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-file-signature fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75">Total pendaftar</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-info text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Pembayaran</h5>
                                <h2 class="mb-0"><?= $totalPembayaran ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-credit-card fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75">Total transaksi</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-warning text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Paket Umrah</h5>
                                <h2 class="mb-0"><?= $totalPaket ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-box fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75">Paket tersedia</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-danger text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Keberangkatan</h5>
                                <h2 class="mb-0"><?= $totalKeberangkatan ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-plane-departure fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75">Jadwal berangkat</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card bg-secondary text-white shadow-hover">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Sukses</h5>
                                <h2 class="mb-0"><?= $pembayaranSukses ?></h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <small class="opacity-75">Pembayaran sukses</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if ($_SESSION['role_name'] === 'admin'): ?>
                <!-- Aktivitas Terbaru - Hanya untuk Admin -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Aktivitas Terbaru</h5>
                            <a href="../user_activity/index.php" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-external-link-alt me-1"></i>Selengkapnya
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">No</th>
                                            <th>User</th>
                                            <th>Aksi</th>
                                            <th>Objek</th>
                                            <th>Pesan</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($qLogs) > 0): ?>
                                            <?php $no = 1;
                                            while ($log = mysqli_fetch_assoc($qLogs)) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                                <span class="text-white fw-bold" style="font-size: 12px;">
                                                                    <?= strtoupper(substr($log['full_name'] ?? 'U', 0, 1)) ?>
                                                                </span>
                                                            </div>
                                                            <?= htmlspecialchars($log['full_name'] ?? '-') ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge 
                                                            <?= $log['action'] == 'CREATE' ? 'bg-success' : '' ?>
                                                            <?= $log['action'] == 'UPDATE' ? 'bg-warning' : '' ?>
                                                            <?= $log['action'] == 'DELETE' ? 'bg-danger' : '' ?>
                                                            <?= !in_array($log['action'], ['CREATE', 'UPDATE', 'DELETE']) ? 'bg-primary' : '' ?>
                                                        "><?= $log['action'] ?></span>
                                                    </td>
                                                    <td>
                                                        <small>
                                                            <strong><?= $log['object_type'] ?></strong><br>
                                                            ID: <?= $log['object_id'] ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <span class="log-message" title="<?= htmlspecialchars($log['message']) ?>">
                                                            <?= strlen($log['message']) > 30 ? substr(htmlspecialchars($log['message']), 0, 30) . '...' : htmlspecialchars($log['message']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <?= date('d/m/Y', strtotime($log['created_at'])) ?><br>
                                                            <strong><?= date('H:i', strtotime($log['created_at'])) ?></strong>
                                                        </small>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                                    Tidak ada aktivitas terbaru
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Status untuk Admin -->
                <div class="col-lg-4 mb-4">
                    <!-- Quick Actions -->
                    <div class="card shadow border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="../data jamaah/index.php" class="btn btn-outline-primary text-start">
                                    <i class="fas fa-users me-2"></i>Kelola Jamaah
                                </a>
                                <a href="../data paket/index.php" class="btn btn-outline-success text-start">
                                    <i class="fas fa-box me-2"></i>Kelola Paket
                                </a>
                                <a href="../data pembayaran/index.php" class="btn btn-outline-warning text-start">
                                    <i class="fas fa-credit-card me-2"></i>Lihat Pembayaran
                                </a>
                                <a href="../data berangkat/index.php" class="btn btn-outline-info text-start">
                                    <i class="fas fa-plane-departure me-2"></i>Data Keberangkatan
                                </a>
                                <a href="../user/index.php" class="btn btn-outline-secondary text-start">
                                    <i class="fas fa-user-cog me-2"></i>Kelola Users
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="card shadow border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Status Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Sukses</span>
                                    <span><?= $pembayaranSukses ?></span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: <?= $totalPembayaran > 0 ? ($pembayaranSukses / $totalPembayaran * 100) : 0 ?>%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Pending</span>
                                    <span><?= $pembayaranPending ?></span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: <?= $totalPembayaran > 0 ? ($pembayaranPending / $totalPembayaran * 100) : 0 ?>%"></div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <small class="text-muted">Total: <?= $totalPembayaran ?> transaksi</small>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Layout untuk User Biasa -->
                <div class="col-lg-8 mb-4">
                    <!-- Informasi untuk User -->
                    <div class="card shadow border-0">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Umrah</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-check-circle text-success me-2"></i>Pendaftaran Berhasil</h6>
                                    <p class="text-muted mb-3">Total pendaftaran yang telah Anda lakukan: <strong><?= $totalPendaftaran ?></strong></p>

                                    <h6><i class="fas fa-credit-card text-info me-2"></i>Status Pembayaran</h6>
                                    <p class="text-muted">
                                        Sukses: <strong><?= $pembayaranSukses ?></strong> |
                                        Pending: <strong><?= $pembayaranPending ?></strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-plane text-warning me-2"></i>Keberangkatan</h6>
                                    <p class="text-muted mb-3">Jadwal keberangkatan tersedia: <strong><?= $totalKeberangkatan ?></strong></p>

                                    <h6><i class="fas fa-box text-primary me-2"></i>Paket Tersedia</h6>
                                    <p class="text-muted">Total paket umrah: <strong><?= $totalPaket ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panduan Cepat -->
                    <div class="card shadow border-0 mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-play-circle me-2"></i>Mulai Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Ikuti langkah-langkah berikut untuk mendaftar umrah:</p>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Pilih Paket</div>
                                        Pilih paket umrah yang sesuai dengan kebutuhan Anda
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Isi Form Pendaftaran</div>
                                        Lengkapi data diri dan dokumen yang diperlukan
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Konfirmasi Pembayaran</div>
                                        Lakukan pembayaran dan upload bukti transfer
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions untuk User -->
                <div class="col-lg-4 mb-4">
                    <!-- Quick Actions -->
                    <div class="card shadow border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="../pendaftaran/index.php" class="btn btn-outline-success text-start">
                                    <i class="fas fa-file-signature me-2"></i>Pendaftaran Baru
                                </a>
                                <a href="../data jamaah/index.php" class="btn btn-outline-primary text-start">
                                    <i class="fas fa-users me-2"></i>Data Jamaah
                                </a>
                                <a href="../data paket/index.php" class="btn btn-outline-info text-start">
                                    <i class="fas fa-box me-2"></i>Lihat Paket
                                </a>
                                <a href="../data pembayaran/index.php" class="btn btn-outline-warning text-start">
                                    <i class="fas fa-credit-card me-2"></i>Pembayaran
                                </a>
                                <a href="../data berangkat/index.php" class="btn btn-outline-secondary text-start">
                                    <i class="fas fa-plane-departure me-2"></i>Jadwal Berangkat
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Ringkas -->
                    <div class="card shadow border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik Ringkas</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                    Jamaah Terdaftar
                                    <span class="badge bg-primary rounded-pill"><?= $totalJamaah ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                    Pendaftaran
                                    <span class="badge bg-success rounded-pill"><?= $totalPendaftaran ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                    Pembayaran Sukses
                                    <span class="badge bg-success rounded-pill"><?= $pembayaranSukses ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                    Paket Tersedia
                                    <span class="badge bg-warning rounded-pill"><?= $totalPaket ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
    /* Reset dan layout utama */
    body {
        background-color: #f8f9fa;
        overflow-x: hidden;
    }

    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        min-height: calc(100vh - 80px);
        padding-top: 80px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* Stat card styling */
    .stat-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .shadow-hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-card .stat-icon {
        opacity: 0.8;
    }

    /* Table styling */
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        color: #6c757d;
        background-color: #f8f9fa;
    }

    .log-message {
        cursor: help;
    }

    /* Card header styling */
    .card-header {
        border-radius: 12px 12px 0 0 !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* List group styling */
    .list-group-item {
        border: none;
        padding: 0.75rem 0;
        background: transparent;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 15px;
            padding-top: 100px;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 0 !important;
            width: 100% !important;
        }

        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    @media (max-width: 576px) {
        .main-content {
            padding-top: 120px;
        }

        .stat-card .card-body {
            padding: 1rem;
        }

        .stat-card h2 {
            font-size: 1.5rem;
        }

        .stat-icon {
            font-size: 1.5rem !important;
        }
    }

    /* Tambahan untuk memastikan footer tidak nabrak */
    .main-content {
        padding-bottom: 2rem;
    }
</style>

<?php include '../../partials/footer.php'; ?>