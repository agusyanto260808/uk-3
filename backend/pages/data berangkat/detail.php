<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = mysqli_query($conn, "
  SELECT k.*, p.nama AS nama_paket, p.jenis, p.harga
  FROM keberangkatan k
  JOIN paket p ON k.paket_id = p.id
  WHERE k.id = '$id'
");
$d = mysqli_fetch_assoc($q);
?>

<div class="main-content">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0"><i class="fa fa-plane-departure me-2"></i>Detail Keberangkatan</h5>
          </div>

          <div class="card-body p-4" style="background-color: #f9fafc;">
            <?php if (!$d): ?>
              <div class="alert alert-danger">Data keberangkatan tidak ditemukan.</div>
            <?php else: ?>

              <div class="border rounded-3 mb-4 p-3 bg-white shadow-sm-sm">
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">Informasi Paket</h6>
                <div class="mb-2 d-flex justify-content-between">
                  <span class="text-secondary fw-semibold">Nama Paket</span>
                  <span><?= htmlspecialchars($d['nama_paket']) ?> (<?= strtoupper($d['jenis']) ?>)</span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                  <span class="text-secondary fw-semibold">Harga Paket</span>
                  <span class="text-success fw-bold">Rp <?= number_format($d['harga'], 0, ',', '.') ?></span>
                </div>
              </div>

              <div class="border rounded-3 mb-4 p-3 bg-white shadow-sm-sm">
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">Tanggal Keberangkatan</h6>
                <div class="row">
                  <div class="col-md-6 mb-2">
                    <span class="text-secondary fw-semibold d-block">Tanggal Berangkat</span>
                    <span><?= htmlspecialchars($d['departure_date']) ?></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="text-secondary fw-semibold d-block">Tanggal Pulang</span>
                    <span><?= htmlspecialchars($d['return_date']) ?></span>
                  </div>
                </div>
              </div>

              <div class="border rounded-3 mb-4 p-3 bg-white shadow-sm-sm">
                <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">Kuota dan Status</h6>
                <div class="row">
                  <div class="col-md-6 mb-2">
                    <span class="text-secondary fw-semibold d-block">Kuota Jamaah</span>
                    <span><?= htmlspecialchars($d['quota']) ?></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="text-secondary fw-semibold d-block">Telah Terdaftar</span>
                    <span><?= htmlspecialchars($d['booked']) ?></span>
                  </div>
                </div>
                <div class="mt-2">
                  <span class="text-secondary fw-semibold d-block">Status Keberangkatan</span>
                  <span class="badge px-3 py-2 rounded-pill
                    <?= $d['status'] == 'open' ? 'bg-success' : ($d['status'] == 'closed' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                    <?= ucfirst($d['status']) ?>
                  </span>
                </div>
              </div>

              <div class="border-top pt-3 text-muted small">
                <div><i class="fa fa-calendar-alt me-1"></i> Dibuat: <?= htmlspecialchars($d['created_at']) ?></div>
                <div><i class="fa fa-sync-alt me-1"></i> Diperbarui: <?= htmlspecialchars($d['updated_at']) ?></div>
              </div>

              <div class="mt-4 text-end">
                <a href="index.php" class="btn btn-secondary px-4 rounded-pill">
                  <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
              </div>

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

  .card-body p,
  .card-body span {
    font-size: 15px;
  }

  .card-header {
    font-weight: 600;
  }
</style>

<?php include '../../partials/footer.php'; ?>