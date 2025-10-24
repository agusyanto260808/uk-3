<?php
include __DIR__ . '/../../../config/connection.php';
include __DIR__ . '/../../partials/header.php';
include __DIR__ . '/../../partials/navbar.php';
include __DIR__ . '/../../partials/sidebar.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        alert('ID jamaah tidak valid!');
        window.location.href='../data_jamaah/index.php';
    </script>";
    exit();
}

$q = mysqli_query($conn, "SELECT * FROM jamaah WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

if (!$d) {
    echo "<script>
        alert('Data jamaah tidak ditemukan!');
        window.location.href='../data_jamaah/index.php';
    </script>";
    exit();
}
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white fw-semibold d-flex justify-content-between align-items-center rounded-top-4">
                <h5 class="mb-0"><i class="fa fa-user me-2"></i> Detail Jamaah</h5>
            </div>

            <div class="card-body p-4" style="background-color: #f9fafc;">
                <div class="border rounded-3 p-3 bg-white mb-4 shadow-sm-sm">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="fa fa-id-card me-2"></i> Informasi Pribadi
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Nama Lengkap</span>
                                <span><?= htmlspecialchars($d['nama']) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">NIK</span>
                                <span><?= htmlspecialchars($d['nik']) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Tanggal Lahir</span>
                                <span><?= date('d F Y', strtotime($d['tanggal_lahir'])) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Jenis Kelamin</span>
                                <span><?= $d['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Email</span>
                                <span><?= htmlspecialchars($d['email']) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">No. Telepon</span>
                                <span><?= htmlspecialchars($d['phone']) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Alamat</span>
                                <span><?= nl2br(htmlspecialchars($d['alamat'])) ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="fw-semibold text-secondary d-block">Dibuat Pada</span>
                                <span><?= date('d M Y H:i', strtotime($d['created_at'])) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="../data jamaah/index.php" class="btn btn-secondary px-4 rounded-pill">
                        <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* 🔹 Layout sejajar dengan sidebar dan navbar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 70px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .card-header {
        padding: 15px 20px;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }

    .border-bottom {
        border-bottom: 2px solid #e3e6f0 !important;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .shadow-sm-sm {
        box-shadow: 0 0.25rem 0.4rem rgba(0, 0, 0, 0.04);
    }

    .card-body span {
        font-size: 15px;
        color: #333;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .btn {
        font-weight: 500;
        border-radius: 8px;
    }
</style>

<?php include __DIR__ . '/../../partials/footer.php'; ?>