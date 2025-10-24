<?php
session_start();
include '../../../config/connection.php';

$id = $_POST['id'];
$status = $_POST['status'];

// update status
mysqli_query($conn, "UPDATE registrations SET status='$status', updated_at=NOW() WHERE id=$id");

// audit log
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "
    INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
    VALUES ($user_id, 'UPDATE', 'registration', '$id', 'Mengubah status pendaftaran menjadi $status', NOW())
");

header("Location: ../../pages/pendaftaran/index.php");
exit();
