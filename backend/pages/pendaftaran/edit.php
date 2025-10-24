<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='index.php';
    </script>";
    exit();
}

$q = mysqli_query($conn, "SELECT * FROM registrations WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>
        alert('Data pendaftaran tidak ditemukan!');
        window.location.href='index.php';
    </script>";
    exit();
}
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ubah Status Pendaftaran</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="../../actions/pendaftaran/update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <div class="mb-4">
                                <label class="form-label fw-semibold"><strong>Status</strong></label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" <?= $data['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="confirmed" <?= $data['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                    <option value="canceled" <?= $data['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                    <option value="rejected" <?= $data['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
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
    /* 🔹 Posisi pas dengan sidebar dan navbar */
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

    .container {
        padding-bottom: 80px;
    }
</style>

<?php include '../../partials/footer.php'; ?>