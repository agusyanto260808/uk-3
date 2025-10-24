<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        alert('ID paket tidak valid!');
        window.location.href='index.php';
    </script>";
    exit();
}

$q = $conn->prepare("SELECT * FROM paket WHERE id = ?");
$q->bind_param("i", $id);
$q->execute();
$data = $q->get_result()->fetch_assoc();

if (!$data) {
    echo "<script>
        alert('Data paket tidak ditemukan!');
        window.location.href='index.php';
    </script>";
    exit();
}
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0"><i class="fa fa-box me-2"></i> Detail Paket</h5>
                        <a href="index.php" class="btn btn-light btn-sm px-3">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body p-4" style="background-color: #f9fafc;">
                        <table class="table table-bordered align-middle shadow-sm-sm">
                            <tr>
                                <th>Kode</th>
                                <td><?= htmlspecialchars($data['kode']) ?></td>
                            </tr>
                            <tr>
                                <th>Nama Paket</th>
                                <td><?= htmlspecialchars($data['nama']) ?></td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td><?= ucfirst(htmlspecialchars($data['jenis'])) ?></td>
                            </tr>
                            <tr>
                                <th>Durasi</th>
                                <td><?= htmlspecialchars($data['durasi_days']) ?> hari</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td><strong>Rp<?= number_format($data['harga'], 0, ',', '.') ?></strong></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td><?= htmlspecialchars($data['created_at']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* 🔹 Layout sejajar sidebar & navbar */
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
        font-weight: 600;
        font-size: 16px;
    }

    .table {
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .table th {
        background-color: #f1f3f5;
        color: #333;
        font-weight: 600;
        width: 35%;
        vertical-align: middle;
    }

    .table td {
        color: #444;
        font-size: 15px;
        background-color: #fff;
    }

    .table tr:hover td {
        background-color: #f8f9fa;
        transition: 0.2s ease;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }

    .shadow-sm-sm {
        box-shadow: 0 0.25rem 0.4rem rgba(0, 0, 0, 0.04);
    }
</style>

<?php include '../../partials/footer.php'; ?>