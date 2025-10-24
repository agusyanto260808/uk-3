<?php
session_start();
include '../../../config/connection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Simpan log logout
    $logSql = "INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
               VALUES (?, 'logout', 'users', ?, 'User logout', NOW())";
    $stmt = $conn->prepare($logSql);
    $stmt->bind_param('ii', $user_id, $user_id);
    $stmt->execute();
}

// Hapus session
session_unset();
session_destroy();

// Arahkan ke login
header("Location: ../../pages/users/login.php");
exit();
