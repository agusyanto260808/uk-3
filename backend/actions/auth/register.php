<?php
session_start();
include '../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $full_name  = trim($_POST['full_name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $role_id    = intval($_POST['role_id']); // 1=admin, 2=petugas, 3=jamaah

    // 🔹 Cek apakah username sudah dipakai
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = 'Username sudah digunakan.';
        header("Location: ../../pages/users/register.php");
        exit();
    }

    // 🔹 Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 🔹 Simpan user baru ke database
    $stmt = $conn->prepare("
        INSERT INTO users (username, password_hash, role_id, full_name, email, phone, is_active, created_at)
        VALUES (?, ?, ?, ?, ?, ?, 1, NOW())
    ");
    $stmt->bind_param("ssisss", $username, $password_hash, $role_id, $full_name, $email, $phone);

    if ($stmt->execute()) {
        $_SESSION['register_success'] = 'Registrasi berhasil! Silakan login.';
        header("Location: ../../pages/users/login.php");
        exit();
    } else {
        $_SESSION['register_error'] = 'Terjadi kesalahan saat menyimpan data.';
        header("Location: ../../pages/users/register.php");
        exit();
    }
}
