<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Travel Haji & Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4 fw-bold">Daftar Akun</h4>

            <?php if (isset($_SESSION['register_error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['register_error'];
                    unset($_SESSION['register_error']); ?>
                </div>
            <?php elseif (isset($_SESSION['register_success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['register_success'];
                    unset($_SESSION['register_success']); ?>
                </div>
            <?php endif; ?>

            <!-- 🔹 Arahkan ke file proses yang benar -->
            <form action="../../actions/auth/register.php" method="POST">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                        <option value="3">Jamaah</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <a href="login.php">Sudah punya akun? Login di sini</a>
            </div>
        </div>
    </div>
</body>

</html>