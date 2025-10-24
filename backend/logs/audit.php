<?php
function insertAuditLog($conn, $user_id, $action, $object_type, $object_id, $message = null)
{
    $stmt = $conn->prepare("
        INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param("issss", $user_id, $action, $object_type, $object_id, $message);
    $stmt->execute();
}
