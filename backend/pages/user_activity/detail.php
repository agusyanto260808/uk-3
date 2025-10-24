<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = mysqli_query($conn, "
    SELECT a.*, u.full_name, u.username 
    FROM audit_logs a
    LEFT JOIN users u ON u.id = a.user_id
    WHERE a.id = '$id'
");
$data = mysqli_fetch_assoc($q);
?>

<div class="container mt-4">
    <h3>Detail Audit Log</h3>
    <hr>

    <?php if ($data): ?>
        <table class="table table-bordered">
            <tr>
                <th>ID Log</th>
                <td><?= $data['id'] ?></td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td><?= date('d M Y H:i:s', strtotime($data['created_at'])) ?></td>
            </tr>
            <tr>
                <th>Nama Pengguna</th>
                <td><?= htmlspecialchars($data['full_name']) ?> (<?= htmlspecialchars($data['username']) ?>)</td>
            </tr>
            <tr>
                <th>Aksi</th>
                <td><span class="badge bg-primary"><?= strtoupper($data['action']) ?></span></td>
            </tr>
            <tr>
                <th>Objek</th>
                <td><?= htmlspecialchars($data['object_type']) ?></td>
            </tr>
            <tr>
                <th>ID Objek</th>
                <td><?= htmlspecialchars($data['object_id']) ?></td>
            </tr>
            <tr>
                <th>Pesan</th>
                <td><?= nl2br(htmlspecialchars($data['message'])) ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p class="text-danger">Data log tidak ditemukan.</p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
</div>

<?php include '../../partials/footer.php'; ?>