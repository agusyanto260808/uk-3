<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Data Jamaah</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/data jamaah/store.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
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

<style>
    /* 🔹 Layout sejajar sidebar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 70px;
        /* Jarak pas dari navbar */
        transition: all 0.3s ease;
    }

    /* 🔹 Responsif saat sidebar di-collapse */
    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* 🔹 Styling tambahan */
    .card {
        background-color: #fff;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }
</style>

<?php include '../../partials/footer.php'; ?>