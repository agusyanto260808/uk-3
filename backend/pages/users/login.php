<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
  header("Location: ../../pages/dashbord/index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login Travel Haji & Umroh</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
  <div class="card shadow-lg" style="width: 400px;">
    <div class="card-body p-4">
      <h4 class="text-center mb-4 fw-bold">Login Sistem</h4>

      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger">
          <?= $_SESSION['login_error'];
          unset($_SESSION['login_error']); ?>
        </div>
      <?php endif; ?>

      <form action="../../actions/auth/login_proses.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>

      <hr>
      <!-- 
      <div class="text-center">
        <p class="mb-1">Belum punya akun?</p>
        <a href="register.php" class="btn btn-outline-success w-100">Daftar Akun Baru</a>
      </div> -->
    </div>
  </div>
</body>

</html>