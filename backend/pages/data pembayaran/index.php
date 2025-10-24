<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil semua data pembayaran (bisa difilter by status)
$query = "
    SELECT pay.*, j.nama AS nama_jamaah, r.id AS reg_id
    FROM payments pay
    JOIN registrations r ON r.id = pay.registration_id
    JOIN jamaah j ON j.id = r.jamaah_id
    ORDER BY pay.created_at DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2>Konfirmasi Pembayaran Jamaah</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jamaah</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Referensi</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($p = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($p['nama_jamaah']); ?></td>
                    <td>Rp <?= number_format($p['amount'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($p['method']); ?></td>
                    <td><?= htmlspecialchars($p['reference']); ?></td>
                    <td>
                        <?php if ($p['status'] == 'pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php elseif ($p['status'] == 'confirmed'): ?>
                            <span class="badge bg-success">Confirmed</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $p['payment_date']; ?></td>
                    <td>
                        <?php if ($p['status'] == 'pending'): ?>
                            <a href="confirm.php?id=<?= $p['id']; ?>&status=confirmed" class="btn btn-success btn-sm">Konfirmasi</a>
                            <a href="confirm.php?id=<?= $p['id']; ?>&status=rejected" class="btn btn-danger btn-sm">Tolak</a>
                        <?php else: ?>
                            <i>Tidak ada aksi</i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>