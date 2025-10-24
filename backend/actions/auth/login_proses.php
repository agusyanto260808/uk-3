<?php
ob_start();
session_start();
include '../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ambil data user dari tabel users
    $sql = "
        SELECT u.*, r.role_name 
        FROM users u
        JOIN roles r ON r.id = u.role_id
        WHERE u.username = ? AND u.is_active = 1
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verifikasi password
        if (password_verify($password, $user['password_hash'])) {
            // Simpan session (pastikan kolom sesuai database!)
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['full_name'] = $user['full_name']; // ubah ke 'nama_lengkap' kalau di DB kamu beda
            $_SESSION['role_name'] = $user['role_name']; // pastikan kolom di tabel roles ada

            // Simpan log ke audit_logs
            $logSql = "INSERT INTO audit_logs (user_id, action, object_type, object_id, message, created_at)
                       VALUES (?, 'login', 'users', ?, 'User login', NOW())";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param('ii', $user['id'], $user['id']);
            $logStmt->execute();

            // Redirect ke dashboard
            header("Location: ../../pages/dashboard/index.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Password salah.';
        }
    } else {
        $_SESSION['login_error'] = 'Username tidak ditemukan atau akun tidak aktif.';
    }

    // Jika gagal login, kembali ke halaman login
    header("Location: ../../pages/users/login.php");
    exit();
}

ob_end_flush();
