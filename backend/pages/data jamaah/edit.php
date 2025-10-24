<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM jamaah WHERE id='$id'");
$d = mysqli_fetch_assoc($q);
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-dark fw-semibold">
                <h5 class="mb-0">Edit Data Jamaah</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/data jamaah/update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control" value="<?= $d['nik'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $d['tanggal_lahir'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" <?= $d['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= $d['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control" required><?= $d['alamat'] ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $d['email'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" value="<?= $d['phone'] ?>" required>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* 🔹 Posisi pas sejajar sidebar & navbar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 70px;
        transition: all 0.3s ease;
    }

    /* 🔹 Responsif ketika sidebar collapse */
    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

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