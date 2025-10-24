<?php
session_start();
include '../../../config/connection.php';

$jamaah_id = $_POST['jamaah_id'];
$paket_id = $_POST['paket_id'];
$keberangkatan_id = $_POST['keberangkatan_id'];
$total_price = $_POST['total_price'];
$notes = $_POST['notes'];

// simpan ke registrations
mysqli_query($conn, "
    INSERT INTO registrations (jamaah_id, paket_id, keberangkatan_id, registration_date, status, total_price, paid_amount, notes, updated_at)
    VALUES ($jamaah_id, $paket_id, $keberangkatan_id, NOW(), 'pending', $total_price, 0, '$notes', NOW())
");

$last_id = mysqli_insert_id($conn);

// simpan ke audit log
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "
    INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
    VALUES ($user_id, 'CREATE', 'registration', '$last_id', 'Menambahkan data pendaftaran baru', NOW())
");

header("Location: ../../pages/pendaftaran/index.php");
exit();
