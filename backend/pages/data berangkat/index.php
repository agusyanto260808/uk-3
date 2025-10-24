<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$q = mysqli_query($conn, "
  SELECT k.*, p.nama AS nama_paket
  FROM keberangkatan k
  JOIN paket p ON k.paket_id = p.id
  ORDER BY k.created_at DESC
");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Keberangkatan</h3>
        <a href="create.php" class="btn btn-primary">+ Tambah</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Paket</th>
                <th>Berangkat</th>
                <th>Pulang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($q)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_paket']) ?></td>
                    <td><?= htmlspecialchars($row['departure_date']) ?></td>
                    <td><?= htmlspecialchars($row['return_date']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>