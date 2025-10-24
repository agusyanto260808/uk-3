<?php
include '../../../config/connection.php';
session_start();

$id = $_GET['id'];
$status = $_GET['status']; // confirmed / rejected

// Update status pembayaran
$stmt = $conn->prepare("UPDATE payments SET status=?, created_at=created_at WHERE id=?");
$stmt->bind_param('si', $status, $id);
$stmt->execute();

// Simpan ke audit log
$user_id = $_SESSION['user_id'] ?? null;
$log = $conn->prepare("INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
                       VALUES (?, 'update', 'payments', ?, ?, NOW())");
$msg = "Pembayaran ID $id dikonfirmasi menjadi $status";
$log->bind_param('iis', $user_id, $id, $msg);
$log->execute();

header("Location: index.php");
exit;
