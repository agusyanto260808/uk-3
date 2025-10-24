<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil data jamaah
$jamaahResult = mysqli_query($conn, "SELECT id, nama FROM jamaah ORDER BY nama ASC");

// Ambil data paket
$paketResult = mysqli_query($conn, "SELECT id, nama, harga FROM paket ORDER BY nama ASC");

// Ambil data keberangkatan
$keberangkatanResult = mysqli_query($conn, "
    SELECT k.id, p.nama AS paket_nama, k.departure_date 
    FROM keberangkatan k
    JOIN paket p ON p.id = k.paket_id
    WHERE k.status = 'open'
    ORDER BY k.departure_date ASC
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jamaah_id = $_POST['jamaah_id'];
    $paket_id = $_POST['paket_id'];
    $keberangkatan_id = $_POST['keberangkatan_id'];
    $total_price = $_POST['total_price'];
    $paid_amount = $_POST['paid_amount'];
    $notes = $_POST['notes'];

    $status = ($paid_amount >= $total_price) ? 'confirmed' : 'pending';

    $query = "INSERT INTO registrations 
        (jamaah_id, paket_id, keberangkatan_id, registration_date, status, total_price, paid_amount, notes, updated_at)
        VALUES ('$jamaah_id', '$paket_id', '$keberangkatan_id', NOW(), '$status', '$total_price', '$paid_amount', '$notes', NOW())";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('✅ Pendaftaran jamaah berhasil disimpan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('❌ Gagal menyimpan data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <h4 class="page-title">Pendaftaran Jamaah Baru</h4>
            <div class="card">
                <div class="card-body">
                    <form method="POST">

                        <div class="form-group">
                            <label>Nama Jamaah</label>
                            <select name="jamaah_id" class="form-control" required>
                                <option value="">-- Pilih Jamaah --</option>
                                <?php while ($j = mysqli_fetch_assoc($jamaahResult)): ?>
                                    <option value="<?= $j['id']; ?>"><?= htmlspecialchars($j['nama']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Paket</label>
                            <select name="paket_id" id="paketSelect" class="form-control" required onchange="updateHarga()">
                                <option value="">-- Pilih Paket --</option>
                                <?php while ($p = mysqli_fetch_assoc($paketResult)): ?>
                                    <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                                        <?= htmlspecialchars($p['nama']); ?> - Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jadwal Keberangkatan</label>
                            <select name="keberangkatan_id" class="form-control" required>
                                <option value="">-- Pilih Keberangkatan --</option>
                                <?php while ($k = mysqli_fetch_assoc($keberangkatanResult)): ?>
                                    <option value="<?= $k['id']; ?>">
                                        <?= htmlspecialchars($k['paket_nama']); ?> - <?= date('d M Y', strtotime($k['departure_date'])); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Total Harga (Rp)</label>
                            <input type="number" name="total_price" id="total_price" class="form-control" readonly required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Dibayar (Rp)</label>
                            <input type="number" name="paid_amount" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pendaftaran</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateHarga() {
        var select = document.getElementById('paketSelect');
        var harga = select.options[select.selectedIndex].getAttribute('data-harga');
        document.getElementById('total_price').value = harga || '';
    }
</script>

<?php include '../../partials/footer.php'; ?>