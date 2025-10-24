<?php
$fullName = $_SESSION['full_name'] ?? 'Guest';
$roleName = $_SESSION['role_name'] ?? 'Guest';
?>

<header class="main-header shadow-sm bg-white border-bottom fixed-top d-flex align-items-center justify-content-between px-4 py-2">


    <!-- Profil Pengguna -->
    <div class="dropdown ms-auto">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../tp-ad/assets/img/person.svg" alt="Profile"
                class="rounded-circle me-2 border" width="40" height="40">
            <div class="d-flex flex-column align-items-start">
                <span class="fw-semibold text-dark"><?= htmlspecialchars($fullName); ?></span>
                <small class="text-muted"><?= htmlspecialchars(ucfirst($roleName)); ?></small>
            </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2" aria-labelledby="userDropdown" style="min-width: 220px;">
            <li class="text-center px-3 py-3 border-bottom">
                <img src="../../tp-ad/assets/img/person.svg" alt="Profile"
                    class="rounded-circle mb-2 border" width="70" height="70">
                <h6 class="fw-bold mb-0"><?= htmlspecialchars($fullName); ?></h6>
                <small class="text-muted"><?= htmlspecialchars(ucfirst($roleName)); ?></small>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a href="../../actions/auth/logout.php" class="dropdown-item text-danger fw-semibold">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</header>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background-color: #111c44;
    }

    /* Header sejajar dengan sidebar */
    .main-header {
        position: fixed;
        top: 0;
        left: 260px;
        right: 0;
        height: 60px;
        z-index: 1030;
        transition: all 0.3s ease;
    }

    /* Konten utama turun di bawah header */
    .main-content {
        margin-left: 260px;
        padding-top: 70px;
        transition: all 0.3s ease;
    }

    /* Saat sidebar collapse */
    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar.collapsed~.main-header {
        left: 80px;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
    }
</style>