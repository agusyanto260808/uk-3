<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil semua log terbaru
$qLogs = mysqli_query($conn, "
    SELECT a.*, u.full_name
    FROM audit_logs a
    LEFT JOIN users u ON u.id = a.user_id
    ORDER BY a.created_at DESC
");
?>

<div class="container mt-4">
    <h3>Audit Log Aktivitas</h3>
    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Nama Pengguna</th>
                    <th>Aksi</th>
                    <th>Objek</th>
                    <th>ID Objek</th>
                    <th>Pesan</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($qLogs)) :
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= date('d M Y H:i:s', strtotime($row['created_at'])) ?></td>
                        <td><?= htmlspecialchars($row['full_name'] ?? 'Guest') ?></td>
                        <td><span class="badge bg-primary"><?= strtoupper($row['action']) ?></span></td>
                        <td><?= htmlspecialchars($row['object_type']) ?></td>
                        <td><?= htmlspecialchars($row['object_id']) ?></td>
                        <td><?= htmlspecialchars(substr($row['message'], 0, 60)) ?>...</td>
                        <td class="text-center">
                            <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Lihat</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>