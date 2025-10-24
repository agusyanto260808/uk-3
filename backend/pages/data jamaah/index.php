<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil semua data jamaah
$q = mysqli_query($conn, "SELECT * FROM jamaah ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Jamaah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">
    <div class="container">
        <h3 class="mb-4">Data Jamaah</h3>
        <a href="create.php" class="btn btn-primary mb-3">+ Tambah Jamaah</a>

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($q) > 0):
                    while ($d = mysqli_fetch_assoc($q)):
                ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama']) ?></td>
                            <td><?= htmlspecialchars($d['nik']) ?></td>
                            <td><?= htmlspecialchars($d['phone']) ?></td>
                            <td><?= nl2br(htmlspecialchars($d['alamat'])) ?></td>
                            <td class="text-center">
                                <a href="detail.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="../../actions/data jamaah/delete.php?id=<?= $d['id'] ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                else:
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data jamaah</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>