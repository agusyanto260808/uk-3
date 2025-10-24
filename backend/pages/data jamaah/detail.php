<?php
include __DIR__ . '/../../../config/connection.php';
include __DIR__ . '/../../partials/header.php';
include __DIR__ . '/../../partials/navbar.php';
include __DIR__ . '/../../partials/sidebar.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        alert('ID jamaah tidak valid!');
        window.location.href='../data_jamaah/index.php';
    </script>";
    exit();
}

$q = mysqli_query($conn, "SELECT * FROM jamaah WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

if (!$d) {
    echo "<script>
        alert('Data jamaah tidak ditemukan!');
        window.location.href='../data_jamaah/index.php';
    </script>";
    exit();
}
?>

<div class="container mt-5">
    <div class="card shadow p-4 rounded-3">
        <h3 class="mb-4 text-center">Detail Jamaah</h3>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama Lengkap:</strong><br><?= htmlspecialchars($d['nama']) ?></p>
                <p><strong>NIK:</strong><br><?= htmlspecialchars($d['nik']) ?></p>
                <p><strong>Tanggal Lahir:</strong><br><?= date('d F Y', strtotime($d['tanggal_lahir'])) ?></p>
                <p><strong>Jenis Kelamin:</strong><br><?= $d['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
            </div>

            <div class="col-md-6">
                <p><strong>Email:</strong><br><?= htmlspecialchars($d['email']) ?></p>
                <p><strong>No. Telepon:</strong><br><?= htmlspecialchars($d['phone']) ?></p>
                <p><strong>Alamat:</strong><br><?= nl2br(htmlspecialchars($d['alamat'])) ?></p>
                <p><strong>Dibuat Pada:</strong><br><?= date('d M Y H:i', strtotime($d['created_at'])) ?></p>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="../data jamaah/index.php" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>